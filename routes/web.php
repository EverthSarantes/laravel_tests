<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\ProductsController;

Route::get('/', [BrandsController::class, 'index'])->name('brands.index');

Route::prefix('brands')->group(function () {
    Route::get('index', [BrandsController::class, 'index'])->name('brands.index');
    Route::get('show/{brand}', [BrandsController::class, 'show'])->name('brands.show');
    Route::post('store', [BrandsController::class, 'store'])->name('brands.store');
    Route::put('update/{brand}', [BrandsController::class, 'update'])->name('brands.update');
    Route::delete('delete/{brand}', [BrandsController::class, 'delete'])->name('brands.delete');
});

Route::prefix('products')->group(function () {
    Route::post('store', [ProductsController::class, 'store'])->name('products.store');
    Route::delete('delete/{product}', [ProductsController::class, 'delete'])->name('products.delete');
});
