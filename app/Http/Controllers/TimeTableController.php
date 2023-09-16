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
        //
        $timeTables = timeTable::all();
        $fichas = Ficha::all();
        return view('home.horarios.index', compact('timeTables', 'fichas'));
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
