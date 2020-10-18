<?php

namespace App\Repositories;

use App\CategoryProduct;
use Illuminate\Support\Facades\Auth;

class CategoryProductRepository
{
    public function get($id)
    {
        return CategoryProduct::find($id);
    }

    public function all($columns = ['*'])
    {
        return CategoryProduct::get($columns);
    }

    public function findBy($column, $value)
    {
        return CategoryProduct::where([$column => $value])->first();
    }

    public function query()
    {
        return CategoryProduct::query();
    }

    public function delete($ids)
    {
        return CategoryProduct::destroy($ids);
    }

    public function save($data, int $id = null)
    {
        $arrCategoryProduct = [
            'code' => $data['code'],
            'name' => $data['name'],
            'description' => $data['description']
        ];

        if($id)
            $arrCategoryProduct['updated_by'] = Auth::id();
        else
            $arrCategoryProduct['created_by'] = Auth::id();

        return CategoryProduct::updateOrCreate(
            ['id' => $id],
            $arrCategoryProduct
        );
    }
}
