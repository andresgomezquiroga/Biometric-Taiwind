<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use BaconQrCode\Encoder\QrCode as EncoderQrCode;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class QRController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Obtener el usuario autenticado
        return view('generar_codigo_qr.generate', compact('user'));
    }

    public function addDateByCodigoQr(Request $request)
    {
        $dataAjax = $request->input('qr_data');

        //$apprentice = $data->Nombre . ' ' . $data->Apellido;

        $name = "Asistio con el QR";
        $code = rand(10000, 99999);

        date_default_timezone_set('America/Bogota');
        $currentTime = date('H:i:s');

        $dataUser = User::find($dataAjax[0]);
        $nameFull = $dataUser->name . ' ' . $dataUser->last_name;

        $attendance = Attendance::create([
            'code_attendance' => $code,
            'name_attendance' => $name,
            'time_attendance' => $currentTime,
            'apprentices_assisted' => $nameFull,

        ]);

        if ($attendance) {
            echo "si";
        } else {
            echo "no";
        }
    }

}
