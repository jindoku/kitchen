<?php

namespace App\Services;


use App\Repositories\CategoryProductRepository;
use App\Repositories\ProductRepository;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class ProductService
{
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
        $column = Arr::get($searchParams, 'column', '');
        $order = Arr::get($searchParams, 'order', '');
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

        return $query->isNotDelete()->paginate($limit);
    }

    //service create data
    public function storeProduct($data)
    {
        $data['created_by'] = Auth::id();
        $this->productRepository->save($data);
    }

    public function updateProduct($data, $id)
    {
        $data['updated_by'] = Auth::id();
        $this->productRepository->save($data, $id);
    }

    public function destroyProduct($id)
    {
        $customer = $this->productRepository->get($id);
        $customer->update([
            'deleted_by' => Auth::id(),
            'deleted_at' => Carbon::now()
        ]);
    }

    public function getCategoryProduct()
    {
        return $this->categoryProductRepository->all(['id', 'name']);
    }
}
