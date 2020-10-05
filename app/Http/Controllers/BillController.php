<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Services\BillService;
use Illuminate\Http\Request;

class BillController extends Controller
{
    private $billService;

    public function __construct(BillService $billService)
    {
        $this->billService = $billService;
    }

    public function index(Request $request)
    {
        $searchParams = $request->all();
        $bills = $this->billService->getBills($searchParams);

        return view('component.bill.index', compact('bills'));
    }


    public function create()
    {
        $customers = $this->billService->getCustomer();
        $categoryProducts = $this->billService->getCategoryProduct();
        return view('component.bill.create', compact('customers', 'categoryProducts'));
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit(Bill $bill)
    {
        $customers = $this->billService->getCustomer();
        return view('component.bill.update', compact('bill','customers'));
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function getCategoryProduct()
    {
        $categoryProducts = $this->billService->getCategoryProduct();
        return response()->json($categoryProducts, 200);
    }

    public function getProductByCategory(Request $request)
    {
        $categoryId = !empty($request->category_id) ? $request->category_id : 0;
        $productByCategory = $this->billService->getProductByCategory($categoryId);

        return response()->json($productByCategory, 200);
    }
}
