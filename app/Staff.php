<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use SoftDeletes;

    protected $table = 'staff';
    protected $fillable = [
        'code', 'fullname', 'phone', 'email', 'sex', 'birtday', 'created_by', 'updated_by', 'deleted_by', 'deleted_at'
    ];

}
