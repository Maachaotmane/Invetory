<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UnitController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $units = Unit::all();
        return Inertia::render('Units/Index', ['units' => $units]);
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return Inertia::render('Units/Create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
        ]);

        Unit::create($request->all());

        return redirect()->route('units.index')->with('success', 'Unit created successfully.');
    }

    // Display the specified resource.
    public function show($id)
    {
        $unit = Unit::findOrFail($id);
        return Inertia::render('Units/Show', ['unit' => $unit]);
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        $unit = Unit::findOrFail($id);
        return Inertia::render('Units/Edit', ['unit' => $unit]);
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
        ]);

        $unit = Unit::findOrFail($id);
        $unit->update($request->all());

        return redirect()->route('units.index')->with('success', 'Unit updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();

        return redirect()->route('units.index')->with('success', 'Unit deleted successfully.');
    }
}
