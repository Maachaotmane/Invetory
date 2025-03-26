<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Inertia\Inertia;

class StockStatsController extends Controller
{
    public function index()
{
    // Load categories with all necessary relationships
    $categories = Category::with([
        'measures', 
        'units', 
        'brands', 
        'types',
        'products.measure',
        'products.unit',
        'products.brand',
        'products.type'
    ])
    ->whereNotNull('x_axis')
    ->whereNotNull('y_axis')
    ->get()
    ->map(function ($category) {
        return [
            'id' => $category->id,
            'name' => $category->name,
            'x_axis' => $category->x_axis,
            'y_axis' => $category->y_axis,
            'x_items' => $category->{$category->x_axis}->map(function($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name
                ];
            }),
            'y_items' => $category->{$category->y_axis}->map(function($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name
                ];
            }),
            'products' => $category->products->map(function($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'measure_id' => $product->measure_id,
                    'unit_id' => $product->unit_id,
                    'brand_id' => $product->brand_id,
                    'type_id' => $product->type_id,
                    'reference' => $product->reference,
                    'description' => $product->description,
                    'quantity' => $product->isVariant() ? $product->variants->sum('quantity') : $product->variants->first()->quantity,
                    'category' => $product->category ? $product->category->name : "--",
                    'measure' => $product->measure ? $product->measure->name : "--",
                    'unit' => $product->unit ? $product->unit->name : "--",
                    'brand' => $product->brand ? $product->brand->name : "--",
                    'type' => $product->type ? $product->type->name : "--",
                ];
            }),
            'product_count' => $category->products->count(),
        ];
    });

    return Inertia::render('Stock/Etat', [
        'categories' => $categories,
        'axis_options' => [
            'measures' => 'Measures',
            'units' => 'Units',
            'brands' => 'Brands',
            'types' => 'Types'
        ]
    ]);
}
}
