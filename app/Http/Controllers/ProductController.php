<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
            $this->productService->storeProduct($productRequest);
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
        $base64 = '';
        if($product->thumb){
            $content = Storage::disk('public')->get($product->thumb);
            $base64 = base64_encode($content);
        }

        return view('component.product.update', compact('categoryProduct', 'product', 'base64'));
    }


    public function update(ProductRequest $productRequest, $id)
    {
        try{
            $this->productService->updateProduct($productRequest, $id);
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
            $result = $this->productService->destroyProduct($id);
            if($result === 'bill')
                return response()->json([
                    'status' => 'warning',
                    'message' => 'Không thể xóa bản ghi đang tồn tại ở hóa đơn'
                ], 200);

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
