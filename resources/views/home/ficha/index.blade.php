@extends('home.masterpage')

@section('contenido')

<div class="py-6 px-8">
    <a href="#" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg mb-4" id="openModal">Agregar Ficha</a>
    
    <!-- Modal -->
    <div class="fixed inset-0 z-50 flex items-center justify-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none" id="myModal" style="display: none;">
        <div class="relative w-auto my-6 mx-auto max-w-sm">
            <div class="bg-white rounded-lg shadow-lg relative flex flex-col w-full p-6">
                <span class="absolute top-0 right-0 mt-4 mr-4 cursor-pointer" id="closeModal">×</span>
                <h2 class="text-lg font-semibold mb-4">Agregar Ficha</h2>
                <form action="{{ route('ficha.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="flex flex-col">
                        <label for="number_ficha">Numero de la ficha</label>
                        <input type="number" name="number_ficha" id="numer_ficha" class="rounded-md p-2 border focus:border-green-500">
                    </div>
                    <div class="flex flex-col">
                        <label for="programa_id">Programas de formacion disponibles</label>
                        <select name="programa_id" id="" class="rounded-md p-2 border focus:border-green-500">
                            @foreach ($programs as $program)
                                <option value="{{ $program->id_program }}">Nombre del programa: {{ $program->name_program }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label for="date_start">Fecha inicio</label>
                        <input type="date" name="date_start" id="date_start" class="rounded-md p-2 border focus:border-green-500">
                    </div>
                    <div class="flex flex-col">
                        <label for="date_end">Fecha finalizacion</label>
                        <input type="date" name="date_end" id="date_end" class="rounded-md p-2 border focus:border-green-500">
                    </div>
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg">Agregar</button>
                </form>
            </div>
        </div>
    </div>

    <div class="grid mt-10 grid-cols-3 gap-4">
        @foreach ($fichas as $ficha)
            <div class="max-w-sm rounded overflow-hidden shadow-lg">
                <img class="w-32 mx-auto " src="{{ asset('img/logo_sena.png') }}" alt="Sunset in the mountains">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">Ficha {{ $ficha->number_ficha }}</div>
                    <p class="text-gray-700 text-base">
                        Fecha inicio: {{ $ficha->date_start }}<br>
                        Fecha finalización: {{ $ficha->date_end }}<br>
                        Programa de formación: {{ $ficha->program->name_program ?? 'No hay programa' }}
                    </p>
                    <button class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-2 rounded form-delete" data-id="{{$ficha->id_ficha}}">
                        Eliminar
                    </button>
                    <form id="delete-form-{{$ficha->id_ficha}}" action="{{ route('ficha.destroy', $ficha->id_ficha) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    
                </div>
            </div>
        @endforeach
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