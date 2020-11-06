<?php

namespace App\Services;

use App\Bill;
use App\Exports\CustomerExport;
use App\Repositories\CustomerRepository;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;


class CustomerService{
    private $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function getCustomers($searchParams = [])
    {
        $query = $this->customerRepository->query();
        $limit = Arr::get($searchParams, 'raw', 10);
        $keyword = Arr::get($searchParams, 'keyword', '');
        $column = Arr::get($searchParams, 'column', 'created_at');
        $order = Arr::get($searchParams, 'order', 'desc');
        $export = Arr::get($searchParams, 'export', '');
        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('phone', 'LIKE', '%' . $keyword . '%');
                $q->orWhere('fullname', 'LIKE', '%' . $keyword . '%');
            });
        }

        if ($order)
            $query->orderBy($column, $order);

        if(!empty($export)){
            $dataExport = $query->get();
            $export = new CustomerExport();
            $export->dataExport = $this->customerRepository->export($dataExport);
            return ['key' => 1, 'data' => $export];
        }

        return ['key' => 2, 'data' => $query->paginate($limit)];
    }

    //service create data
    public function storeCustomer($data)
    {
        $this->customerRepository->save($data);
    }

    public function updateCustomer($data, $id)
    {
        $this->customerRepository->save($data, $id);
    }

    public function destroyCustomer($id)
    {
        $countBillByCustomer = Bill::where('customer_id', $id)->count();
        if($countBillByCustomer > 0)
            return 'bill';

        $customer = $this->customerRepository->get($id);
        $customer->delete();

        return 'success';
    }
}
