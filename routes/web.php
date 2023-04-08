<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DefaultController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/products',ProductController::class);
Route::resource('/purchases',PurchaseController::class);
Route::resource('/invoices',InvoiceController::class);
Route::resource('/stocks',StockController::class);

Route::get('/get-category',[DefaultController::class,'getCategory'])->name('get-category');
Route::get('/get-product',[DefaultController::class,'getProduct'])->name('get-product');
Route::get('/check-product-stock',[DefaultController::class,'checkProductStock'])->name('check-product-stock');
Route::get('/get-cat-product',[DefaultController::class,'getCatProduct'])->name('get-cat-product');
Route::get('/get-all-product',[DefaultController::class,'getAllProduct'])->name('get-all-product');

