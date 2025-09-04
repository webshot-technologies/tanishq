<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SiteController;

Route::get('/', function () {
    return view('welcome');
})->name('home');


  Route::controller(SiteController::class)->group(function() {


    Route::post('product-list', 'productChoose')->name('productChoose');
    Route::get('product', 'product_list')->name('list.product');
    Route::get('product/recommended-products', 'recommended_products')->name('recommended.products');
    Route::get('product/product-list', 'product_show')->name('product.list');
    Route::get('product/category-list', 'category_list')->name('category.list');
    Route::get('product/full-catalogue', 'full_catalogue')->name('full.catalogue');
    Route::get('wishlist', 'viewWishlist')->name('wishlist.page');
    Route::middleware(['web'])->get('wishlist/share/{username}/{user_id}/{shareId}', 'viewWishlist')->name('wishlist.share');
    // shared person full catalogue
    Route::get('product/full-catalogue/{username}/{user_id}/{wishlist_id}', 'shared_full_catalogue')->name('shared.full.catalogue');
    });

// Product details page
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.details');
// Route::post('/users/{user_id}/wishlist', [SiteController::class, 'addToWishlist']);
// Route::post('users/{user_id}/wishlist', [SiteController::class, 'addToWishlist']);

Route::post('users/{user_id}/wishlist', [SiteController::class, 'addToWishlist'])->name('wishlist.add');
// Like wishlist item (proxy for frontend)
Route::post('users/{share_id}/wishlist/items/like', [SiteController::class, 'likeWishlistItem'])->name('wishlist.like');

// Dislike wishlist item (proxy for frontend)
Route::post('users/{ownerId}/wishlist/items/dislike', [SiteController::class, 'dislikeWishlistItem'])->name('wishlist.dislike');

// Remove from wishlist
Route::delete('users/{ownerId}/wishlist', [SiteController::class, 'removeFromWishlist'])->name('wishlist.remove');
Route::post('/refresh', [SiteController::class, 'refreshToken']);
// Route::post('user/create', [SiteController::class, 'createUserAfterOtp'])->name('user.create');
Route::middleware(['web'])->post('user/create', [SiteController::class, 'createUserAfterOtp'])->name('user.create');

Route::post('/wishlist/recommend', [SiteController::class, 'recommendWishlistItem'])->name('wishlist.recommend');
Route::get('/wishlist/partial', [App\Http\Controllers\SiteController::class, 'wishlistPartial'])->name('wishlist.partial');
