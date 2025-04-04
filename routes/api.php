<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MeasureController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SubMeasureController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;




// Route::middleware('auth')->group(function () {
    Route::get('/product/related-data/{id}', [ProductController::class, 'productRelatedData'])->name('product.productRelatedData');
// });

Route::prefix('categories')->group(function () {
    // Get all categories and subcategories
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/categories-with-attributes', [CategoryController::class, 'categoriesRelatedData']);
    
    // Create new category
    Route::post('/', [CategoryController::class, 'store']);
    
    // Update category
    Route::put('/{category}', [CategoryController::class, 'update']);
    
    // Delete category
    Route::delete('/{category}', [CategoryController::class, 'destroy']);
    
});

Route::resource('subcategories', SubCategoryController::class);
Route::resource('types', TypeController::class);
Route::resource('measures', MeasureController::class);
Route::resource('sub-measures', SubMeasureController::class);
Route::resource('units', UnitController::class);
Route::resource('brands', BrandController::class);