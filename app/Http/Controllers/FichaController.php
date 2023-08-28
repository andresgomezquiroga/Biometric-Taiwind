<?php

namespace App\Http\Controllers;

use App\Models\Ficha;
use App\Models\Program;
use App\Models\User;
use App\Models\timeTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Exports\AprendicesExport;
use Maatwebsite\Excel\Facades\Excel;

class FichaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $programs = Program::all(); // Debes definir y obtener los programas aquí

        if ($user->hasRole(['instructor', 'administrador'])) {
            $fichas = Ficha::with('program')->get();
        }
        else if ($user->hasRole('aprendiz')) {
            $fichas = Ficha::whereHas('members', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->with('program')->get();
        }
        else {
            $fichas = collect();
        }

        return view('home.ficha.index', compact('fichas', 'programs'));
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
        $request->validate([
            'number_ficha' => 'required',
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            'programa_id' => 'required',
        ]);

        $ficha->update([
            'number_ficha' => $request->input('number_ficha'),
            'date_start' => $request->input('date_start'),
            'date_end' => $request->input('date_end'),
            'programa_id' => $request->input('programa_id'),
        ]);

        Session::flash('success', 'Ficha actualizado correctamente.');
        return redirect()->route('ficha.index');
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


    // Añadir aprendices

    public function addAprendiz(Request $request)
    {
        $validatedData = $request->validate([
            'documento' => 'required|numeric',
            'ficha_id' => 'required|exists:fichas,id_ficha',
        ]);

        $user = User::where('number_document', $validatedData['documento'])->first();

        if (!$user) {
            return redirect()->back()->with('errorAprendiz', 'El usuario no existe.');
        }

        $ficha = Ficha::findOrFail($validatedData['ficha_id']);

        // Asociar al usuario a la ficha
        $ficha->members()->attach($user->id);

        return redirect()->back()->with('addAprendiz', 'Aprendiz agregado exitosamente.');
    }

    public function index_Aprendiz(Request $request, $fichaId)
    {
        $fichas = Ficha::findOrFail($fichaId);


        // Obtener los integrantes de la ficha
        $aprendizes = $fichas->members;

        return view('home.ficha.index_members', compact('fichas','aprendizes'));
    }

    public function exportExcel($fichaId)
    {
        return Excel::download(new AprendicesExport($fichaId), 'aprendices.xlsx');
    }

}
