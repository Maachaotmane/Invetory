<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $categories = Category::all();
        return Inertia::render('Categories/Index', ['categories' => $categories]);
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return Inertia::render('Categories/Create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    // Display the specified resource.
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return Inertia::render('Categories/Show', ['category' => $category]);
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return Inertia::render('Categories/Edit', ['category' => $category]);
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }

    public function getRelatedData($categoryId)
    {
        // Find the category or return a 404 error if not found
        $category = Category::findOrFail($categoryId);

        // Load all related data
        $relatedData = [
            'category' => $category,
            'sub_categories' => $category->subCategories,
            'types' => $category->types,
            'measures' => $category->measures,
            'units' => $category->units,
            'brands' => $category->brands,
        ];

        // Return the data as a JSON response
        return response()->json($relatedData);
    }
}
