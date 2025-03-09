<?php

namespace App\Http\Controllers;

use App\Models\Measure;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MeasureController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $measures = Measure::all();
        return Inertia::render('Measures/Index', ['measures' => $measures]);
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return Inertia::render('Measures/Create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
        ]);

        Measure::create($request->all());

        return redirect()->route('measures.index')->with('success', 'Measure created successfully.');
    }

    // Display the specified resource.
    public function show($id)
    {
        $measure = Measure::findOrFail($id);
        return Inertia::render('Measures/Show', ['measure' => $measure]);
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        $measure = Measure::findOrFail($id);
        return Inertia::render('Measures/Edit', ['measure' => $measure]);
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
        ]);

        $measure = Measure::findOrFail($id);
        $measure->update($request->all());

        return redirect()->route('measures.index')->with('success', 'Measure updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $measure = Measure::findOrFail($id);
        $measure->delete();

        return redirect()->route('measures.index')->with('success', 'Measure deleted successfully.');
    }
}
