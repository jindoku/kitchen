<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//clear cache
Route::get('clearcache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    return "Cache is cleared";
});

//login page
Route::get('/', function () {
    if (Auth::check()) {
        return redirect(route('staff.index'));
    } else {
        return redirect(route('login'));
    }
});

Route::get('view-bill', function (){
    return view('component.bill.view-bill');
});
Route::group(['middleware' => ['auth']], function () {
    Route::resources([
        //nhan vien route
        'staff' => StaffController::class,
        //khach hang route
        'customer' => CustomerController::class,
        //khach hang route
        'category-product' => CategoryProductController::class,
        //thiet bị route
        'product' => ProductController::class,
        //bill route
        'bill' => BillController::class,
    ]);
});

//Đăng nhập
Route::any('login', 'AuthController@login')->name('login');
//đăng xuất
route::get('logout', 'AuthController@logout')->name('get.logout');
