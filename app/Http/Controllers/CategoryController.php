<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // Get all categories with their subcategories
        $categories = Category::with('subcategories')
            ->get();
        
        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'x_axis' => 'nullable|string',
            'y_axis' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $category = Category::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Category created successfully',
            'data' => $category
        ], 201);
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'x_axis' => 'nullable|string',
            'y_axis' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully',
            'data' => $category
        ]);
    }

    public function destroy(Category $category)
    {
        // Prevent deletion if category has subcategories
        if ($category->subcategories()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete category with existing subcategories'
            ], 422);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully'
        ]);
    }

    //related data for category
    public function categoriesRelatedData()
    {
        $categories = Category::with('brands', 'units', 'types', 'measures', 'subCategories')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }
}