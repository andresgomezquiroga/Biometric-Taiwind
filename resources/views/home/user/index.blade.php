@extends('home.masterpage')

@section('contenido')
    <div class="py-6 px-8">
        <button class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg mb-4"
            id="openModal">Agregar Usuario</button>

        <!-- Modal -->
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none"
            id="myModal" style="display: none;">
            <div class="relative w-auto my-6 mx-auto max-w-sm">
                <div class="bg-white rounded-lg shadow-lg relative flex flex-col w-full p-6">
                    <span class="absolute top-0 right-0 mt-4 mr-4 cursor-pointer" id="closeModal">×</span>
                    <h2 class="text-lg font-semibold mb-4">Agregar Usuario</h2>
                    <form action="{{ route('user.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
                        @csrf
                        <div class="flex flex-col">
                            <label for="name">Nombre Completo</label>
                            <input type="text" name="name" id="name"
                                class="rounded-md p-2 border focus:border-green-500">
                            @error('name')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label for="last_name">Apellido Completo</label>
                            <input type="text" name="last_name" id="last_name"
                                class="rounded-md p-2 border focus:border-green-500">
                            @error('last_name')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label for="email">Correo electronico</label>
                            <input type="text" name="email" id="email"
                                class="rounded-md p-2 border focus:border-green-500">
                            @error('email')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label for="edad">Edad</label>
                            <input type="number" name="edad" id="edad"
                                class="rounded-md p-2 border focus:border-green-500">
                            @error('edad')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label for="type_document">Tipo de documento</label>
                            <select class="rounded-md p-2 border focus:border-green-500" id="type_document"
                                name="type_document">
                                <option selected disabled>Seleccione su tipo de documento</option>
                                <option value="CC" {{ old('type_document') == 'CC' ? 'selected' : '' }}>Cedula</option>
                                <option value="TI" {{ old('type_document') == 'TI' ? 'selected' : '' }}>Tarjeta de
                                    identidad</option>
                                <option value="CE" {{ old('type_document') == 'CE' ? 'selected' : '' }}>Cedula
                                    extranjeria</option>
                            </select>
                            @error('type_document')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label for="number_document">Numero de documento</label>
                            <input type="number" name="number_document" id="number_document"
                                class="rounded-md p-2 border focus:border-green-500">
                            @error('number_document')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label for="password">Contraseña</label>
                            <input type="password" name="password" id="password"
                                class="rounded-md p-2 border focus:border-green-500">
                            @error('password')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label for="">Asignar rol</label>
                            <div x-data="{
                                options: [],
                                open: false,
                                filter: ''
                            }" class="w-full relative">
                                <div @click="open = !open"
                                    class="p-3 rounded-lg flex gap-2 w-full border border-neutral-300 cursor-pointer truncate h-12 bg-white"
                                    x-text="options.length + ' roles seleccionado'">
                                </div>
                                <div class="p-3 rounded-lg flex gap-3 w-full shadow-lg x-50 absolute flex-col bg-white mt-3"
                                    x-show="open" x-trap="open" @click.outside="open = false"
                                    @keydown.escape.window="open = false"
                                    x-transition:enter=" ease-[cubic-bezier(.3,2.3,.6,1)] duration-200"
                                    x-transition:enter-start="!opacity-0 !mt-0" x-transition:enter-end="!opacity-1 !mt-3"
                                    x-transition:leave=" ease-out duration-200" x-transition:leave-start="!opacity-1 !mt-3"
                                    x-transition:leave-end="!opacity-0 !mt-0">
                                    @foreach ($roles as $role)
                                        <div x-show="$el.innerText.toLowerCase().includes(filter.toLowerCase())"
                                            class="flex items-center">
                                            <input x-model="options" id="{{ $role->name }}" type="checkbox"
                                                value="{{ $role->name }}" name="roles[]"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                            <label for="{{ $role->name }}"
                                                class="ml-2 text-sm font-medium text-gray-900 flex-grow">{{ $role->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                @error('roles')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <!--div class="flex flex-col">
                                            <label for="">Subir imagen </label>
                                            <input class="" type="file" name="image" id="image">
                                        </div-->

                        <button type="submit"
                            class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg">Agregar</button>
                    </form>
                </div>
            </div>
        </div>




        <div
            class="bg-white p-4 rounded-md mt-4 overflow-auto sm:overflow-visible md:overflow-hidden lg:overflow-x-scroll xl:overflow-y-scroll">
            <h2 class="text-gray-500 text-lg font-semibold pb-4">Horarios</h2>
            <div class="my-1"></div>
            <div class="bg-gradient-to-r from-green-300 to-cyan-500 h-px mb-6 "></div>
            <table class="w-full table-auto text-sm ">
                <thead>
                    <tr class="text-sm leading-normal">
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            ID</th>
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            Nombre</th>
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            Apellido</th>
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            Correo</th>
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            Edad</th>

                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            Tipo de documento
                        </th>

                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            Numero de documento
                        </th>

                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            Imagen
                        </th>

                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            Roles
                        </th>


                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            Acciones
                        </th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="hover:bg-grey-lighter">
                            <td class="py-2 px-4 border-b border-grey-light text-center">{{ $user->id }}</td>
                            <td class="py-2 px-4 border-b border-grey-light text-center">{{ $user->name }}</td>
                            <td class="py-2 px-4 border-b border-grey-light text-center">{{ $user->last_name }}</td>
                            <td class="py-2 px-4 border-b border-grey-light text-center">{{ $user->email }}</td>
                            <td class="py-2 px-4 border-b border-grey-light text-center">{{ $user->edad }}</td>
                            <td class="py-2 px-4 border-b border-grey-light text-center">{{ $user->type_document }}</td>
                            <td class="py-2 px-4 border-b border-grey-light text-center">{{ $user->number_document }}</td>
                            <td class="py-2 px-4 border-b border-grey-light text-center">
                                @foreach ($user->roles as $role)
                                    {{ $role->name }}
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </td>
                            <td class="py-2 px-4 border-b border-grey-light text-center">
                                @if ($user->image && file_exists(public_path('img/imagesUsers/' . $user->image)))
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('img/imagesUsers/' . $user->image) }}" alt="{{ $user->name }}"
                                        height="60" width="60">
                                @else
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('img/user_default.png') }}" alt="Imagen por defecto">
                                @endif
                            </td>
                            <td class="py-2 px-4 border-b border-grey-light text-right">
                                <a href="javascript:void(0);"
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-2 rounded"
                                    onclick="editUser({{ $user->id }})">
                                    Editar
                                </a>

                                <div class="fixed inset-0 z-50 flex items-center justify-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none"
                                    id="editModal-{{ $user->id }}" style="display: none;">
                                    <div class="relative w-auto my-6 mx-auto max-w-sm">
                                        <div class="bg-white rounded-lg shadow-lg relative flex flex-col w-full p-6">
                                            <span class="absolute top-0 right-0 mt-4 mr-4 cursor-pointer"
                                                onclick="closeEditModal({{ $user->id }})">×</span>
                                            <h2 class="text-lg font-semibold mb-4">Editar Usuario</h2>
                                            <form id="editForm-{{ $user->id }}" method="POST"
                                                action="{{ route('user.update', $user->id) }}" class="space-y-4"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="flex flex-col">
                                                    <label for="name">Nombre Completo</label>
                                                    <input value="{{ $user->name }}" type="text" name="name"
                                                        id="name"
                                                        class="rounded-md p-2 border focus:border-green-500">
                                                    @error('name')
                                                        <span class="text-red-500">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="last_name">Apellido Completo</label>
                                                    <input value="{{ $user->last_name }}" type="text"
                                                        name="last_name" id="last_name"
                                                        class="rounded-md p-2 border focus:border-green-500">
                                                    @error('last_name')
                                                        <span class="text-red-500">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="email">Correo</label>
                                                    <input value="{{ $user->email }}" type="text" name="email"
                                                        id="email"
                                                        class="rounded-md p-2 border focus:border-green-500">
                                                    @error('email')
                                                        <span class="text-red-500">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="edad">Edad</label>
                                                    <input value="{{ $user->edad }}" type="number" name="edad"
                                                        id="edad"
                                                        class="rounded-md p-2 border focus:border-green-500">
                                                    @error('edad')
                                                        <span class="text-red-500">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="type_document">Tipo de documento"</label>
                                                    <select name="type_document" id="type_document"
                                                        class="rounded-md p-2 border focus:border-green-500">
                                                        <option value="CC"
                                                            {{ $user->type_document == 'CC' ? 'selected' : '' }}>
                                                            Cedula</option>
                                                        <option value="TI"
                                                            {{ $user->type_document == 'TI' ? 'selected' : '' }}>
                                                            Tarjeta de identidad</option>
                                                        <option value="CE"
                                                            {{ $user->type_document == 'CE' ? 'selected' : '' }}>
                                                            Cedula extranjeria</option>
                                                    </select>
                                                    @error('type_document')
                                                        <span class="text-red-500">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="number_document">Numero de documento</label>
                                                    <input value="{{ $user->number_document }}" type="number"
                                                        name="number_document" id="number_document"
                                                        class="rounded-md p-2 border focus:border-green-500">
                                                    @error('number_document')
                                                        <span class="text-red-500">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="password">Contraseña</label>
                                                    <input value="{{ $user->password }}" type="password" name="password"
                                                        id="password"
                                                        class="rounded-md p-2 border focus:border-green-500">
                                                    @error('password')
                                                        <span class="text-red-500">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="flex flex-col">
                                                    @if ($user->image && file_exists(public_path('img/imagesUsers/' . $user->image)))
                                                        <img class="mx-auto"
                                                            src="{{ asset('img/imagesUsers/' . $user->image) }}"
                                                            alt="{{ $user->name }} " width="100" height="50">
                                                    @else
                                                        <img class="mx-auto" src="{{ asset('img/user_default.png') }}"
                                                            alt="Imagen por defecto" width="50" height="50">
                                                    @endif
                                                    <!--img class="mx-auto" src="{{ asset('img/imagesUsers/' . $user->image) }}" width="100" height="100"-->
                                                    <input class="" type="file" name="image" id="image">
                                                </div>

                                                <div class="flex flex-col">
                                                    <label for="roles">Roles</label>
                                                    @foreach($roles as $role)
                                                        <div class="flex items-center">
                                                            <input id="role_{{ $role->id }}" type="checkbox" name="roles[]"
                                                                   value="{{ $role->name }}"
                                                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                                                   @if($user->hasRole($role)) checked @endif>
                                                            <label for="role_{{ $role->id }}"
                                                                   class="ml-2 text-sm font-medium text-gray-900 flex-grow">{{ $role->name }}</label>
                                                        </div>
                                                    @endforeach
                                                    @error('roles')
                                                        <span class="text-red-500">{{ $message }}</span>
                                                    @enderror
                                                </div>



                                                <button type="submit"
                                                    class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg">Editar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <button
                                    class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-2 rounded form-delete"
                                    data-id="{{ $user->id }}">
                                    Eliminar
                                </button>
                                <form id="delete-form-{{ $user->id }}"
                                    action="{{ route('user.destroy', $user->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>

                        </tr>


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
    @endsection

    @section('js')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        @if (Session::has('success'))
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: '{{ Session::get('success') }}',
                    showConfirmButton: false,
                    timer: 2500
                });
            </script>
        @endif

        <script>
            function editUser(id) {
                const editModal = document.getElementById(`editModal-${id}`);
                const editForm = document.getElementById(`editForm-${id}`);
                const editUrl = `/user/${id}`;

                // Setear la acción del formulario y mostrar el modal
                editForm.action = editUrl;
                editModal.style.display = "block";
            }

            function closeEditModal(id) {
                const editModal = document.getElementById(`editModal-${id}`);
                editModal.style.display = "none";
            }
        </script>


        <script>
            $('.form-delete').click(function(e) {
                e.preventDefault();

                var id = $(this).data('id');

                Swal.fire({
                    title: '¿Estás seguro de eliminar el usuario?',
                    text: '¡No podrás revertir esto!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: 'blue',
                    confirmButtonText: 'Sí, eliminarlo',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#delete-form-' + id).submit();
                    }
                });
            });
        </script>

        @if (session('delete') == 'ok')
            <script>
                Swal.fire(
                    'Eliminado correctamente',
                    'El usuario ha sido eliminado',
                    'success'
                );

                // Eliminar el mensaje de éxito de la sesión
                @php
                    Session::forget('delete');
                @endphp
            </script>
        @endif


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


        @if (session('modify') == 'ok')
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Datos actualizados correctamente',
                    showConfirmButton: false,
                    timer: 1500
                })
            </script>
        @endif
    @endsection
