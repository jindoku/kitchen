<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryProduct extends Model
{
    use SoftDeletes;

    protected $table = 'category_product';
    protected $fillable = [
        'code', 'name', 'description', 'created_by', 'updated_by', 'deleted_by', 'deleted_at'
    ];

}
