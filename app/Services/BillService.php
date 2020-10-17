<?php

namespace App\Services;


use App\Repositories\BillRepository;
use App\Repositories\CategoryProductRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

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
        $begin_date = Arr::get($searchParams, 'begin_date', '');
        $end_date = Arr::get($searchParams, 'end_date', '');
        $column = Arr::get($searchParams, 'column', '');
        $order = Arr::get($searchParams, 'order', '');
        if (!empty($keyword)) {
            $query->where('code', 'LIKE', '%' . $keyword . '%');
        }

        if (!empty($customer)) {

        }

        if(!empty($begin_date) && !empty($end_date))
        {

        }

        if ($order)
            $query->orderBy($column, $order);

        return $query->paginate($limit);
    }

    //service create data
    public function storeUpdateBill($data, int $id = null)
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
