<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    private $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $searchParams = $request->all();
        $products = $this->productService->getProducts($searchParams);
        $categoryProduct = $this->productService->getCategoryProduct();

        return view('component.product.index', compact('products', 'categoryProduct'));
    }


    public function create()
    {
        $categoryProduct = $this->productService->getCategoryProduct();

        return view('component.product.create', compact('categoryProduct'));
    }


    public function store(ProductRequest $productRequest)
    {
        try{
            $data = $productRequest->all();
            $this->productService->storeProduct($data);
            return redirect()->route('product.index')->with(['status'=>'success','message'=>'Thêm mới thành công']);
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


    public function edit(Product $product)
    {
        $categoryProduct = $this->productService->getCategoryProduct();

        return view('component.product.update', compact('categoryProduct', 'product'));
    }


    public function update(ProductRequest $productRequest, $id)
    {
        try{
            $data = $productRequest->all();
            $this->productService->updateProduct($data, $id);
            return redirect()->route('product.index')->with(['status'=>'success','message'=>'Chỉnh sửa thành công']);
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
            $this->productService->destroyProduct($id);
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
