<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    protected $table = 'bill_detail';
    protected $with = ['categoryProduct', 'product'];
    protected $fillable = [
        'bill_id', 'product_id', 'category_product_id', 'amount', 'created_by', 'updated_by'
    ];

    public function categoryProduct()
    {
        return $this->belongsTo(CategoryProduct::class, 'category_product_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
