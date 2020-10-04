<?php

namespace App\Repositories;

use App\Customer;

class CustomerRepository{
    public function get($id)
    {
        return Customer::find($id);
    }

    public function all($columns = ['*'])
    {
        return Customer::get($columns);
    }

    public function findBy($column, $value)
    {
        return Customer::where([$column => $value])->first();
    }

    public function query()
    {
        return Customer::query();
    }

    public function delete($ids)
    {
        return Customer::destroy($ids);
    }

    public function save($data, int $id = null)
    {
        $arrCustomer = [
            'fullname' => $data['fullname'],
            'email' => $data['email'] ? $data['email'] : null,
            'phone' => $data['phone'],
            'sex' => $data['sex'],
            'address' => $data['address'] ? $data['address'] : null,
        ];
        if(!$data['birtday'])
            $arrStaff['birtday'] = date('Y-m-d', $data['birtday']);


        return Customer::updateOrCreate(
            ['id' => $id],
            $arrCustomer
        );
    }
}
