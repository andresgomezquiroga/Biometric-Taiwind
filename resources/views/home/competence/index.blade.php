@extends('home.masterpage')

@section('contenido')
    <div class="py-6 px-8">
        <button class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg mb-4"
            id="openModal">Agregar Competencia</button>

        <!-- Modal -->
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none"
            id="myModal" style="display: none;">
            <div class="relative w-auto my-6 mx-auto max-w-sm">
                <div class="bg-white rounded-lg shadow-lg relative flex flex-col w-full p-6">
                    <span class="absolute top-0 right-0 mt-4 mr-4 cursor-pointer" id="closeModal">×</span>
                    <h2 class="text-lg font-semibold mb-4">Agregar Competencia</h2>
                    <form action="{{ route('competence.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-4">
                        @csrf
                        <!-- Campo para adjuntar archivo -->
                        <div class="flex flex-col">
                            <label for="code_competence">Codigo de la competencia</label>
                            <input type="number" name="code_competence" id="code_competence"
                                class="rounded-md p-2 border focus:border-green-500">
                            @error('code_competence')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label for="name_competence">Nombre de la competencia</label>
                            <input type="text" name="name_competence" id="name_competence"
                                class="rounded-md p-2 border focus:border-green-500">
                            @error('name_competence')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Campo de comentarios -->
                        <div class="flex flex-col">
                            <label for="description">Descripcion de la competencia</label>
                            <textarea name="description" id="description" cols="30" rows="10"
                                class="rounded-md p-2 border focus:border-green-500"></textarea>
                            @error('description')
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
            <h2 class="text-gray-500 text-lg font-semibold pb-4">Competencias</h2>
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
                            Nombre de la competencia</th>

                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            Descripcion de la competencia</th>

                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            Acciones
                        </th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($competences as $competence)
                        <tr class="hover:bg-grey-lighter">
                            <td class="py-2 px-4 border-b border-grey-light text-center">{{ $competence->code_competence }}</td>
                            <td class="py-2 px-4 border-b border-grey-light text-center">{{ $competence->name_competence }}</td>
                            <td class="py-2 px-4 border-b border-grey-light text-center">{{ $competence->description }}</td>
                            <td class="py-2 px-4 border-b border-grey-light text-center">
                            <a href="javascript:void(0);"
                                class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-2 rounded"
                                onclick="editUser({{ $competence->id_competence }})">
                                Editar
                            </a>

                            <div class="fixed inset-0 z-50 flex items-center justify-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none"
                                id="editModal-{{ $competence->id_competence }}" style="display: none;">
                                <div class="relative w-auto my-6 mx-auto max-w-sm">
                                    <div class="bg-white rounded-lg shadow-lg relative flex flex-col w-full p-6">
                                        <span class="absolute top-0 right-0 mt-4 mr-4 cursor-pointer"
                                            onclick="closeEditModal({{ $competence->id_competence }})">×</span>
                                        <h2 class="text-lg font-semibold mb-4">Editar Competencia</h2>
                                        <form id="editForm-{{ $competence->id_competence }}" method="POST"
                                            action="{{ route('competence.update', $competence->id_competence) }}" class="space-y-4">
                                            @csrf
                                            @method('PUT')
                                            <div class="flex flex-col">
                                                <label for="code_competence">Codigo de la competencia</label>
                                                <input value="{{ $competence->code_competence }}" type="text" name="code_competence"
                                                    id="code_competence" class="rounded-md p-2 border focus:border-green-500">
                                                @error('code_competence')
                                                    <span class="text-red-500">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="flex flex-col">
                                                <label for="name_competence">Nombre de la competencia</label>
                                                <input value="{{ $competence->name_competence }}" type="text" name="name_competence"
                                                    id="name_competence" class="rounded-md p-2 border focus:border-green-500">
                                                @error('name_competence')
                                                    <span class="text-red-500">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="flex flex-col">
                                                <label for="description">Descripcion</label>
                                                <textarea value="{{ $competence->description }}" class="rounded-md p-2 border focus:border-green-500" 
                                                    name="description" id="com" cols="30" rows="10"></textarea>
                                                @error('comment')
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
                                data-id="{{ $competence->id_competence }}">
                                Eliminar
                            </button>
                            <form id="delete-form-{{ $competence->id_competence }}" action="{{ route('competence.destroy', $competence->id_competence) }}"
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
            function editUser(id_competence) {
                const editModal = document.getElementById(`editModal-${id_competence}`);
                const editForm = document.getElementById(`editForm-${id_competence}`);
                const editUrl = `/competence/${id_competence}`;

                // Setear la acción del formulario y mostrar el modal
                editForm.action = editUrl;
                editModal.style.display = "block";
            }

            function closeEditModal(id_compentence) {
                const editModal = document.getElementById(`editModal-${id_compentence}`);
                editModal.style.display = "none";
            }
        </script>


        <script>
            $('.form-delete').click(function(e) {
                e.preventDefault();

                var id = $(this).data('id');

                Swal.fire({
                    title: '¿Estás seguro de eliminar la competencia?',
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
    @endsection
