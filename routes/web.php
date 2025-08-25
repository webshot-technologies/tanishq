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
Route::get('wishlist', 'viewWishlist')->name('wishlist.page');
Route::get('/wishlist/share/{username}/{user_id}/{shareId?}', 'shareWishlist')->name('wishlist.share');


    });

// Product details page
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.details');
// Route::post('/users/{user_id}/wishlist', [SiteController::class, 'addToWishlist']);
// Route::post('users/{user_id}/wishlist', [SiteController::class, 'addToWishlist']);

Route::post('users/{user_id}/wishlist', [SiteController::class, 'addToWishlist'])->name('wishlist.add');

// Remove from wishlist
Route::delete('users/{user_id}/wishlist', [SiteController::class, 'removeFromWishlist'])->name('wishlist.remove');
Route::post('/refresh', [SiteController::class, 'refreshToken']);
