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
use App\Models\SubMeasure;
use App\Models\VariantImage;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request): Response
    {
        $searchQuery = $request->input('search');
        $brandId = $request->input('brand_id');
        $typeId = $request->input('type_id');
        $unitId = $request->input('unit_id');
        $categoryId = $request->input('category_id');
        $subCategoryId = $request->input('sub_category_id');
        $measureId = $request->input('measure_id');
        $subMeasureId = $request->input('sub_measure_id');

        $products = Product::query()
            ->with(['fournisseur', 'category', 'subCategory', 'images', 'variants', 'unit', 'brand', 'type', 'measure', 'subMeasure', 'user'])
            ->when($searchQuery, function ($query, $searchQuery) {
                $query->where('name', 'like', "%{$searchQuery}%")
                    ->orWhere('reference', 'like', "%{$searchQuery}%");
            })
            ->when($brandId, fn($query) => $query->where('brand_id', $brandId))
            ->when($typeId, fn($query) => $query->where('type_id', $typeId))
            ->when($unitId, fn($query) => $query->where('unit_id', $unitId))
            ->when($categoryId, fn($query) => $query->where('category_id', $categoryId))
            ->when($subCategoryId, fn($query) => $query->where('sub_category_id', $subCategoryId))
            ->when($measureId, fn($query) => $query->where('measure_id', $measureId))
            ->when($subMeasureId, fn($query) => $query->where('sub_measure_id', $subMeasureId))
            ->paginate(10);

        return Inertia::render('Product/ProductList', [
            'products' => $products,
            'categories' => Category::all(),
            'filters' => $request->only(['search', 'brand_id', 'type_id', 'category_id', 'sub_category_id', 'measure_id', 'sub_measure_id']),
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    public function view(int $id): Response
    {
        $product = Product::with(['fournisseur', 'category', 'subCategory', 'images', 'variants', 'unit', 'brand', 'type', 'measure', 'subMeasure', 'user'])->find($id);
        return Inertia::render('Product/ProductDetail', [
            'product' => $product,
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
        $subMeasures = SubMeasure::query()->where('category_id', $id)->get();

        return response()->json([
            'units' => $units,
            'brands' => $brands,
            'types' => $types,
            'measures' => $measures,
            'subCategories' => $subCategories,
            'subMeasures' => $subMeasures
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create([
            'category_id'      => $request->category_id,
            'fournisseur_id'   => $request->fournisseur_id,
            'unit_id'          => $request->unit_id,
            'brand_id'         => $request->brand_id,
            'type_id'          => $request->type_id,
            'measure_id'       => $request->measure_id,
            'sub_category_id'  => $request->sub_category_id,
            'sub_measure_id'   => $request->sub_measure_id,
            'name'             => $request->name,
            'reference'        => $request->reference,
            'description'      => $request->description,
            'created_by'       => auth()->user()->id
        ]);

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
                $productVariant = ProductVariant::create([
                    'product_id' => $product->id,
                    'variant' => $variant['variant'] ?? null,
                    'value' => $variant['value'] ?? null,
                    'quantity' => $variant['quantity'] ?? 0,
                    'quantity_alert' => $variant['quantity_alert'] ?? 0,
                    'price' => !empty($variant['price']) ? $variant['price'] : 0,
                    'buying_price' => !empty($variant['buying_price']) ? $variant['buying_price'] : 0,
                ]);

                if ($variant['images']) {
                    foreach ($variant['images'] as $image) {
                        $path = $this->saveBase64Image($image['url']);
                        VariantImage::create([
                            'variant_id' => $productVariant->id,
                            'name' => $path,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    function saveBase64Image($base64String, $folder = 'variant_images')
    {
        preg_match('/^data:image\/(\w+);base64,/', $base64String, $matches);
        $extension = $matches[1] ?? 'png';

        $base64Data = substr($base64String, strpos($base64String, ',') + 1);
        $base64Data = base64_decode($base64Data);

        $fileName = uniqid('image_') . '.' . $extension;
        $filePath = $folder . '/' . $fileName;

        Storage::disk('public')->put($filePath, $base64Data);

        return $filePath;
    }

    public function destroy(int $id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
