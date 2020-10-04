<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffRequest;
use App\Services\StaffService;
use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class StaffController extends Controller
{
    private $staffService;

    public function __construct(StaffService $staffService)
    {
        $this->staffService = $staffService;
    }

    public function index(Request $request)
    {
        $searchParams = $request->all();
        $staffs = $this->staffService->getStaffs($searchParams);

        return view('component.staff.index', compact('staffs'));
    }

    public function create()
    {
        return view('component.staff.create');
    }

    public function store(StaffRequest $staffRequest)
    {
        try{
            $data = $staffRequest->all();
            $this->staffService->storeStaff($data);
            return redirect()->route('staff.index')->with(['status'=>'success','message'=>'Thêm mới thành công']);
        }
        catch (\Exception $ex)
        {
            Log::error($ex->getMessage());
            return back()->with(['status' => 'error', 'message' => 'Thêm mới NV không thành công']);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(Staff $staff)
    {
        return view('component.staff.update', compact('staff'));
    }

    public function update(StaffRequest $staffRequest, $id)
    {
        try{
            $data = $staffRequest->all();
            $this->staffService->updateStaff($data, $id);
            return redirect()->route('staff.index')->with(['status'=>'success','message'=>'Chỉnh sửa thành công']);
        }
        catch (\Exception $ex)
        {
            Log::error($ex->getMessage());
            return back()->with(['status' => 'error', 'message' => 'Chỉnh sửa NV không thành công']);
        }
    }

    public function destroy($id)
    {
        try{
            $this->staffService->destroyStaff($id);
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
