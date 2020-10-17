<?php

namespace App\Repositories;


use App\Bill;
use App\BillDetail;
use Illuminate\Support\Facades\Auth;

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

    public function saveBill($data, int $id = null)
    {
        $userId = Auth::id();
        $arrBill = [
            'code' => $data['code'],
            'customer_id' => $data['customer_id'],
            'staff_id' => $userId,
            'note' => $data['note'] ? $data['note'] : null
        ];

        if ($id)
            $arrBill['updated_by'] = $userId;
        else
            $arrBill['created_by'] = $userId;


        return Bill::updateOrCreate(
            ['id' => $id],
            $arrBill
        );
    }

    public function saveBillDetail($data, $bill)
    {
        $userId = Auth::id();
        if ($bill->billDetail->count() > 0)
            BillDetail::where('bill_id', $bill->id)->delete();

        for ($i = 1; $i <= $data['total_row']; $i++) {
            BillDetail::create([
                'bill_id' => $bill->id,
                'category_product_id' => $data['category_id_' . $i],
                'product_id' => $data['product_id_' . $i],
                'amount' => $data['count_product_' . $i],
                'created_by' => $userId,
                'updated_by' => $userId
            ]);
        }
    }
}
