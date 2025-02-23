<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Fournisseur::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        $fournisseurs = $query->paginate(10);

        return view('fournisseurs.index', compact('fournisseurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('fournisseurs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|string|email|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'created_by' => 'required|integer',
        ]);

        Fournisseur::create($validatedData);

        return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $fournisseur = Fournisseur::findOrFail($id);

        return view('fournisseurs.show', compact('fournisseur'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $fournisseur = Fournisseur::findOrFail($id);

        return view('fournisseurs.edit', compact('fournisseur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fournisseur $fournisseur)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|string|email|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'created_by' => 'required|integer',
        ]);

        $fournisseur->update($validatedData);

        return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $fournisseur = Fournisseur::findOrFail($id);
        $fournisseur->delete();

        return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur deleted successfully.');
    }
}
