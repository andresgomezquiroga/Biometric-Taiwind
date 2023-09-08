@extends('home.masterpage')

@section('contenido')
 <div class="py-6 px-8">
     <div class="flex justify-between items-center mb-4">
         @can('attendance.store')
             <button class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg"
                 id="openModal">Agregar Asistencia</button>
         @endcan
         @if (auth()->user()->hasRole('instructor'))
         <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" id="startScanner">
            Escanear Código QR
        </button>
         @endif
     </div>
     <div class="container mx-auto mt-8 p-4">
         <div class="relative max-w-xs mx-auto mb-4">
             <!-- Contenedor del video de la cámara -->
             <div class="bg-black rounded-lg overflow-hidden aspect-w-16 aspect-h-9">
                 <video id="preview" class="w-full h-full" style="display: none;"></video>
             </div>
         </div>
     </div>



        <!-- Modal -->
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none"
            id="myModal" style="display: none;">
            <div class="relative w-auto my-6 mx-auto max-w-sm">
                <div class="bg-white rounded-lg shadow-lg relative flex flex-col w-full p-6">
                    <span class="absolute top-0 right-0 mt-4 mr-4 cursor-pointer" id="closeModal">×</span>
                    <h2 class="text-lg font-semibold mb-4">Agregar Asistencia</h2>
                    <form action="{{ route('attendance.store') }}" method="POST"
                        class="space-y-4">
                        @csrf
                        <!-- Campo para adjuntar archivo -->
                        <div class="flex flex-col">
                            <label for="code_attendance">Codigo de la asistencia</label>
                            <input type="number" name="code_attendance" id="code_attendance"
                                class="rounded-md p-2 border focus:border-green-500">
                            @error('code_attendance')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label for="name_attendance">Nombre de la asistencia</label>
                            <input type="text" name="name_attendance" id="name_attendance"
                                class="rounded-md p-2 border focus:border-green-500">
                            @error('name_attendance')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col">
                            <label for="time_attendance">Hora de la asistencia</label>
                            <input type="time" name="time_attendance" id="time_attendance"
                                class="rounded-md p-2 border focus:border-green-500">
                            @error('time_attendance')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label for="apprentices_assisted">Ingrese el nombre de los asistentes</label>
                            <input type="text" name="apprentices_assisted" id="apprentices_assisted"
                                class="rounded-md p-2 border focus:border-green-500">
                            @error('apprentices_assisted')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit"
                            class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg">Agregar</button>
                    </form>
                </div>
            </div>
        </div>




        <div
            class="bg-white p-4 rounded-md mt-4 overflow-auto sm:overflow-visible md:overflow-hidden lg:overflow-x-scroll xl:overflow-y-scroll">
            <h2 class="text-gray-500 text-lg font-semibold pb-4">Asistencia</h2>
            <div class="my-1"></div>
            <div class="bg-gradient-to-r from-green-300 to-cyan-500 h-px mb-6 "></div>
            <table class="w-full table-auto text-sm ">
                <thead>
                    <tr class="text-sm leading-normal">
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            Codigo</th>
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            Nombre de la asistencia</th>

                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            Hora de la asistencia</th>

                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            Aprendices con sus asistencias</th>


                        @can('attendance.destroy')
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            Acciones
                        </th>
                        @endcan


                    </tr>
                </thead>
                <tbody>
                    @foreach ($attendances as $attendance)
                        <tr class="hover:bg-grey-lighter">
                            <td class="py-2 px-4 border-b border-grey-light text-center">{{ $attendance->code_attendance }}</td>
                            <td class="py-2 px-4 border-b border-grey-light text-center">{{ $attendance->name_attendance }}</td>
                            <td class="py-2 px-4 border-b border-grey-light text-center">{{ $attendance->time_attendance }}</td>
                            <td class="py-2 px-4 border-b border-grey-light text-center">{{ $attendance->apprentices_assisted }}</td>
                            <td class="py-2 px-4 border-b border-grey-light text-center">

                            @can('attendance.update')
                            <a href="javascript:void(0);"
                                class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-2 rounded"
                                onclick="editUser({{ $attendance->id_attendance }})">
                                Editar
                            </a>
                            @endcan

                            <div class="fixed inset-0 z-50 flex items-center justify-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none"
                                id="editModal-{{ $attendance->id_attendance }}" style="display: none;">
                                <div class="relative w-auto my-6 mx-auto max-w-sm">
                                    <div class="bg-white rounded-lg shadow-lg relative flex flex-col w-full p-6">
                                        <span class="absolute top-0 right-0 mt-4 mr-4 cursor-pointer"
                                            onclick="closeEditModal({{ $attendance->id_attendance }})">×</span>
                                        <h2 class="text-lg font-semibold mb-4">Editar Asistencia</h2>
                                        <form id="editForm-{{ $attendance->id_attendance }}" method="POST"
                                            action="{{ route('attendance.update', $attendance->id_attendance) }}" class="space-y-4">
                                            @csrf
                                            @method('PUT')
                                            <div class="flex flex-col">
                                                <label for="code_attendance">Codigo de la asistencia</label>
                                                <input value="{{ $attendance->code_attendance }}" type="number" name="code_attendance"
                                                    id="code_attendance" class="rounded-md p-2 border focus:border-green-500">
                                                @error('code_attendance')
                                                    <span class="text-red-500">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="flex flex-col">
                                                <label for="name_attendance">Nombre de la asistencia</label>
                                                <input value="{{ $attendance->name_attendance }}" type="text" name="name_attendance"
                                                    id="name_attendance" class="rounded-md p-2 border focus:border-green-500">
                                                @error('name_attendance')
                                                    <span class="text-red-500">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="flex flex-col">
                                                <label for="time_attendance">Hora de la asistencia</label>
                                                <input value="{{ $attendance->time_attendance }}" type="time" name="time_attendance"
                                                    id="time_attendance" class="rounded-md p-2 border focus:border-green-500">
                                                @error('time_attendance')
                                                    <span class="text-red-500">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="flex flex-col">
                                                <label for="apprentices_assisted">Ingrese el nombre de los asistentes</label>
                                                <input value="{{ $attendance->apprentices_assisted }}" type="text"
                                                    name="apprentices_assisted" id="apprentices_ assisted"
                                                    class="rounded-md p-2 border focus:border-green-500">
                                                @error('apprentices_assisted')
                                                    <span class="text-red-500">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <button type="submit"
                                                class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg">Editar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            @can('attendance.destroy')
                            <button
                                class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-2 rounded form-delete"
                                data-id="{{ $attendance->id_attendance }}">
                                Eliminar
                            </button>
                            @endcan

                            <form id="delete-form-{{ $attendance->id_attendance }}" action="{{ route('attendance.destroy', $attendance->id_attendance) }}"
                                method="POST" style="display: none;">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
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
            function editUser(id_attendance) {
                const editModal = document.getElementById(`editModal-${id_attendance}`);
                const editForm = document.getElementById(`editForm-${id_attendance}`);
                const editUrl = `/attendance/${id_attendance}`;

                // Setear la acción del formulario y mostrar el modal
                editForm.action = editUrl;
                editModal.style.display = "block";
            }

            function closeEditModal(id_attendance) {
                const editModal = document.getElementById(`editModal-${id_attendance}`);
                editModal.style.display = "none";
            }
        </script>


        <script>
            $('.form-delete').click(function(e) {
                e.preventDefault();

                var id = $(this).data('id');

                Swal.fire({
                    title: '¿Estás seguro de eliminar la asistencia?',
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
                    'La excusa ha sido eliminado',
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


<script>
    var scanner = new Instascan.Scanner({ video: document.getElementById('preview') });

    document.getElementById('startScanner').addEventListener('click', function () {
        // Muestra el video cuando se hace clic en el botón
        document.getElementById('preview').style.display = 'block';

        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);

                scanner.addListener('scan', function (content) {
                    // Content contiene los datos del código QR escaneado
                    // Realiza una solicitud Ajax para registrar la asistencia
                    $.ajax({
                        method: "POST",
                        url: "{{ route('storeCodigoQr') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            qr_data: content
                        },
                        success: function(response) {
                            console.log(response);
                            if (response == "si") {
                                Swal.fire(
                                    '¡Éxito!',
                                    'La asistencia se creó correctamente.',
                                    'success'
                                ).then(function() {
                                    location.reload(); // Refresca la página después de mostrar el mensaje
                                });
                            } else {
                                Swal.fire(
                                    'Error',
                                    'Hubo un error al crear la asistencia.',
                                    'error'
                                );
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                            Swal.fire(
                                'Error',
                                'Hubo un error al crear la asistencia.',
                                'error'
                            );
                        }
                    });
                });
            } else {
                alert('No se encontraron cámaras disponibles.');
            }
        }).catch(function (error) {
            console.error(error);
        });
    });
</script>
    @endsection
