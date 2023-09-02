@extends('home.masterpage')

@section('contenido')
    <div class="py-6 px-8">

        @can('timeTable.store')
        <button class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg mb-4"
            id="openModal">Agregar horario</button>
        @endcan

        <!-- Modal -->
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none"
            id="myModal" style="display: none;">
            <div class="relative w-auto my-6 mx-auto max-w-sm">
                <div class="bg-white rounded-lg shadow-lg relative flex flex-col w-full p-6">
                    <span class="absolute top-0 right-0 mt-4 mr-4 cursor-pointer" id="closeModal">×</span>
                    <h2 class="text-lg font-semibold mb-4">Agregar Horario</h2>
                    <form action="{{ route('timeTable.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <select class="rounded-md p-2 border focus:border-green-500" id="jornada" name="jornada">
                            <option selected disabled>Seleccione la jornada</option>
                            <option value="Manana"{{ old('jornada') == 'Manana' ? 'selected' : '' }}>Mañana</option>
                            <option value="Mixta" {{ old('jornada') == 'Mixta' ? 'selected' : '' }}>Mixta</option>
                            <option value="Noche" {{ old('jornada') == 'Noche' ? 'selected' : '' }}>Noche</option>
                        </select>
                        <div class="flex flex-col">
                            <label for="time_start">Hora comienzo</label>
                            <input type="time" name="time_start" id="time_start"
                                class="rounded-md p-2 border focus:border-green-500">
                        </div>
                        <div class="flex flex-col">
                            <label for="time_end">Hora finalizacion</label>
                            <input type="time" name="time_end" id="time_end"
                                class="rounded-md p-2 border focus:border-green-500">
                        </div>
                        <div class="flex flex-col">
                            <label for="ficha_id">Numero de fichas vinculables disponibles</label>
                            <select name="ficha_id" id="ficha_id" class="rounded-md p-2 border focus:border-green-500">
                                @foreach ($fichas as $ficha)
                                    <option value="{{ $ficha->id_ficha }}">{{ $ficha->number_ficha }}</option>
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
            <h2 class="text-gray-500 text-lg font-semibold pb-4">Horarios</h2>
            <div class="my-1"></div>
            <div class="bg-gradient-to-r from-green-300 to-cyan-500 h-px mb-6 "></div>
            <table class="w-full table-auto text-sm ">
                <thead>
                    <tr class="text-sm leading-normal">
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light">
                            ID</th>
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light">
                            Jornada</th>
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light">
                            Hora de inicio</th>
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light">
                            Hora de finalizacion</th>
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-right">
                            Numero ficha seleccionada</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($timeTables as $timeTable)
                        <tr class="hover:bg-grey-lighter">
                            <td class="py-2 px-4 border-b border-grey-light text-center">{{ $timeTable->id_timeTable }}</td>
                            <td class="py-2 px-4 border-b border-grey-light text-center">{{ $timeTable->jornada }}</td>
                            <td class="py-2 px-4 border-b border-grey-light text-center">{{ $timeTable->time_start }}</td>
                            <td class="py-2 px-4 border-b border-grey-light text-center">{{ $timeTable->time_end }}</td>
                            <td class="py-2 px-4 border-b border-grey-light text-center">
                                {{ $timeTable->ficha->number_ficha }}</td>
                            <td class="py-2 px-4 border-b border-grey-light text-right">

                                @can('timeTable.update')
                                <a href="javascript:void(0);"
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-2 rounded"
                                    onclick="editFicha({{ $timeTable->id_timeTable }})">
                                    Editar
                                </a>
                                @endcan

                                <div class="fixed inset-0 z-50 flex items-center justify-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none"
                                    id="editModal-{{ $timeTable->id_timeTable }}" style="display: none;">
                                    <div class="relative w-auto my-6 mx-auto max-w-sm">
                                        <div class="bg-white rounded-lg shadow-lg relative flex flex-col w-full p-6">
                                            <span class="absolute top-0 right-0 mt-4 mr-4 cursor-pointer"
                                                onclick="closeEditModal({{ $timeTable->id_timeTable }})">×</span>
                                            <h2 class="text-lg font-semibold mb-4">Editar Ficha</h2>
                                            <form id="editForm-{{ $timeTable->id_timeTable }}" method="POST"
                                                action="{{ route('timeTable.update', $timeTable->id_timeTable) }}"
                                                class="space-y-4">
                                                @csrf
                                                @method('PUT')
                                                <div class="flex flex-col">
                                                    <label for="jornada">Jornada</label>
                                                    <select name="jornada" id="jornada"
                                                        class="rounded-md p-2 border focus:border-green-500">
                                                        <option value="Manana"
                                                            {{ $timeTable->jornada == 'Manana' ? 'selected' : '' }}>
                                                            Mañana</option>
                                                        <option value="Mixta"
                                                            {{ $timeTable->jornada == 'Mixta' ? 'selected' : '' }}>
                                                            Mixta</option>
                                                        <option value="Noche"
                                                            {{ $timeTable->jornada == 'Noche' ? 'selected' : '' }}>
                                                            Noche</option>
                                                    </select>
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="time_start">Hora de inicio</label>
                                                    <input value="{{ $timeTable->time_start }}" type="time"
                                                        name="time_start" id="time_start"
                                                        class="rounded-md p-2 border focus:border-green-500">
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="time_end">Hora finalizacion</label>
                                                    <input value="{{ $timeTable->time_end }}" type="time" name="time_end" id="time_end" class="rounded-md p-2 border focus:border-green-500">
                                                </div>
                                                <div class="flex flex-col">
                                                    <label for="ficha_id">Numero de ficha</label>
                                                    <select name="ficha_id" id="ficha_id"
                                                        class="rounded-md p-2 border focus:border-green-500">
                                                        @foreach ($fichas as $ficha)
                                                            <option value="{{ $ficha->id_ficha }}"
                                                                @if ($ficha->id_ficha === $timeTable->ficha_id) selected @endif>
                                                                {{ $ficha->number_ficha }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <button type="submit"
                                                    class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg">Editar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            @can('timeTable.destroy')
                            <button class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-2 rounded form-delete"
                                data-id="{{ $timeTable->id_timeTable }}">
                                Eliminar
                            </button>
                            @endcan

                            <form id="delete-form-{{ $timeTable->id_timeTable }}"
                                action="{{ route('timeTable.destroy', $timeTable->id_timeTable) }}" method="POST"
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
            function editFicha(id_timeTable) {
                const editModal = document.getElementById(`editModal-${id_timeTable}`);
                const editForm = document.getElementById(`editForm-${id_timeTable}`);
                const editUrl = `/timeTable/${id_timeTable}`;

                // Setear la acción del formulario y mostrar el modal
                editForm.action = editUrl;
                editModal.style.display = "block";
            }

            function closeEditModal(id_timeTable) {
                const editModal = document.getElementById(`editModal-${id_timeTable}`);
                editModal.style.display = "none";
            }
        </script>


    <script>
        $('.form-delete').click(function(e) {
            e.preventDefault();

            var id = $(this).data('id');

            Swal.fire({
                title: '¿Estás seguro de eliminar el horario de formación?',
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
                'El horario ha sido eliminado',
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
