<?php

namespace App\Http\Controllers;

use BaconQrCode\Encoder\QrCode as EncoderQrCode;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Obtener el usuario autenticado
        return view('qr.generate', compact('user'));
    }

}