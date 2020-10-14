<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'bill';
    protected $fillable = [
        'code', 'product_id', 'category_product_id', 'staff_id', 'customer_id', 'created_by', 'updated_by', 'note'
    ];
    protected $with = ['billDetail', 'customer', 'staff'];

    public function billDetail(){
        return $this->hasMany(BillDetail::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function staff(){
        return $this->belongsTo(Staff::class);
    }

}
