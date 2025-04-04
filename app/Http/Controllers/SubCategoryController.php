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
            'data' => $subcategory
        ], 201);
    }

    public function update(Request $request, SubCategory $subCategory)
    {
        $subCategory = SubCategory::find($request->id);
        if (!$subCategory) {
            return response()->json([
                'success' => false,
                'message' => 'Subcategory not found'
            ], 404);
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);
        $subCategory->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Subcategory updated successfully',
            'data' => $subCategory
        ]);
    }

    public function destroy(int $id)
    {
        $subCategory = SubCategory::find($id);
        if (!$subCategory) {
            return response()->json([
                'success' => false,
                'message' => 'Subcategory not found'
            ], 404);
        }
        // Check if the subcategory is used in any products
        $subCategory->delete();

        return response()->json([
            'success' => true,
            'message' => 'Subcategory deleted successfully'
        ]);
    }
}