<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $attendances = Attendance::all();
        return view('home.asistencias.index', compact('attendances'));
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
            'name_attendance' => 'required|string|max:255',
            'code_attendance' => 'required|integer|unique:attendances',
            'time_attendance' => 'required|string|max:255',
            'apprentices_assisted' => 'required',

        ]);

        Attendance::create([
            'name_attendance' => $request->input('name_attendance'),
            'code_attendance' => $request->input('code_attendance'),
            'time_attendance' => $request->input('time_attendance'),
            'apprentices_assisted' => $request->input('apprentices_assisted'),
        ]);

        Session::flash('success', 'Asistencia creada exitosamente.');

        return redirect()->route('attendance.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        //

        $request->validate([
            'name_attendance' => 'required|string|max:255',
            'code_attendance' => 'required|integer',
            'time_attendance' => 'required|string|max:255',
            'apprentices_assisted' => 'required',
        ]);

        $attendance->update([
            'name_attendance' => $request->input('name_attendance'),
            'code_attendance' => $request->input('code_attendance'),
            'time_attendance' => $request->input('time_attendance'),
            'apprentices_assisted' => $request->input('apprentices_assisted'),
        ]);

        Session::flash('success', 'Asistencia actualizada exitosamente.');

        return redirect()->route('attendance.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //

        $attendance->delete();

        Session::flash('delete', 'ok');

        return redirect()->route('attendance.index');
    }

}
