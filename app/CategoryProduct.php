<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    protected $table = 'category_product';
    protected $fillable = [
        'code', 'name', 'description', 'created_by', 'updated_by', 'deleted_by', 'deleted_at'
    ];

    public function scopeIsNotDelete($query)
    {
        return $query->whereNull('deleted_by');
    }
}
