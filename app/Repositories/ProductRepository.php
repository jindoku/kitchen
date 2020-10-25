<?php

namespace App\Repositories;


use App\Product;
use Illuminate\Support\Facades\Auth;

class ProductRepository
{

    public function get($id)
    {
        return Product::find($id);
    }

    public function all($columns = ['*'])
    {
        return Product::get($columns);
    }

    public function findBy($column, $value)
    {
        return Product::where([$column => $value])->first();
    }

    public function query()
    {
        return Product::query();
    }

    public function delete($ids)
    {
        return Product::destroy($ids);
    }

    public function save($data, int $id = null)
    {
        $arrProduct = [
            'code' => $data['code'],
            'name' => $data['name'],
            'category_id' => $data['category_id'],
            'price' => $data['price'],
            'supplier' => $data['supplier'],
            'description' => $data['description'] ? $data['description'] : null,
        ];

        if($id)
            $arrProduct['updated_by'] = Auth::id();
        else
            $arrProduct['created_by'] = Auth::id();

        return Product::updateOrCreate(
            ['id' => $id],
            $arrProduct
        );
    }

    public function updateThumb(string $pathThumb, $product)
    {
        return $product->update(
            ['thumb' => $pathThumb]
        );
    }
}
