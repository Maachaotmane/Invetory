<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ClientController;
use App\Http\Controllers\FournisseurController;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(Request $request): Response
    {
        $clientController = app(ClientController::class);
        $fournisseurController = app(FournisseurController::class);

        return Inertia::render('Home/Home', [
            'clients' => $clientController->getAll($request),
            'fournisseurs' => $fournisseurController->getAll($request),
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }
    
}
