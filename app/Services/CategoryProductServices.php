<?php

namespace App\Services;

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
        $column = Arr::get($searchParams, 'column', '');
        $order = Arr::get($searchParams, 'order', '');
        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('code', 'LIKE', '%' . $keyword . '%');
                $q->orWhere('name', 'LIKE', '%' . $keyword . '%');
            });
        }

        if ($order)
            $query->orderBy($column, $order);

        return $query->isNotDelete()->paginate($limit);
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
        $categoryProduct = $this->categoryProductRepository->get($id);
        $categoryProduct->update([
            'deleted_by' => Auth::id(),
            'deleted_at' => Carbon::now()
        ]);
    }
}
