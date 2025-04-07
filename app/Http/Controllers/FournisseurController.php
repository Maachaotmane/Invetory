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

        if ($request->has('searchFournisseur')) {
            $search = $request->input('searchFournisseur');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('C_I_N', 'like', "%{$search}%");

        }

        $fournisseurs = $query->paginate(10);

        return $fournisseurs;
    }

    public function getAll(Request $request)
    {
        $query = Fournisseur::query();

        if ($request->has('searchFournisseur')) {
            $search = $request->input('searchFournisseur');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('C_I_N', 'like', "%{$search}%");
        }

        $fournisseurs = $query->get();

        return $fournisseurs;
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
<<<<<<< Updated upstream
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|string|email|max:255|unique:fournisseurs,email',
=======
            'email' => 'nullable|string|email|max:255|unique:fournisseurs',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
>>>>>>> Stashed changes
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'credit_limit' => 'nullable|numeric',
            'total_due_amount' => 'nullable|numeric',
            'I_F' => 'nullable|string|max:255',
            'R_C' => 'nullable|string|max:255',
            'I_C_E' => 'nullable|string|max:255',
            'C_N_S_S' => 'nullable|string|max:255',
            'C_I_N' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'C_I_N_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_image')) {
            $profileImagePath = $request->file('profile_image')->store('fournisseur_profile_images', 'public');
            $validatedData['profile_image'] = $profileImagePath;
        }

        if ($request->hasFile('C_I_N_image')) {
            $cinImagePath = $request->file('C_I_N_image')->store('fournisseur_cin_images', 'public');
            $validatedData['C_I_N_image'] = $cinImagePath;
        }

        $validatedData['created_by'] = auth()->id();
        Fournisseur::create($validatedData);

        return redirect()->route('home.index')->with('success', 'Fournisseur created successfully!');
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

<<<<<<< Updated upstream
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|string|email|max:255|unique:fournisseurs,email,' . $fournisseur->id,
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'created_by' => 'required|integer|exists:users,id',
            'I_F' => 'nullable|string|max:255',
            'R_C' => 'nullable|string|max:255',
            'I_C_E' => 'nullable|string|max:255',
            'C_N_S_S' => 'nullable|string|max:255',
            'C_I_N' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'C_I_N_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fournisseur->update($validatedData);

        return redirect()->route('home.index');
    }
=======
     public function update(Request $request, int $id)
     {
         $fournisseur = Fournisseur::findOrFail($id);
 
         $validatedData = $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'nullable|string|email|max:255|unique:fournisseurs,email,' . $fournisseur->id,
             'address' => 'nullable|string|max:255',
             'phone' => 'nullable|string|max:255',
             'city' => 'nullable|string|max:255',
             'country' => 'nullable|string|max:255',
             'created_by' => 'required|exists:users,id',
             'credit_limit' => 'nullable|numeric',
             'total_due_amount' => 'nullable|numeric',
             'I_F' => 'nullable|string|max:255',
             'R_C' => 'nullable|string|max:255',
             'I_C_E' => 'nullable|string|max:255',
             'C_N_S_S' => 'nullable|string|max:255',
             'C_I_N' => 'nullable|string|max:255',
             'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
             'C_I_N_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
         ]);
 
         if ($request->hasFile('profile_image')) {
             if ($fournisseur->profile_image) {
                 Storage::disk('public')->delete($fournisseur->profile_image);
             }
 
             $profileImagePath = $request->file('profile_image')->store('fournisseur_profile_images', 'public');
             $validatedData['profile_image'] = $profileImagePath;
         } else {
             $validatedData['profile_image'] = $fournisseur->profile_image;
         }
 
         if ($request->hasFile('C_I_N_image')) {
             if ($fournisseur->C_I_N_image) {
                 Storage::disk('public')->delete($fournisseur->C_I_N_image);
             }
 
             $cinImagePath = $request->file('C_I_N_image')->store('fournisseur_cin_images', 'public');
             $validatedData['C_I_N_image'] = $cinImagePath;
         } else {
             $validatedData['C_I_N_image'] = $fournisseur->C_I_N_image;
         }
 
         $fournisseur->update($validatedData);
 
         return redirect()->route('home.index')->with('success', 'Fournisseur updated successfully!');
     }
>>>>>>> Stashed changes

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $fournisseur = Fournisseur::findOrFail($id);
        $fournisseur->delete();

        return redirect()->route('home.index');
    }
}
