<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
        ]);

        $type = Type::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Subcategory created successfully',
            'data' => $type
        ], 201);
    }

    // Update the specified resource in storage.
    public function update(Request $request, Type $type)
    {
        // Ensure we're updating a subcategory
        if (!$type->category_id) {
            return response()->json([
                'success' => false,
                'message' => 'This is not a subcategory'
            ], 422);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        $type->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Subcategory updated successfully',
            'data' => $type
        ]);
    }

    public function destroy(Type $type)
    {
        // Ensure we're deleting a subcategory
        if (!$type->category_id) {
            return response()->json([
                'success' => false,
                'message' => 'This is not a subcategory'
            ], 422);
        }

        $type->delete();

        return response()->json([
            'success' => true,
            'message' => 'type deleted successfully'
        ]);
    }
}
