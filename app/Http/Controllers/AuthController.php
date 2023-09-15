<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\PasswordResetTokens;
use Illuminate\Support\Str;
use App\Models\User;


class AuthController extends Controller
{

    public function login (): View
    {
        return view ('auth.login');
    }

    public function login_successfully(): View
    {
        $user = new Auth();
        return view ('home.paginaPrincipal' , compact('user'));
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

    public function recoveryPassword(): View
    {
        return view('auth.recoveryPassword');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Generador de codigo aleatorio
        $code = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);

        // Generador de token
        $token = Str::random(32); // Genera una cadena aleatoria de longitud 32

        $recoveryPassword = new PasswordResetTokens();

        $recoveryPassword->email = $request->input('email');
        $recoveryPassword->token = $token;
        $recoveryPassword->code = $code;

        $recoveryPassword->save();

        // Consultar la tabla segun el email
        $queryEmail = PasswordResetTokens::where('email', $request->input('email'))->first();

        Mail::send('auth.messageRecovery', ['code' => $queryEmail->code , 'token' => $queryEmail->token], function ($message) use ($request) {
            $message->to($request->input('email'));
            $message->subject('Recuperacion de contraseña');
        });

        return back()->with('success', 'Se ha enviado un correo para recuperar la contraseña');

    }

    public function showVerifyCode ()
    {
        return view('auth.verifyCode');
    }

    public function verifyCode (Request $request)
    {
        $request->validate([
            'code' => 'required|min:5|max:5',
        ]);

        $token = PasswordResetTokens::where('code', $request->input('code'))->first();

        if ($token) {
            PasswordResetTokens::where('code', $request->input('code'))->delete();

            // Autenticar al usuario utilizando su correo electrónico
            $user = User::where('email', $token->email)->first(); // Obtener el usuario

            if ($user) {
                Auth::login($user);
                return redirect()->route('home.masterpage');
            } else {
                return redirect()->back()->withErrors(['email' => 'El código no es válido']);
            }
        } else {
            return redirect()->back()->withErrors(['codeError' => 'El código no es válido']);
        }

    }


    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Sesión cerrada');
    }


}
