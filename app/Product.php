<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'product';
    protected $fillable = [
        'code', 'name', 'category_id', 'price', 'supplier', 'description', 'thumb', 'created_by', 'updated_by', 'deleted_by', 'deleted_at'
    ];

    public function categoryProduct()
    {
        return $this->belongsTo(CategoryProduct::class, 'category_id');
    }

    public function scopeProductByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public static function getProductByCategory($categoryId)
    {
        return Product::select('id', 'name', 'price')->productByCategory($categoryId)->get();
    }
}
