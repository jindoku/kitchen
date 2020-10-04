<?php

namespace App\Repositories;


use App\Bill;

class BillRepository
{
    public function get($id)
    {
        return Bill::find($id);
    }

    public function all($columns = ['*'])
    {
        return Bill::get($columns);
    }

    public function findBy($column, $value)
    {
        return Bill::where([$column => $value])->first();
    }

    public function query()
    {
        return Bill::query();
    }

    public function save($data, int $id = null)
    {
        $arrBill = [
            'code' => $data['code'],
            'customer_id' => $data['customer_id'],
            'staff_id' => $data['staff_id'],
            'note' => $data['note'] ? $data['note'] : null
        ];

        return Bill::updateOrCreate(
            ['id' => $id],
            $arrBill
        );
    }
}
