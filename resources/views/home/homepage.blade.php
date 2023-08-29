@extends('home.masterpage')

@section('contenido')
<div class="bg-gray-100 min-h-screen flex items-center height-100vh justify-center">
    <div class="bg-white p-6 rounded-lg shadow-md text-center">
        <h1 class="text-6xl font-semibold mb-5 text-green-600">¡Bienvenido!</h1>
        <p class="text-gray-700 text-lg">{{ Auth::user()->name }} {{ Auth::user()->last_name }}</p>
    </div>
</div>


@endsection

