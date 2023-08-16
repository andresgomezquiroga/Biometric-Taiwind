<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('home.user.index' , compact('users'));
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
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'edad' => ['required', 'integer', 'min:0'], 
            'type_document' => ['required', Rule::in(['CC', 'TI', 'CE'])],
            'number_document' => ['required', 'integer', 'min:0'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string'],
        ]);
    
        User::create($validatedData);
    
        session()->flash('success', 'Usuario creado exitosamente.');
    
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //

        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'edad' => 'required|integer|min:0',
            'type_document' => ['required', Rule::in(['CC', 'TI', 'CE'])],
            'number_document' => 'required|integer|min:0',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::findOrFail($id);

        $user->update($request->all());
    
        return redirect()->route('user.index')->with('success', 'Usuario actualizado exitosamente.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $id = User::findOrFail($id);
        $id->delete();
        return redirect()->route('user.index');
        session()->flash('delete', 'ok');
    }
}
