<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        // Validazione dei dati del login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Tentativo di login
        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            return redirect()->route('admin.home');
        }

        return redirect()->route('admin.login')->withErrors('Le credenziali non sono corrette.');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
