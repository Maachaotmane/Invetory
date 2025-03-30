<?php

namespace App\Http\Controllers;

use App\Models\Measure;
use Illuminate\Http\Request;

class MeasureController extends Controller
{

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
        ]);

        $measure = Measure::create($request->all());

        // return json response
        return response()->json([
            'success' => true,
            'message' => 'Measure created successfully',
            'data' => $measure
        ], 201);

    }

    public function update(Request $request, Measure $measure)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
        ]);

        $measure->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Measure updated successfully',
            'data' => $measure
        ]);
    }

    // Remove the specified resource from storage.
    public function destroy(Measure $measure)
    {
        $measure->delete();

        return response()->json([
            'success' => true,
            'message' => 'Measure deleted successfully'
        ]);
    }
}
