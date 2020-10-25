<?php

namespace App\Services;

use App\BillDetail;
use App\Product;
use App\Repositories\CategoryProductRepository;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class CategoryProductServices
{
    private $categoryProductRepository;

    public function __construct(CategoryProductRepository $categoryProductRepository)
    {
        $this->categoryProductRepository = $categoryProductRepository;
    }

    public function getCategoryProduct($searchParams = [])
    {
        $query = $this->categoryProductRepository->query();
        $limit = Arr::get($searchParams, 'raw', 10);
        $keyword = Arr::get($searchParams, 'keyword', '');
        $column = Arr::get($searchParams, 'column', 'created_at');
        $order = Arr::get($searchParams, 'order', 'desc');
        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('code', 'LIKE', '%' . $keyword . '%');
                $q->orWhere('name', 'LIKE', '%' . $keyword . '%');
            });
        }

        if ($order)
            $query->orderBy($column, $order);

        return $query->paginate($limit);
    }

    //service create data
    public function storeCategoryProduct($data)
    {
        $this->categoryProductRepository->save($data);
    }

    public function updateCategoryProduct($data, $id)
    {
        $this->categoryProductRepository->save($data, $id);
    }

    public function destroyCategoryProduct($id)
    {
        $countBillByCategory = BillDetail::where('category_product_id', $id)->count();
        if($countBillByCategory > 0)
            return 'bill';

        $countProductByCategory = Product::where('category_id', $id)->count();
        if($countProductByCategory > 0)
            return 'product';

        $categoryProduct = $this->categoryProductRepository->get($id);
        $categoryProduct->update([
            'deleted_by' => Auth::id(),
            'deleted_at' => Carbon::now()
        ]);

        return 'success';
    }
}
