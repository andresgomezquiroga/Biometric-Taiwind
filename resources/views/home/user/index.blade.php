@extends('home.masterpage')

@section('contenido')

<div class="py-6 px-8">
    <button class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg mb-4" id="openModal">Agregar Programa</button>

    <!-- Modal -->
    <div class="fixed inset-0 z-50 flex items-center justify-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none" id="myModal" style="display: none;">
        <div class="relative w-auto my-6 mx-auto max-w-sm">
            <div class="bg-white rounded-lg shadow-lg relative flex flex-col w-full p-6">
                <span class="absolute top-0 right-0 mt-4 mr-4 cursor-pointer" id="closeModal">×</span>
                <h2 class="text-lg font-semibold mb-4">Agregar Usuario</h2>
                <form action="{{route('user.store')}}" method="POST" class="space-y-4">
                    @csrf
                    <div class="flex flex-col">
                        <label for="number_ficha">Nombre</label>
                        <input type="text" name="name" id="name" class="rounded-md p-2 border focus:border-green-500">
                        @error('name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="number_ficha">Apellido</label>
                        <input type="text" name="last_name" id="last_name" class="rounded-md p-2 border focus:border-green-500">
                        @error('last_name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="number_ficha">Edad</label>
                        <input type="number" name="age" id="age" class="rounded-md p-2 border focus:border-green-500">
                    </div>
                    <div class="flex flex-col">
                        <label for="date_start">Tipo de documento</label>
                        <div class="flex flex-col">
                            <select name="type_document" id="type_document" class="rounded-md p-2 border focus:border-green-500">
                                <option value="CC">Cedula de ciudadania</option>
                                <option value="TI">Tarjeta de identidad</option>
                                <option value="CE">Cedula de extranjeria</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <label for="number_ficha">Numero de documento</label>
                        <input type="number" name="number_document" id="number_document" class="rounded-md p-2 border focus:border-green-500">
                    </div>
                    <div class="flex flex-col">
                        <label for="number_ficha">Correo electronico</label>
                        <input type="email" name="email" id="email" class="rounded-md p-2 border focus:border-green-500">
                    </div>
                    <div class="flex flex-col">
                        <label for="number_ficha">Contraseña</label>
                        <input type="password" name="password" id="password" class="rounded-md p-2 border focus:border-green-500">
                    </div>
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg">Agregar</button>
                </form>
            </div>
        </div>
    </div>


    <div class="bg-white p-4 rounded-md mt-4 overflow-auto sm:overflow-visible md:overflow-hidden lg:overflow-x-scroll xl:overflow-y-scroll">
        <h2 class="text-gray-500 text-lg font-semibold pb-4">Usuarios</h2>
        <div class="my-1"></div>
        <div class="bg-gradient-to-r from-green-300 to-cyan-500 h-px mb-6 "></div>
        <table class="w-full table-auto text-sm ">
            <thead>
                <tr class="text-sm leading-normal">
                    <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light">Nombre</th>
                    <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-right">Apellidos</th>
                    <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light">edad</th>
                    <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light">tipo de documento</th>
                    <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light">Numero de documento</th>
                    <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light">Correo electronico</th>
                    <th colspan="2" class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light">Acciones</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($users as $user)
                    <tr class="hover:bg-grey-lighter">
                    <td class="py-2 px-4 border-b border-grey-light">{{ $user->name }}</td>
                    <td class="py-2 px-4 border-b border-grey-light">{{ $user->last_name }}</td>
                    <td class="py-2 px-4 border-b border-grey-light">{{ $user->edad }}</td>
                    <td class="py-2 px-4 border-b border-grey-light">{{ $user->type_document }}</td>
                    <td class="py-2 px-4 border-b border-grey-light">{{ $user->number_document }}</td>
                    <td class="py-2 px-4 border-b border-grey-light">{{ $user->email }}</td>
                    <td class="py-2 px-4 border-b border-grey-light">Editar</td>
                    <td class="py-2 px-4 border-b border-grey-light">Eliminar</td>
                </tr>
                @endforeach

            </tbody>
        </table>
        <div class="text-right mt-4">
            <button class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">
                Ver más
            </button>
        </div>
    </div>
</div>

<script>
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("openModal");
    var span = document.getElementById("closeModal");

    btn.onclick = function() {
        modal.style.display = "block";
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }
</script>



@endsection
