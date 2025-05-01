<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\SaleCategoryController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Route for the dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('sales', SaleController::class);
Route::resource('sale_categories', SaleCategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('regions', RegionController::class);