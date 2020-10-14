<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $table = 'customer';
    protected $fillable = [
        'fullname', 'address', 'phone', 'email', 'sex', 'birtday', 'created_by', 'updated_by', 'deleted_by', 'deleted_at'
    ];
}
