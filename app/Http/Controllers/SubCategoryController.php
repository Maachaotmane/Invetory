<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubCategoryController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $subCategories = SubCategory::with('category')->get();
        return Inertia::render('SubCategories/Index', ['subCategories' => $subCategories]);
    }

    // Show the form for creating a new resource.
    public function create()
    {
        $categories = Category::all();
        return Inertia::render('SubCategories/Create', ['categories' => $categories]);
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
        ]);

        SubCategory::create($request->all());

        return redirect()->route('sub-categories.index')->with('success', 'SubCategory created successfully.');
    }

    // Display the specified resource.
    public function show($id)
    {
        $subCategory = SubCategory::with('category')->findOrFail($id);
        return Inertia::render('SubCategories/Show', ['subCategory' => $subCategory]);
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $categories = Category::all();
        return Inertia::render('SubCategories/Edit', ['subCategory' => $subCategory, 'categories' => $categories]);
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
        ]);

        $subCategory = SubCategory::findOrFail($id);
        $subCategory->update($request->all());

        return redirect()->route('sub-categories.index')->with('success', 'SubCategory updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->delete();

        return redirect()->route('sub-categories.index')->with('success', 'SubCategory deleted successfully.');
    }
}
