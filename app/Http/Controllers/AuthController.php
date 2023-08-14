<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
    public function login (): View
    {
        return view ('auth.login');
    }

    public function login_successfully(): View
    {
        $user = new Auth();
        return view ('home.masterpage' , compact('user'));
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            return redirect()->route('home.masterpage')->with('success', 'Autenticación exitosa');
        } else {
            return redirect()->back()->withErrors(['email' => 'Las credenciales no son válidas']);
        }
    }


    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Sesión cerrada');
    }


}
