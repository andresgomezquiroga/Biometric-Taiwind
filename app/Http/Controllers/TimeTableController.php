<?php

namespace App\Http\Controllers;

use App\Models\timeTable;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use App\Models\Ficha;
use Illuminate\Support\Facades\Auth;

class TimeTableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $instructors = [];
        $timeTables = [];
        $fichas = []; // Define la variable $fichas como un array vacío por defecto

        if ($user->hasRole('administrador')) {
            // Si es un administrador, obtén todos los horarios
            $timeTables = timeTable::with(['ficha.instructors'])->get();
            $fichas = Ficha::with('instructors')->get();
        } elseif ($user->hasRole('instructor')) {
            // Si es un instructor, obtén las fichas relacionadas con el instructor
            $fichas = $user->fichas;
            // Obtén los horarios relacionados con esas fichas
            $horarios = timeTable::whereIn('ficha_id', $fichas->pluck('id_ficha'))->with(['ficha.instructors'])->get();
        }

        return view('home.Horarios.index', compact('timeTables', 'fichas', 'instructors'));
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
            'jornada' => 'required|in:Manana,Mixta,Noche',
            'time_start' => 'required|date_format:H:i', // Formato de tiempo en horas y minutos
            'time_end' => 'required|date_format:H:i',
            'date_start' => 'required',
            'date_end' => 'required',
            'ficha_id' => 'required',
        ]);

        timeTable::create([
            'jornada' => $request->input('jornada'),
            'time_start' => $request->input('time_start'),
            'time_end' => $request->input('time_end'),
            'date_start' => $request->input('date_start'),
            'date_end' => $request->input('date_end'),
            'ficha_id' => $request->input('ficha_id'),
        ]);

        session()->flash('success', 'Horario creado correctamente.');
        return redirect()->route('timeTable.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(timeTable $timeTable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(timeTable $timeTable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $timeTable = TimeTable::findOrFail($id);

        $request->validate([
            'jornada' => 'required|in:Manana,Mixta,Noche',
            'time_start' => 'required|date_format:H:i', // Formato de tiempo en horas y minutos
            'time_end' => 'required|date_format:H:i',
            'date_start' => 'required',
            'date_end' => 'required',
            'ficha_id' => 'required',
        ]);

        $timeTable->update([
            'jornada' => $request->input('jornada'),
            'time_start' => $request->input('time_start'),
            'time_end' => $request->input('time_end'),
            'date_start' => $request->input('date_start'),
            'date_end' => $request->input('date_end'),
            'ficha_id' => $request->input('ficha_id'),
        ]);

        session()->flash('success', 'Horario actualizado correctamente.');
        return redirect()->route('timeTable.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(timeTable $timeTable)
    {
        //
        $timeTable->delete();

        session()->flash('delete', 'ok');
        return redirect()->route('timeTable.index');
    }
}
