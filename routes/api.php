<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('get-category-product', 'BillController@getCategoryProduct');
Route::get('get-product-by-category/{category_id}', 'BillController@getProductByCategory');
