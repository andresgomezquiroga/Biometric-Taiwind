<?php

namespace App\Http\Controllers;

use App\Models\Ficha;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FichaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $fichas = Ficha::with('program')->get();
        $programs = Program::all();
        return view('home.ficha.index', compact('fichas' , 'programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programs = Program::all(); 
        return view('home.ficha.create', compact('programs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'number_ficha' => 'required',
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            'programa_id' => 'required',
        ]);

        Ficha::create([
            'number_ficha' => $request->input('number_ficha'),
            'date_start' => $request->input('date_start'),
            'date_end' => $request->input('date_end'),
            'programa_id' => $request->input('programa_id'),
        ]);

        Session::flash('success', 'Ficha creado correctamente.');

        return redirect()->route('ficha.index');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Ficha $ficha)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ficha $ficha)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ficha $ficha)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ficha $ficha)
    {
        //
        $ficha->delete();
        return redirect()->route('ficha.index')->with('delete', 'ok');
    }
}
