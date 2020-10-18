<?php

namespace App\Services;

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
        $column = Arr::get($searchParams, 'column', '');
        $order = Arr::get($searchParams, 'order', '');
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
        $customer = $this->customerRepository->get($id);
        $customer->update([
            'deleted_by' => Auth::id(),
            'deleted_at' => Carbon::now()
        ]);
    }
}
