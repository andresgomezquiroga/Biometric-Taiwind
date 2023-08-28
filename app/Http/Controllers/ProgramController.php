<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;


class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = Program::all();
        $users = User::all();
        $instructs = User::role(['instructor'])->get();
        return view('home.program.index', compact('programs', 'users', 'instructs'));
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
            'name_program' => 'required|string|max:255',
            'code_program' => 'required|integer|unique:programs',
            'user_id' => 'required',
        ]);


        Program::create([
            'name_program' => $request->input('name_program'),
            'code_program' => $request->input('code_program'),
            'user_id' => $request->input('user_id'),
        ]);

        Session::flash('success', 'Programa creado exitosamente.');
        return redirect()->route('program.index');

     // Redirige a la vista index y pasa $aprendices
    }
    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
    {
        $request->validate([
            'name_program' => 'required|string|max:255',
            'code_program' => 'required|integer',
            'user_id' => 'required',
        ]);
    
        $program->update([
            'name_program' => $request->name_program,
            'code_program' => $request->code_program,
            'user_id' => $request->user_id,
        ]);
    
        Session::flash('success', 'Programa actualizado exitosamente.');
        return redirect()->route('program.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()->route('program.index')->with('delete', 'ok');
    }
}
