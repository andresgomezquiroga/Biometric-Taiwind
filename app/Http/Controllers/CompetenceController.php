<?php

namespace App\Http\Controllers;

use App\Models\Competence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Ficha;

class CompetenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        

        $competences = Competence::with('ficha')->get();
        $fichas = Ficha::all();
        return view('home.competencias.index', compact('competences', 'fichas'));
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
        //

        $request->validate([
            'name_competence' => 'required|string|max:255',
            'code_competence' => 'required|integer|unique:competences',
            'description' => 'required|string|max:255',
            'ficha_id' => 'required',
        ]);

        Competence::create([
            'name_competence' => $request->input('name_competence'),
            'code_competence' => $request->input('code_competence'),
            'description' => $request->input('description'),
            'ficha_id' => $request->input('ficha_id'),
        ]);

        Session::flash('success', 'Competencia creada exitosamente.');

        return redirect()->route('competence.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Competence $competence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Competence $competence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Competence $competence)
    {
        //

        $request->validate([
            'name_competence' => 'required|string|max:255',
            'code_competence' => 'required|integer',
            'description' => 'required|string|max:255',
            'ficha_id' => 'required',
        ]);
        
        $competence->update([
            'name_competence' => $request->input('name_competence'),
            'code_competence' => $request->input('code_competence'),
            'description' => $request->input('description'),
            'ficha_id' => $request->input('ficha_id'),
        ]);
        
        Session::flash('success', 'Competencia actualizada exitosamente.');

        return redirect()->route('competence.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Competence $competence)
    {
        //
        $competence->delete();

        Session::flash('delete', 'ok');
        return redirect()->route('competence.index');
    }
}
