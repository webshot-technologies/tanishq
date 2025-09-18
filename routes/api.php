<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\JewelleryPositionController;

// Jewellery position management routes
Route::post('/jewellery/save-positions', [JewelleryPositionController::class, 'savePositions']);
Route::get('/jewellery/load-positions', [JewelleryPositionController::class, 'loadPositions']);


