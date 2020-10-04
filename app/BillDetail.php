<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    protected $table = 'bill_detail';
    protected $fillable = [
        'bill_id', 'product_id', 'category_product_id', 'amount', 'created_by', 'updated_by'
    ];
}
