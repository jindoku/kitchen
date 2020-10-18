<?php

namespace App\Repositories;


use App\Staff;
use Illuminate\Support\Facades\Auth;

class StaffRepository
{
    public function get($id)
    {
        return Staff::find($id);
    }

    public function all($columns = ['*'])
    {
        return Staff::get($columns);
    }

    public function findBy($column, $value)
    {
        return Staff::where([$column => $value])->first();
    }

    public function query()
    {
        return Staff::query();
    }

    public function delete($ids)
    {
        return Staff::destroy($ids);
    }

    public function save($data, int $id = null)
    {
        $arrStaff = [
            'code' => $data['code'],
            'fullname' => $data['fullname'],
            'email' => $data['email'] ? $data['email'] : null,
            'phone' => $data['phone'],
            'sex' => $data['sex'],
            'address' => $data['address'] ? $data['address'] : null,
        ];
        if($id)
            $arrStaff['updated_by'] = Auth::id();
        else
            $arrStaff['created_by'] = Auth::id();

        if($data['birtday'])
            $arrStaff['birtday'] = date('Y-m-d', strtotime($data['birtday']));


        return Staff::updateOrCreate(
            ['id' => $id],
            $arrStaff
        );
    }
}
