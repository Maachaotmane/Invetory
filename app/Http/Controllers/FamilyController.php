<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ClientController;
use App\Http\Controllers\FournisseurController;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class FamilyController extends Controller
{
    public function index(Request $request): Response
    {
        $clientController = app(ClientController::class);
        $fournisseurController = app(FournisseurController::class);

        return Inertia::render('Familly/Familly', [
            'categories' => $clientController->index($request),
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }
    
}
