<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SiteController;

Route::get('/', function () {
    return view('welcome');
});


  Route::controller(SiteController::class)->group(function() {


    Route::post('product-list', 'productChoose')->name('productChoose');
    Route::get('product/', 'product_list')->name('list.product');
    Route::get('product/recommended-products', 'recommended_products')->name('recommended.products');
    Route::get('product/category-list', 'category_list')->name('category.list');
    Route::get('product/full-catalogue', 'full_catalogue')->name('full.catalogue');


    });

// Product details page
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.details');
