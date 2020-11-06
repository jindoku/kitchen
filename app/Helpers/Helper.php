<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

if (!function_exists('generate_staff')) {
    function generate_staff()
    {
        try {
            $staff = DB::table('staff')->selectRaw('MAX(SUBSTR(code,3)) as code')->first();
            $sttCode = !empty($staff) ? (int)$staff->code : 0;
            $code = 'NV' . sprintf("%04s", $sttCode + 1);

            return $code;
        } catch (Exception $ex) {
            Log::error('Có lỗi sinh mã NV');
            abort(500, 'Có lỗi sinh mã NV');
        }
    }
}

if(!function_exists('list_number_page')){
    function list_number_page()
    {
        return ['0' => '10', '1' => '20', '2' => '30', '3' => '40'];
    }
}

if (!function_exists('generate_customer')) {
    function generate_customer()
    {
        try {
            $customer = DB::table('customer')->selectRaw('MAX(SUBSTR(code,3)) as code')->first();
            $sttCode = !empty($customer) ? (int)$customer->code : 0;
            $code = 'KH' . sprintf("%04s", $sttCode + 1);

            return $code;
        } catch (Exception $ex) {
            Log::error('Có lỗi sinh mã KH');
            abort(500, 'Có lỗi sinh mã KH');
        }
    }
}

if (!function_exists('generate_bill')) {
    function generate_bill()
    {
        try {
            $bill = DB::table('bill')->selectRaw('MAX(SUBSTR(code,3)) as code')->first();
            $sttCode = !empty($bill) ? (int)$bill->code : 0;
            $code = 'HD' . sprintf("%04s", $sttCode + 1);

            return $code;
        } catch (Exception $ex) {
            Log::error('Có lỗi sinh mã HĐ');
            abort(500, 'Có lỗi sinh mã HĐ');
        }
    }
}

if (!function_exists('generate_product')) {
    function generate_product()
    {
        try {
            $staff = DB::table('product')->selectRaw('MAX(SUBSTR(code,3)) as code')->first();
            $sttCode = !empty($staff) ? (int)$staff->code : 0;
            $code = 'SP' . sprintf("%04s", $sttCode + 1);

            return $code;
        } catch (Exception $ex) {
            Log::error('Có lỗi sinh mã SP');
            abort(500, 'Có lỗi sinh mã SP');
        }
    }
}

/* @Hàm get file name */
if (!function_exists('get_file_name')) {
    function get_file_name($pathFile)
    {
        return substr($pathFile, strrpos($pathFile, '/') + 1);
    }
}

if (!function_exists('generate_category_product')) {
    function generate_category_product()
    {
        try {
            $cateProduct = DB::table('category_product')->selectRaw('MAX(SUBSTR(code,4)) as code')->first();
            $sttCode = !empty($cateProduct) ? (int)$cateProduct->code : 0;
            $code = 'CSP' . sprintf("%04s", $sttCode + 1);

            return $code;
        } catch (Exception $ex) {
            Log::error('Có lỗi sinh mã danh mục sản phẩm');
            abort(500, 'Có lỗi sinh mã danh mục sản phẩm');
        }
    }
}
