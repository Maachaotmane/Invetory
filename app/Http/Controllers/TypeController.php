<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TypeController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $types = Type::all();
        return Inertia::render('Types/Index', ['types' => $types]);
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return Inertia::render('Types/Create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
        ]);

        Type::create($request->all());

        return redirect()->route('types.index')->with('success', 'Type created successfully.');
    }

    // Display the specified resource.
    public function show($id)
    {
        $type = Type::findOrFail($id);
        return Inertia::render('Types/Show', ['type' => $type]);
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        $type = Type::findOrFail($id);
        return Inertia::render('Types/Edit', ['type' => $type]);
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
        ]);

        $type = Type::findOrFail($id);
        $type->update($request->all());

        return redirect()->route('types.index')->with('success', 'Type updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $type = Type::findOrFail($id);
        $type->delete();

        return redirect()->route('types.index')->with('success', 'Type deleted successfully.');
    }
}
