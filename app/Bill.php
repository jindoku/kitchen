<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'bill';
    protected $fillable = [
        'code', 'product_id', 'category_product_id', 'staff_id', 'customer_id', 'created_by', 'updated_by', 'note'
    ];

}
