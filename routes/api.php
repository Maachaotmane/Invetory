<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;




// Route::middleware('auth')->group(function () {
    Route::get('/product/related-data/{id}', [ProductController::class, 'productRelatedData'])->name('product.productRelatedData');
// });