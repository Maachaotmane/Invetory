<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Fournisseur;
use App\Models\Measure;
use App\Models\SubCategory;
use App\Models\Type;
use App\Models\Unit;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;

class ProductController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('Product/ProductList', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    public function create(): Response
    {
        $categories = Category::all();
        $fournisseurs = Fournisseur::all();

        return Inertia::render('Product/CreateProduct', [
            'categories' => $categories,
            'fournisseurs' => $fournisseurs,
        ]);
    }

    public function productRelatedData(int $id)
    {
        $units = Unit::query()->where('category_id', $id)->get();
        $brands = Brand::query()->where('category_id', $id)->get();
        $types = Type::query()->where('category_id', $id)->get();
        $measures = Measure::query()->where('category_id', $id)->get();
        $subCategories = SubCategory::query()->where('category_id', $id)->get();

        return response()->json([
            'units' => $units,
            'brands' => $brands,
            'types' => $types,
            'measures' => $measures,
            'subCategories' => $subCategories
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->only([
            'category_id',
            'fournisseur_id',
            'unit_id',
            'brand_id',
            'type_id',
            'measure_id',
            'sub_category_id',
            'store_id',
            'reference',
            'name',
            'description'
        ]));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'name' => $path,
                ]);
            }
        }

        if ($request->variants) {
            foreach ($request->variants as $variant) {
                ProductVariant::create([
                    'product_id' => $product->id,
                    'variant' => $variant['variant'] ?? null,
                    'quantity' => $variant['quantity'] ?? 0,
                    'quantity_alert' => $variant['quantity_alert'] ?? 0,
                    'price' => $variant['price'] ?? 0,
                    'buying_price' => $variant['buying_price'] ?? 0,
                ]);
            }
        }

        return $this->index($request);
    }
}
