<?php

namespace App\Services;


use App\Exports\BillExport;
use App\Repositories\BillRepository;
use App\Repositories\CategoryProductRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\ProductRepository;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class BillService
{
    private $billRepository;

    public function __construct(BillRepository $billRepository)
    {
        $this->billRepository = $billRepository;
    }

    public function getBills($searchParams = [])
    {
        $query = $this->billRepository->query();
        $limit = Arr::get($searchParams, 'raw', 10);
        $keyword = Arr::get($searchParams, 'keyword', '');
        $customer = Arr::get($searchParams, 'customer', '');
        $beginDate = Arr::get($searchParams, 'begin_date', '');
        $endDate = Arr::get($searchParams, 'end_date', '');
        $column = Arr::get($searchParams, 'column', '');
        $order = Arr::get($searchParams, 'order', '');
        $export = Arr::get($searchParams, 'export', '');
        if (!empty($keyword)) {
            $query->where('code', 'LIKE', '%' . $keyword . '%');
        }

        if (!empty($customer)) {
            $query->whereHas('customer', function ($q) use ($customer) {
                $q->where('fullname', 'LIKE', '%' . $customer . '%');
            });
        }

        if(!empty($beginDate))
            $query->whereDate('created_at', '>=', Carbon::parse($beginDate));
        if(!empty($endDate))
            $query->whereDate('created_at', '<=', Carbon::parse($endDate));

        if ($order)
            $query->orderBy($column, $order);

        if(!empty($export)){
            $dataExport = $query->get();
            $export = new BillExport();
            $export->dataExport = $this->billRepository->export($dataExport);
            return ['key' => 1, 'data' => $export];
        }

        return ['key' => 2, 'data' => $query->paginate($limit)];
    }

    //service create data
    public function storeUpdateBill($data, $id = null)
    {
        $bill = $this->billRepository->saveBill($data, $id);
        $bill->load('billDetail');
        $this->billRepository->saveBillDetail($data, $bill);
    }

    public function getCustomer()
    {
        $customerRepository = new CustomerRepository();
        return $customerRepository->all(['id', 'fullname']);
    }

    public function getCategoryProduct()
    {
        $categoryProductRepository = new CategoryProductRepository();
        return $categoryProductRepository->all(['id', 'name']);
    }

    public function getProductByCategory($categoryId)
    {
        $productRepository = new ProductRepository();
        return $productRepository->query()->where('category_id', $categoryId)->isNotDelete()->get(['id', 'name', 'price']);
    }
}
