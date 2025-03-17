<?php

namespace App\Http\Controllers;

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

class ProductController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('Product/ProductList', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    public function create(Request $request): Response
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
}
