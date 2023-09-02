@extends('home.masterpage')

@section('contenido')
    <div class="py-6 px-8">

        @can('program.store')
            <button class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg mb-4"
                id="openModal">Agregar Programa</button>
        @endcan

        <!-- Modal -->
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none"
            id="myModal" style="display: none;">
            <div class="relative w-auto my-6 mx-auto max-w-sm">
                <div class="bg-white rounded-lg shadow-lg relative flex flex-col w-full p-6">
                    <span class="absolute top-0 right-0 mt-4 mr-4 cursor-pointer" id="closeModal">×</span>
                    <h2 class="text-lg font-semibold mb-4">Agregar Programa</h2>
                    <form action="{{ route('program.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="flex flex-col">
                            <label for="name_program">Nombre del Programa</label>
                            <input type="text" name="name_program" id="name_program"
                                class="rounded-md p-2 border focus:border-green-500">
                        </div>
                        <div class="flex flex-col">
                            <label for="code_program">Código del Programa</label>
                            <input type="number" name="code_program" id="code_program"
                                class="rounded-md p-2 border focus:border-green-500">
                        </div>
                        <div class="flex flex-col">
                            <label for="user_id">Instructores disponibles</label>
                            <select name="user_id" id="user_id" class="rounded-md p-2 border focus:border-green-500">
                                @foreach ($instructs as $instruct)
                                    <option value="{{ $instruct->id }}">Nombre del instructor: {{ $instruct->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit"
                            class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg">Agregar</button>
                    </form>
                </div>
            </div>
        </div>




        <div
            class="bg-white p-4 rounded-md mt-4 overflow-auto sm:overflow-visible md:overflow-hidden lg:overflow-x-scroll xl:overflow-y-scroll">
            <h2 class="text-gray-500 text-lg font-semibold pb-4">Programas</h2>
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
                            Nombre del programa</th>
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            Codigo del programa</th>
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            Role asignado</th>

                        @can('program.update')
                            <th
                                class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-right">
                                Acciones</th>
                        @endcan

                    </tr>
                </thead>
                <tbody>
                    @foreach ($programs as $program)
                        <tr class="hover:bg-grey-lighter">
                            <td class="py-2 px-4 border-b border-grey-light text-center">{{ $program->id_program }}</td>
                            <td class="py-2 px-4 border-b border-grey-light text-center">{{ $program->name_program }}</td>
                            <td class="py-2 px-4 border-b border-grey-light text-center">{{ $program->code_program }}</td>
                            <td class="py-2 px-4 border-b border-grey-light text-center">
                                {{ $program->user ? $program->user->name : 'Sin usuario asociado' }}
                            </td>
                            <td class="py-2 px-4 border-b border-grey-light text-right">

                                @can('program.update')
                                <a href="javascript:void(0);"
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-2 rounded"
                                    onclick="editFicha({{ $program->id_program }})">
                                    Editar
                                </a>
                                @endcan

                                </a>
                                <div class="fixed inset-0 z-50 flex items-center justify-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none"
                                    id="editModal-{{ $program->id_program }}" style="display: none;">
                                    <div class="relative w-auto my-6 mx-auto max-w-sm">
                                        <div class="bg-white rounded-lg shadow-lg relative flex flex-col w-full p-6">
                                            <span class="absolute top-0 right-0 mt-4 mr-4 cursor-pointer"
                                                onclick="closeEditModal({{ $program->id_program }})">×</span>
                                            <h2 class="text-lg font-semibold mb-4">Editar Programa</h2>
                                            <form id="editForm-{{ $program->id_program }}" method="POST"
                                                action="{{ route('program.update', $program->id_program) }}"
                                                class="space-y-4">
                                                @csrf
                                                @method('PUT')
                                                <div class="flex flex-col">
                                                    <label for="name_program">Nombre del Programa</label>
                                                    <input value="{{ $program->name_program }}" type="text"
                                                        name="name_program" id="name_program"
                                                        class="rounded-md p-2 border focus:border-green-500">
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="code_program">Código del Programa</label>
                                                    <input value="{{ $program->code_program }}" type="number"
                                                        name="code_program" id="code_program"
                                                        class="rounded-md p-2 border focus:border-green-500">
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="user_id">Instructores disponibles</label>
                                                    <select name="user_id" id="user_id"
                                                        class="rounded-md p-2 border focus:border-green-500">
                                                        @foreach ($instructs as $instructor)
                                                            <option value="{{ $instructor->id }}"
                                                                @if ($instructor->id === $program->user_id) selected @endif>
                                                                Nombre del instructor: {{ $instructor->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <button typ"submit"
                                                    class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg">Editar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                @can('program.destroy')
                                    <button
                                        class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-2 rounded form-delete"
                                        data-id="{{ $program->id_program }}">
                                        Eliminar
                                    </button>
                                @endcan

                                <form id="delete-form-{{ $program->id_program }}"
                                    action="{{ route('program.destroy', $program->id_program) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
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
            function editFicha(id_program) {
                const editModal = document.getElementById(`editModal-${id_program}`);
                const editForm = document.getElementById(`editForm-${id_program}`);
                const editUrl = `/programa/${id_program}`;

                // Setear la acción del formulario y mostrar el modal
                editForm.action = editUrl;
                editModal.style.display = "block";
            }

            function closeEditModal(id_timeTable) {
                const editModal = document.getElementById(`editModal-${id_program}`);
                editModal.style.display = "none";
            }
        </script>




        <script>
            $('.form-delete').click(function(e) {
                e.preventDefault();

                var id = $(this).data('id');

                Swal.fire({
                    title: '¿Estás seguro de eliminar el programa de formación?',
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
                    'El programa ha sido eliminado',
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
    @endsection
