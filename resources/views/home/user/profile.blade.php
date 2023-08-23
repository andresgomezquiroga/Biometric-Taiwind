@extends('home.masterpage')

@section('contenido')
    <div class="max-w-5xl mx-auto my-10 bg-white rounded-lg shadow-md p-8 flex">
        <!-- Columna de datos del usuario logueado -->
        <div class="w-1/2 p-5">
            @if ($auth->image && file_exists(public_path('img/imagesUsers/' . $auth->image)))
                <img class="w-32 h-32 rounded-full mx-auto" src="{{ asset('img/imagesUsers/' . $auth->image) }}">
            @else
                <img class="w-32 h-32 rounded-full mx-auto" src="{{ asset('img/user_default.png') }}" alt="Imagen por defecto">
            @endif

            <!--img class="w-32 h-32 rounded-full mx-auto" src="https://picsum.photos/200" alt="Profile picture"-->
            <h2 class="text-center text-2xl font-semibold mt-3">{{ $auth->name }} {{ $auth->last_name }}
                ({{ $auth->edad }})</h2>
            <p class="text-center text-gray-600 mt-1">{{ $auth->email }}</p>
            <div class="mt-5">
                <h3 class="text-xl font-semibold">Informacion</h3>
                <p class="text-gray-600 mt-2">
                    Me llamo {{ $auth->name }} {{ $auth->last_name }} y tengo {{ $auth->edad }} años. Tengo
                    {{ $auth->type_document }} de
                    identidad y mi numero de documento es {{ $auth->code_document }}. Por ultimo mi email es
                    {{ $auth->email }}.
                <p>
            </div>
        </div>

        <!-- Columna del formulario para actualizar los datos -->
        <div class="w-1/2 p-5">
            <h3 class="text-xl font-semibold mb-4">Actualizar mi perfil</h3>

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">


                @csrf

                @method('PUT')
                <div class="flex mb-4">
                    <div class="mr-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nombre</label>
                        <input type="text" id="name" name="name" value="{{ $auth->name }}"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="last_name">Apellidos</label>
                        <input type="text" id="last_name" name="last_name" value="{{ $auth->last_name }}"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('last_name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Edad</label>
                    <input type="number" id="edad" name="edad" value="{{ $auth->edad }}"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('edad')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex mb-4">
                    <div class="mr-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="type_document">Tipo de
                            documento</label>
                        <select
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            name="type_document" id="type_document">
                            <option selected disabled>Seleccione su tipo de documento</option>
                            <option value="CC" {{ $auth->type_document == 'CC' ? 'selected' : '' }}>
                                Cedula</option>
                            <option value="TI" {{ $auth->type_document == 'TI' ? 'selected' : '' }}>
                                Tarjeta de identidad</option>
                            <option value="CE" {{ $auth->type_document == 'CE' ? 'selected' : '' }}>
                                Cedula extranjeria</option>
                        </select>
                        @error('type_document')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="number_document">Numero de
                            documento</label>
                        <input type="number" id="number_document" name="number_document"
                            value="{{ $auth->number_document }}"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('number_document')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex mb-4">
                    <div class="mr-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Correo Electrónico</label>
                        <input type="email" id="email" name="email" value="{{ $auth->email }}"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('email')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Contraseña</label>
                        <input type="password" id="password" name="password" value="{{ $auth->password }}"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('password')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex mb-4">
                    <label for="">Editar Imagen</label>
                    <input class="" type="file" name="image" id="image">
                </div>

                <div class="ml-auto">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        type="submit">Actualizar</button>
                </div>
            </form>

        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @parent

    @if (session('profile_success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{ session('profile_success') }}',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
@endsection
