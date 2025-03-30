<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        $subcategory = SubCategory::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Subcategory created successfully',
            'data' => $subcategory->load('category')
        ], 201);
    }

    public function update(Request $request, SubCategory $subCategory)
    {
        // Ensure we're updating a subcategory
        if (!$subCategory->category_id) {
            return response()->json([
                'success' => false,
                'message' => 'This is not a subcategory'
            ], 422);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $subCategory->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Subcategory updated successfully',
            'data' => $subCategory->load('category')
        ]);
    }

    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();

        return response()->json([
            'success' => true,
            'message' => 'Subcategory deleted successfully'
        ]);
    }
}