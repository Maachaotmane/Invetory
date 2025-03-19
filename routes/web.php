<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MeasureController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UnitController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/home', function () {
    return Inertia::render('', [
        'auth' => [
            'canLogin'    => Route::has('login'),
            'canRegister' => Route::has('register'),
        ],
        'versions' => [
            'laravel' => Application::VERSION,
            'php'     => PHP_VERSION,
        ],
    ]);
});



Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::put('/clients/{id}', [ClientController::class, 'update'])->name('clients.update');
    Route::post('/fournisseurs', [FournisseurController::class, 'store'])->name('fournisseurs.store');
    Route::put('/fournisseurs/{id}', [FournisseurController::class, 'update'])->name('fournisseurs.update');
    Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');
    Route::delete('/fournisseurs/{id}', [FournisseurController::class, 'destroy'])->name('fournisseurs.destroy');
    Route::get('/fournisseurs', [FournisseurController::class, 'index'])->name('fournisseurs.index');
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/families', [FamilyController::class, 'index'])->name('families.index');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::resource('categories', CategoryController::class);
    Route::resource('sub-categories', SubCategoryController::class);
    Route::resource('types', TypeController::class);
    Route::resource('measures', MeasureController::class);
    Route::resource('units', UnitController::class);
    Route::resource('brands', BrandController::class);
    Route::post('/product/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/categories/{category}/related', [CategoryController::class, 'getRelatedData']);
});

require __DIR__ . '/auth.php';
