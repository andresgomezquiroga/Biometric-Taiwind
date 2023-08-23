@extends('home.masterpage')

@section('contenido')

    <div class="py-6 px-8">
        <div
            class="bg-white p-4 rounded-md mt-4 overflow-auto sm:overflow-visible md:overflow-hidden lg:overflow-x-scroll xl:overflow-y-scroll">
            <h1 class="text-gray-500 text-lg font-semibold pb-4">Aprendices de la ficha: {{ $fichas->number_ficha }}</h1>
            <div class="my-1"></div>
            <div class="bg-gradient-to-r from-green-300 to-cyan-500 h-px mb-6 "></div>
            <table class="w-full table-auto text-sm ">
                <thead>
                    <tr class="text-sm leading-normal">
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            id</th>
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            Nombre y apellido</th>

                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            Correo</th>

                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            Edad</th>
                        
                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            Tipo de documento</th>

                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            Numero de documento</th>

                        <th
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            Imagen</th>





                    </tr>
                </thead>
                <tbody>
                    @foreach ($aprendizes as $aprendize)
                        <tr class="hover:bg-grey-lighter">
                            <td class="py-2 px-4 border-b border-grey-light text-center">{{ $aprendize->id }}
                            </td>
                            <td class="py-2 px-4 border-b border-grey-light text-center">{{ $aprendize->name }} {{ $aprendize->last_name }}
                            </td>
                            <td class="py-2 px-4 border-b border-grey-light text-center">{{ $aprendize->email }}</td>
                            <td class="py-2 px-4 border-b border-grey-light text-center">{{ $aprendize->edad }}</td>
                            <td class="py-2 px-4 border-b border-grey-light text-center">{{ $aprendize->type_document }}</td>
                            <td class="py-2 px-4 border-b border-grey-light text-center">{{ $aprendize->number_document }}</td>
                            <td class="py-2 px-4 border-b border-grey-light text-center">
                                @if ($aprendize->image && file_exists(public_path('img/imagesUsers/' . $aprendize->image)))
                                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('img/imagesUsers/' . $aprendize->image) }}" alt="Foto" style="width: 50px;">
                                @else
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('img/user_default.png') }}" alt="Imagen por defecto" width="50" height="50">
                                @endif
                            </td>

                        </tr>


                        </tr>
                    @endforeach

                </tbody>
            </table>
            <a href="{{ route('ficha.export.excel', ['ficha' => $fichas->id_ficha]) }}"
                class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg mt-4">
                 Descargar Excel
             </a>
        </div>
    @endsection
</div>


