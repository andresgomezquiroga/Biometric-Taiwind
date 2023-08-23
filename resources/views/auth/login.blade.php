@extends('template')

@section('title' , 'Pagina de Inicio de Session')

@section('content')

<div class="relative">
    <img width="80" class="absolute top-14 left-14 -mt-10" src="{{asset ('img/logo_sena.png')}}" />
</div>
<!-- component -->
<div class="min-h-screen flex justify-center items-center bg-white">
    <div class="p-10 border-[1px] -mt-10 border-slate-200 rounded-md flex flex-col items-center space-y-3">
      <div class="py-8">
        <h1 class="text-green-700 text-4xl"><b>Iniciar sesion</b></h1>
      </div>
        @if(session('success'))
            <div class="flex bg-green-100 rounded-lg p-4 mb-4 text-sm text-green-700" role="alert">
              <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
            <div>
              <span class="font-medium">Exito!</span> {{ session('success') }}
              </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="flex bg-red-100 rounded-lg p-4 mb-4 text-sm text-red-700" role="alert">
            <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
            <div>
                  <span class="font-medium">Error!</span> {{ $errors->first() }}
              </div>
          </div>
        @endif

      <form action="{{ route('auth') }}" method="post">
        @csrf
        <div class="mb-5">
          <input class="p-3 border-[1px] border-slate-500 rounded-sm w-80" type="email" placeholder="Correo electrónico" name="email" value="{{ session('email') }}"/>
        </div>
        <div class="flex flex-col space-y-1 mb-5">
          <input class="p-3 border-[1px] border-slate-500 rounded-sm w-80" type="password" placeholder="Contraseña" name="password" value="{{session('password')}}"/>
          <a href="{{ route('recoveryPassword' ) }}" class="font-bold text-green-700">Olvidaste tu contraseña? 😅</a>
        </div>
        <div class="mb-5">
          <button class="w-full bg-green-700 rounded-3xl p-3 text-white font-bold transition duration-200 hover:bg-green-500">Ingresar 🔐</button>
        </div>
      </form>


      </div>
    </div>

</div>


@endsection
