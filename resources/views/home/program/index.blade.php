@extends('home.masterpage')

@section('contenido')
<div class="py-6 px-8">
    <button class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg mb-4" id="openModal">Agregar Programa</button>
    
    <!-- Modal -->
    <div class="fixed inset-0 z-50 flex items-center justify-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none" id="myModal" style="display: none;">
        <div class="relative w-auto my-6 mx-auto max-w-sm">
            <div class="bg-white rounded-lg shadow-lg relative flex flex-col w-full p-6">
                <span class="absolute top-0 right-0 mt-4 mr-4 cursor-pointer" id="closeModal">×</span>
                <h2 class="text-lg font-semibold mb-4">Agregar Programa</h2>
                <form action="{{ route('program.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="flex flex-col">
                        <label for="name_program">Nombre del Programa</label>
                        <input type="text" name="name_program" id="name_program" class="rounded-md p-2 border focus:border-green-500">
                    </div>
                    <div class="flex flex-col">
                        <label for="code_program">Código del Programa</label>
                        <input type="number" name="code_program" id="code_program" class="rounded-md p-2 border focus:border-green-500">
                    </div>
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg">Agregar</button>
                </form>
            </div>
        </div>
    </div>




    <div class="bg-white p-4 rounded-md mt-4 overflow-auto sm:overflow-visible md:overflow-hidden lg:overflow-x-scroll xl:overflow-y-scroll">
        <h2 class="text-gray-500 text-lg font-semibold pb-4">Programas</h2>
        <div class="my-1"></div> 
        <div class="bg-gradient-to-r from-green-300 to-cyan-500 h-px mb-6 "></div> 
        <table class="w-full table-auto text-sm ">
            <thead>
                <tr class="text-sm leading-normal">
                    <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light">ID</th>
                    <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light">Nombre del programa</th>
                    <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-right">Codigo del programa</th>
                    <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-right">Acciones</th>


                </tr>
            </thead>
            <tbody>
                @foreach($programs as $program)
                <tr class="hover:bg-grey-lighter">
                    <td class="py-2 px-4 border-b border-grey-light">{{ $program->id_program }}</td>
                    <td class="py-2 px-4 border-b border-grey-light">{{ $program->name_program }}</td>
                    <td class="py-2 px-4 border-b border-grey-light">{{$program->code_program}}</td>
                    <td class="py-2 px-4 border-b border-grey-light text-right">
                        <a href="javascript:void(0);"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-2 rounded mr-2"
                        onclick="editProgram({{ $program->id_program }})">
                        Editar
                     </a>
                     <div class="fixed inset-0 z-50 flex items-center justify-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none" id="editModal" style="display: none;">
                        <div class="relative w-auto my-6 mx-auto max-w-sm">
                            <div class="bg-white rounded-lg shadow-lg relative flex flex-col w-full p-6">
                                <span class="absolute top-0 right-0 mt-4 mr-4 cursor-pointer" id="closeEditModal">×</span>
                                <h2 class="text-lg font-semibold mb-4">Editar Programa</h2>
                                <form id="editForm" method="POST" class="space-y-4">
                                    @csrf
                                    @method('PUT')
                                    <div class="flex flex-col">
                                        <label for="edit_name_program">Nombre del Programa</label>
                                        <input value="{{ $program->name_program }}" type="text" name="name_program" id="edit_name_program" class="rounded-md p-2 border focus:border-green-500">
                                    </div>
                                    <div class="flex flex-col">
                                        <label for="edit_code_program">Código del Programa</label>
                                        <input value="{{ $program->code_program }}" type="number" name="code_program" id="edit_code_program" class="rounded-md p-2 border focus:border-green-500">
                                    </div>
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg">Editar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                
                    <button class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-2 rounded form-delete" data-id="{{$program->id_program}}">
                        Eliminar
                    </button>
                    <form id="delete-form-{{$program->id_program}}" action="{{ route('program.destroy', $program->id_program) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    </td>
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

    @if(Session::has('success'))
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
    function editProgram(id_program) {
        const editUrl = `/programa/${id_program}`;
        document.getElementById("editForm").action = editUrl;

        document.getElementById("editModal").style.display = "block";
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

        @if (session('delete') == 'ok')
        Swal.fire(
            'Eliminado correctamente',
            'El programa ha sido eliminado',
            'success'
        );
        @endif
    });


</script>
@if (session('delete') == 'ok')
<script>

    Swal.fire(
        'Eliminado correctamente',
        'El programa ha sido eliminado',
        'success'
    );

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