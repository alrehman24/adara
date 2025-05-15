<?php

use App\Http\Controllers\Admin\HomeBannerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\sizeController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;

use App\Http\Controllers\ColorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/dashboard', function () {
    return view('admin.index');
});
///profile section
Route::get('/profile', [ProfileController::class, 'index']);
Route::post('/saveProfile', [ProfileController::class, 'store']);
// home banner
Route::get('/home_banner', [HomeBannerController::class,'index']);
Route::post('/home_banner', [HomeBannerController::class,'store']);

// size
Route::get('/manage_size', [sizeController::class,'index']);
Route::post('/updatesize', [sizeController::class,'store']);
//color
Route::get('/manage_size', [ColorController::class,'index']);
Route::post('/updatesize', [ColorController::class,'store']);

//Attribute

Route::get('/attribute_value', [AttributeController::class,'index_attribute_value']);
Route::post('/update_attribute_value', [AttributeController::class,'store_attribute_value']);

//Category
Route::get('/category', [CategoryController::class,'index']);
Route::post('/category', [CategoryController::class,'store']);

// Category Attribute
Route::get('/category_attribute', [CategoryController::class,'index_category_attribute']);
Route::post('/category_attribute', [CategoryController::class,'store_category_attribute']);

//Brand
Route::get('/brand', [BrandController::class ,'index']);
Route::post('/brand', [BrandController::class,'store']);

//Tax
Route::get('/tax', [TaxController::class ,'index']);
Route::post('/tax', [TaxController::class,'store']);

//Product
Route::get('/product', [ProductController::class ,'index']);
Route::get('/manage_product/{id}', [ProductController::class ,'view_product']);
Route::post('/updateproduct', [ProductController::class,'store']);


// delete data
Route::get('deleteData/{id}/{table}', [DashboardController::class,'deleteData']);

