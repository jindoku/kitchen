<?php

namespace App\Services;


use App\BillDetail;
use App\Repositories\CategoryProductRepository;
use App\Repositories\ProductRepository;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class ProductService
{
    use UtilService;
    private $productRepository;
    private $categoryProductRepository;

    public function __construct(ProductRepository $productRepository, CategoryProductRepository $categoryProductRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryProductRepository = $categoryProductRepository;
    }

    public function getProducts($searchParams = [])
    {
        $query = $this->productRepository->query()->with('categoryProduct');
        $limit = Arr::get($searchParams, 'raw', 10);
        $keyword = Arr::get($searchParams, 'keyword', '');
        $category_id = Arr::get($searchParams, 'category_id', '');
        $column = Arr::get($searchParams, 'column', 'created_at');
        $order = Arr::get($searchParams, 'order', 'desc');
        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('code', 'LIKE', '%' . $keyword . '%');
                $q->orWhere('name', 'LIKE', '%' . $keyword . '%');
            });
        }

        if(!empty($category_id))
        {
            $query->where('category_id', $category_id);
        }

        if ($order)
            $query->orderBy($column, $order);

        return $query->paginate($limit);
    }

    //service create data
    public function storeProduct($data)
    {
        $product = $this->productRepository->save($data);
        if($data->has('product_file')){
            $pathThumb = $this->uploadFile($data->product_file, $product->code);

            $this->productRepository->updateThumb($pathThumb, $product);
        }
    }

    public function updateProduct($data, $id)
    {
        $product = $this->productRepository->save($data, $id);
        if($data->has('product_file') && $data->product_file){
            $pathThumb = $this->uploadFile($data->product_file, $product->code);

            $this->productRepository->updateThumb($pathThumb, $product);
        }
    }

    public function destroyProduct($id)
    {
        $countBillByCategory = BillDetail::where('category_product_id', $id)->count();
        if($countBillByCategory > 0)
            return 'bill';

        $product = $this->productRepository->get($id);
        $product->delete();
    }

    public function getCategoryProduct()
    {
        return $this->categoryProductRepository->all(['id', 'name']);
    }
}
