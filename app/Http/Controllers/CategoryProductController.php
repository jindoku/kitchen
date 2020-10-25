<?php

namespace App\Http\Controllers;

use App\CategoryProduct;
use App\Http\Requests\CategoryProductRequest;
use App\Services\CategoryProductServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryProductController extends Controller
{
    private $categoryProductService;
    public function __construct(CategoryProductServices $categoryProductServices)
    {
        $this->categoryProductService = $categoryProductServices;
    }

    public function index(Request $request)
    {
        $searchParams = $request->all();
        $categoryProducts = $this->categoryProductService->getCategoryProduct($searchParams);

        return view('component.category-product.index', compact('categoryProducts'));
    }


    public function create()
    {
        return view('component.category-product.create');
    }


    public function store(CategoryProductRequest $categoryProductRequest)
    {
        try{
            $data = $categoryProductRequest->all();
            $this->categoryProductService->storeCategoryProduct($data);
            return redirect()->route('category-product.index')->with(['status'=>'success','message'=>'Thêm mới thành công']);
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


    public function edit(CategoryProduct $categoryProduct)
    {
        return view('component.category-product.update', compact('categoryProduct'));
    }


    public function update(CategoryProductRequest $categoryProductRequest, $id)
    {
        try{
            $data = $categoryProductRequest->all();
            $this->categoryProductService->updateCategoryProduct($data, $id);
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
            $result = $this->categoryProductService->destroyCategoryProduct($id);
            switch ($result){
                case 'bill':
                    return response()->json([
                        'status' => 'warning',
                        'message' => 'Không thể xóa bản ghi đang tồn tại ở hóa đơn'
                    ], 200);
                    break;
                case 'product':
                    return response()->json([
                        'status' => 'warning',
                        'message' => 'Không thể xóa bản ghi đang tồn tại ở sản phẩm'
                    ], 200);
                    break;
                default:
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Xóa bản ghi thành công'
                    ], 200);
                    break;
            }
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
