<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = [
        'code', 'name', 'category_id', 'price', 'supplier', 'description', 'created_by', 'updated_by', 'deleted_by', 'deleted_at'
    ];

    public function scopeIsNotDelete($query)
    {
        return $query->whereNull('deleted_by');
    }

    public function categoryProduct()
    {
        return $this->belongsTo(CategoryProduct::class, 'category_id');
    }
}
