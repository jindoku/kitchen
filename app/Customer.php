<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';
    protected $fillable = [
        'fullname', 'address', 'phone', 'email', 'sex', 'birtday', 'created_by', 'updated_by', 'deleted_by', 'deleted_at'
    ];

    public function scopeIsNotDelete($query)
    {
        return $query->whereNull('deleted_by');
    }
}
