<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Http\Requests\BillRequest;
use App\Services\BillService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

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
        $servicebills = $this->billService->getBills($searchParams);
        $bills = $servicebills['data'];
        if($servicebills['key'] == 1)
            return Excel::download($bills, 'danh-sach-hoa-don.xlsx');

        return view('component.bill.index', compact('bills'));
    }


    public function create()
    {
        $customers = $this->billService->getCustomer();
        $categoryProducts = $this->billService->getCategoryProduct();
        return view('component.bill.create', compact('customers', 'categoryProducts'));
    }


    public function store(BillRequest $billRequest)
    {
        try{
            $data = $billRequest->all();
            DB::beginTransaction();
            $this->billService->storeUpdateBill($data);
            DB::commit();
            return redirect()->route('bill.index')->with(['status'=>'success','message'=>'Thêm mới thành công']);
        }
        catch (\Exception $ex)
        {
            Log::error($ex->getMessage());
            return back()->with(['status' => 'error', 'message' => 'Thêm mới không thành công']);
        }
    }


    public function show(Bill $bill)
    {
        return view('component.bill.view-bill', compact('bill'));
    }


    public function edit(Bill $bill)
    {
        $customers = $this->billService->getCustomer();
        $categoryProducts = $this->billService->getCategoryProduct();
        return view('component.bill.update', compact('bill','customers', 'categoryProducts'));
    }


    public function update(BillRequest $billRequest, Bill $bill)
    {
        try{
            $data = $billRequest->all();
            $this->billService->storeUpdateBill($data, $bill->id);
            DB::beginTransaction();
            $this->billService->storeUpdateBill($data, $bill->id);
            DB::commit();
            return redirect()->route('bill.index')->with(['status'=>'success','message'=>'Chỉnh sửa thành công']);
        }
        catch (\Exception $ex)
        {
            Log::error($ex->getMessage());
            return back()->with(['status' => 'error', 'message' => 'Chỉnh sửa không thành công']);
        }
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
