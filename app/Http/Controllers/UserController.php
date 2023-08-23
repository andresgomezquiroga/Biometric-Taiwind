<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('home.user.index', compact('users'));
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
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'edad' => 'required|integer|min:0',
            'type_document' => ['required', Rule::in(['CC', 'TI', 'CE'])],
            'number_document' => 'required|integer|min:0',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        User::create([
            'name' => $request->input('name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'edad' => $request->input('edad'),
            'type_document' => $request->input('type_document'),
            'number_document' => $request->input('number_document'),
            'password' => $request->input('password'),
        ]);


        return redirect()->route('user.index')->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'edad' => 'required|integer|min:0',
            'type_document' => ['required', Rule::in(['CC', 'TI', 'CE'])],
            'number_document' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Procesar la imagen si se ha proporcionado
        if ($request->hasFile('image')) {
            $rutaGuardarImg = 'img/imagesUsers/';
            $imagenUsuario = $request->input('name') . $request->input('last_name') . "." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($rutaGuardarImg, $imagenUsuario);

            // Eliminar la imagen actual si existe
            if ($user->image) {
                $imagenEliminar = $rutaGuardarImg . $user->image;
                if (file_exists($imagenEliminar)) {
                    unlink($imagenEliminar);
                }
            }

            $user->image = $imagenUsuario;
        }

        // Actualizar los demás campos del usuario
        $user->update([
            'name' => $request->input('name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'edad' => $request->input('edad'),
            'type_document' => $request->input('type_document'),
            'number_document' => $request->input('number_document'),
            'password' => bcrypt($request->input('password')), // Recuerda encriptar la contraseña
        ]);

        return redirect()->route('user.index')->with('success', 'Usuario actualizado exitosamente.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Eliminar la foto si existe
        if ($user->image) {
            $rutaImagen = public_path('img/imagesUsers/') . $user->image;
            if (file_exists($rutaImagen)) {
                unlink($rutaImagen);
            }
        }

        // Eliminar los datos del usuario
        $user->delete();

        session()->flash('delete', 'ok');
        return redirect()->route('user.index')->with('success', 'Usuario eliminado exitosamente.');
    }

    public function showProfile()
    {
        $auth = Auth::user();
        return view('home.user.profile', compact('auth'));
    }

    public function updateProfile(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'edad' => 'required|integer|min:0',
            'type_document' => ['required', Rule::in(['CC', 'TI', 'CE'])],
            'number_document' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        
        $user = Auth::user();

        if ($request->hasFile('image')) {
            $rutaGuardarImg = 'img/imagesUsers/';
            $imagenUsuario = $request->input('name') . $request->input('last_name') . "." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($rutaGuardarImg, $imagenUsuario);

            // Eliminar la imagen actual si existe
            if ($user->image) {
                $imagenEliminar = $rutaGuardarImg . $user->image;
                if (file_exists($imagenEliminar)) {
                    unlink($imagenEliminar);
                }
            }

            $user->image = $imagenUsuario;
        }

        $user->update([
            'name' => $request->input('name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'edad' => $request->input('edad'),
            'type_document' => $request->input('type_document'),
            'number_document' => $request->input('number_document'),
            'image' => $user->image,
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect()->back()->with('profile_success', 'Perfil actualizado exitosamente.');
    }
}
