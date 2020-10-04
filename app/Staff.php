<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';
    protected $fillable = [
        'code', 'fullname', 'phone', 'email', 'sex', 'birtday', 'created_by', 'updated_by', 'deleted_by', 'deleted_at'
    ];

    public function scopeIsNotDelete($query)
    {
        return $query->whereNull('deleted_by');
    }
}
