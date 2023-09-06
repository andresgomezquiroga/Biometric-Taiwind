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
        $users = User::all();
        $aprendices = User::role(['aprendiz'])->get();
        return view('home.attendance.index', compact('attendances', 'aprendices'));
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
            'description' => 'required|string|max:255',
            'user_id' => 'required'

        ]);

        Attendance::create([
            'name_attendance' => $request->input('name_attendance'),
            'code_attendance' => $request->input('code_attendance'),
            'time_attendance' => $request->input('time_attendance'),
            'description' => $request->input('description'),
            'user_id' => $request->input('user_id')
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
            'description' => 'required|string|max:255',
            'user_id' => 'required'
        ]);

        $attendance->update([
            'name_attendance' => $request->input('name_attendance'),
            'code_attendance' => $request->input('code_attendance'),
            'time_attendance' => $request->input('time_attendance'),
            'description' => $request->input('description'),
            'user_id' => $request->input('user_id')
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

    public function registrarAsistenciaQR(Request $request)
    {
        // Obtener el contenido del código QR desde la solicitud
        $qrData = $request->input('qrData'); // Supongamos que es una cadena JSON

        try {
            // Decodificar la cadena JSON del código QR
            $qrData = json_decode($qrData, true);

            if ($qrData === null) {
                // La cadena JSON es inválida
                return response()->json(['message' => 'Contenido de código QR inválido'], 400);
            }

            // Obtener el ID del usuario aprendiz desde el código QR
            $userId = $qrData['user_id'];

            // Verificar si el usuario aprendiz existe
            $user = User::find($userId);

            if (!$user) {
                return response()->json(['message' => 'Usuario aprendiz no encontrado'], 404);
            }

            // Aquí puedes realizar más validaciones según tus requisitos.

            // Registra la asistencia
            $attendance = new Attendance();
            $attendance->name_attendance = 'Asistido'; // Nombre fijo para asistencia
            $attendance->code_attendance = rand(1000, 9999); // Código aleatorio (puedes cambiarlo según necesites)
            $attendance->time_attendance = now()->toTimeString(); // Hora actual
            $attendance->description = 'Descripción de la asistencia'; // Descripción fija o puedes usar la de $qrData
            $attendance->user_id = $user->id; // ID del usuario aprendiz

            $attendance->save();

            return response()->json(['message' => 'Asistencia registrada con éxito']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al registrar asistencia'], 500);
        }
    }
}
