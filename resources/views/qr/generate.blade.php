@extends('home.masterpage')

@section('contenido')
<div class="max-w-5xl mx-auto my-10 bg-white rounded-lg shadow-md p-8 flex">
    <!-- Establece un ancho fijo para el botón de generar código QR -->
    <button class="bg-green-500 hover:bg-green-600 text-white font-semibold w-32 h-14 rounded-lg" id="generateQRButton">Generar mi código QR</button>
    <!-- Botón para descargar el código QR -->
    <a id="downloadQRButton" class="bg-green-500 hover:bg-green-600 text-white font-semibold w-32 h-14 rounded-lg" style="display: none;">Descargar código QR</a>
    <!-- Mostrar el código QR generado aquí -->
    <canvas id="qrCodeCanvas" style="display: none;"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/qrious@4/dist/qrious.min.js"></script>
<script>
    document.getElementById('generateQRButton').addEventListener('click', function() {
        // Obtener los datos del perfil del usuario
        var user = {!! json_encode([
            'Nombre' => $user->name,
            'Apellido' => $user->last_name,
            'Email' => $user->email,
            'Edad' => $user->edad
        ]) !!};

        // Generar el código QR
        var qr = new QRious({
            element: document.getElementById('qrCodeCanvas'),
            value: JSON.stringify(user),
            size: 200
        });

        // Mostrar el código QR y el botón de descarga
        document.getElementById('qrCodeCanvas').style.display = 'block';
        document.getElementById('downloadQRButton').style.display = 'block';
    });

    document.getElementById('downloadQRButton').addEventListener('click', function() {
        // Obtener el canvas con el código QR
        var canvas = document.getElementById('qrCodeCanvas');
        
        // Crear un enlace de descarga
        var downloadLink = document.createElement('a');
        downloadLink.href = canvas.toDataURL(); // Establecer la URL del enlace como los datos del canvas
        downloadLink.download = 'codigo-qr.png'; // Establecer el nombre del archivo para la descarga
        
        // Simular un clic en el enlace para iniciar la descarga
        downloadLink.click();
    });
</script>
@endsection