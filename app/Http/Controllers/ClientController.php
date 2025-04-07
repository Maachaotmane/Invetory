<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource with search by name, email and pagination.
     */
    public function index(Request $request)
    {
        $query = Client::query();

        if ($request->has('searchClient')) {
            $search = $request->input('searchClient');
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('C_I_N', 'like', "%{$search}%");
        }

        $clients = $query->paginate(10);

        return $clients;
    }

    /**
     * Display a listing of the resource with search by name, email and pagination.
     */
    public function getAll(Request $request)
    {
        $query = Client::query();

        if ($request->has('searchClient')) {
            $search = $request->input('searchClient');
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('C_I_N', 'like', "%{$search}%");
        }

        $clients = $query->orderByRaw('COALESCE(credit_limit, 0) - COALESCE(total_due_amount, 0) asc')->get();

        return $clients;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:clients',
<<<<<<< Updated upstream
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
=======
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
            $profileImagePath = $request->file('profile_image')->store('client_profile_images', 'public');
            $validatedData['profile_image'] = $profileImagePath;
        }

        if ($request->hasFile('C_I_N_image')) {
            $cinImagePath = $request->file('C_I_N_image')->store('client_cin_images', 'public');
            $validatedData['C_I_N_image'] = $cinImagePath;
        }

        $validatedData['created_by'] = auth()->id();
        Client::create($validatedData);

        return redirect()->route('home.index')->with('success', 'Client created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $client = Client::findOrFail($id);
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $client = Client::findOrFail($id);
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $client = Client::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:clients,email,' . $client->id,
<<<<<<< Updated upstream
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
=======
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
>>>>>>> Stashed changes
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
            if ($client->profile_image) {
                Storage::disk('public')->delete($client->profile_image);
            }

            $profileImagePath = $request->file('profile_image')->store('client_profile_images', 'public');
            $validatedData['profile_image'] = $profileImagePath;
        } else {
            $validatedData['profile_image'] = $client->profile_image;
        }

        if ($request->hasFile('C_I_N_image')) {
            if ($client->C_I_N_image) {
                Storage::disk('public')->delete($client->C_I_N_image);
            }

            $cinImagePath = $request->file('C_I_N_image')->store('client_cin_images', 'public');
            $validatedData['C_I_N_image'] = $cinImagePath;
        } else {
            $validatedData['C_I_N_image'] = $client->C_I_N_image;
        }

        $client->update($validatedData);

        return redirect()->route('home.index')->with('success', 'Client updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('home.index');
    }
}
