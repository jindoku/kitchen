<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\CustomerRequest;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    private $customerService;
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index(Request $request)
    {
        $searchParams = $request->all();
        $customers = $this->customerService->getCustomers($searchParams);

        return view('component.customer.index', compact('customers'));
    }

    public function create()
    {
        return view('component.customer.create');
    }


    public function store(CustomerRequest $customerRequest)
    {
        try{
            $data = $customerRequest->all();
            $this->customerService->storeCustomer($data);
            return redirect()->route('customer.index')->with(['status'=>'success','message'=>'Thêm mới thành công']);
        }
        catch (\Exception $ex)
        {
            Log::error($ex->getMessage());
            return back()->with(['status' => 'error', 'message' => 'Thêm mới không thành công']);
        }
    }


    public function show($id)
    {
        //
    }


    public function edit(Customer $customer)
    {
        return view('component.customer.update', compact('customer'));
    }


    public function update(CustomerRequest $customerRequest, $id)
    {
        try{
            $data = $customerRequest->all();
            $this->customerService->updateCustomer($data, $id);
            return redirect()->route('customer.index')->with(['status'=>'success','message'=>'Chỉnh sửa thành công']);
        }
        catch (\Exception $ex)
        {
            Log::error($ex->getMessage());
            return back()->with(['status' => 'error', 'message' => 'Chỉnh sửa không thành công']);
        }
    }


    public function destroy($id)
    {
        try{
            $this->customerService->destroyCustomer($id);
            return response()->json([
                'status' => 'success',
                'message' => 'Xóa bản ghi thành công'
            ], 200);
        }
        catch (\Exception $ex)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Có lỗi xảy ra'
            ], 500);
        }
    }
}
