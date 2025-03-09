<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BrandController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $brands = Brand::all();
        return Inertia::render('Brands/Index', ['brands' => $brands]);
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return Inertia::render('Brands/Create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
        ]);

        Brand::create($request->all());

        return redirect()->route('brands.index')->with('success', 'Brand created successfully.');
    }

    // Display the specified resource.
    public function show($id)
    {
        $brand = Brand::findOrFail($id);
        return Inertia::render('Brands/Show', ['brand' => $brand]);
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return Inertia::render('Brands/Edit', ['brand' => $brand]);
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
        ]);

        $brand = Brand::findOrFail($id);
        $brand->update($request->all());

        return redirect()->route('brands.index')->with('success', 'Brand updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return redirect()->route('brands.index')->with('success', 'Brand deleted successfully.');
    }
}
