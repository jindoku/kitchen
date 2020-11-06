<?php

namespace App\Repositories;


use App\Bill;
use App\BillDetail;
use Illuminate\Database\Eloquent\Collection;
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

    public function saveBill($data, $id)
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

    public function export($dataExport)
    {
        $collections = new Collection();
        $stt = 0;
        foreach ($dataExport as $row) {
            $stt += 1;
            $arrTemp = [
                $stt,
                $row->code,
                $row->customer->fullname,
                $row->staff->fullname,
                date('d-m-Y', strtotime($row->created_at)),
                $row->note ? $row->note : '',
            ];

            $collections->push($arrTemp);
        }

        return $collections;
    }
}
