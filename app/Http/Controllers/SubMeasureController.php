<?php

namespace App\Http\Controllers;

use App\Models\SubMeasure;
use Illuminate\Http\Request;

class SubMeasureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
        ]);

        $subMeasure = SubMeasure::create($request->all());

        // return json response
        return response()->json([
            'success' => true,
            'message' => 'Sub Measure created successfully',
            'data' => $subMeasure
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(SubMeasure $subMeasure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubMeasure $subMeasure)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubMeasure $subMeasure)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
        ]);

        $subMeasure->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Sub Measure updated successfully',
            'data' => $subMeasure
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubMeasure $subMeasure)
    {
        $subMeasure->delete();

        return response()->json([
            'success' => true,
            'message' => 'Sub Measure deleted successfully'
        ]);
    }
}
