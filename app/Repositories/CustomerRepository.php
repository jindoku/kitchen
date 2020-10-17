<?php

namespace App\Repositories;

use App\Customer;
use Illuminate\Database\Eloquent\Collection;

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

    public function export($dataExport)
    {
        $collections = new Collection();
        $stt = 0;
        foreach ($dataExport as $row) {
            $stt += 1;
            $arrTemp = [
                $stt,
                $row->fullname,
                $row->phone ? $row->phone : '',
                $row->email ? $row->email : ''
            ];
            if($row->sex == 1)
                $sex = 'Nam';
            elseif($row->sex == 2)
                $sex = 'Nữ';
            else
                $sex = 'Khác';

            array_push($arrTemp, $sex);
            $birtday = '';
            if($row->birtday)
                $birtday = date('d-m-Y', strtotime($row->birtday));

            array_push($arrTemp, $birtday);

            $collections->push($arrTemp);
        }

        return $collections;
    }
}
