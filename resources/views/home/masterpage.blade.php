@extends('template')


@section('title', 'Panel administrativo')

@section('content')

    <body class="bg-gray-200">
        <nav class="bg-white border-b border-gray-300">
            <div class="flex justify-between items-center px-9">
                <!-- Aumenté el padding aquí para añadir espacio en los lados -->
                <!-- Ícono de Menú -->
                <button id="menuBtn">
                    <i class="fas fa-bars text-green-500 text-lg"></i>
                </button>

                <!-- Logo -->
                <div class="ml-4">
                    <img src="{{ asset('img/logo_sena.png') }}" alt="logo" class="w-10 mx-auto">
                </div>


                <div x-data="{ open: false }" class="bg-white  w-64  justify-center items-center">
                    <div @click="open = !open" class="relative border-b-4 border-transparent py-3"
                        :class="{ 'border-indigo-700 transform transition duration-300 ': open }"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100">
                        <div class="flex justify-center items-center space-x-3 cursor-pointer">
                            <div class="w-12 h-12 rounded-full overflow-hidden border-2 dark:border-white border-gray-900">
                                <img src="https://images.unsplash.com/photo-1610397095767-84a5b4736cbd?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80"
                                    alt="" class="w-full h-full object-cover">
                            </div>
                            <div class="font-semibold text-black text-lg">
                                <div class="cursor-pointer">{{ Auth::user()->name }} {{ Auth::user()->last_name }}</div>
                            </div>
                        </div>

                        <div x-show="open" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute w-60 px-5 py-3 dark:bg-gray-800 bg-white rounded-lg shadow border dark:border-transparent mt-5">
                            <ul class="space-y-3 dark:text-white">
                                <li class="font-medium">
                                    <a href="#"
                                        class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-indigo-700">
                                        <div class="mr-3">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                </path>
                                            </svg>
                                        </div>
                                        Datos personales
                                    </a>

                                </li>
                                <hr class="dark:border-gray-700">
                                <li class="font-medium">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent">
                                            <div class="mr-3 text-red-600">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                                    </path>
                                                </svg>
                                            </div>
                                            Cerrar sesión
                                        </button>
                                    </form>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Barra lateral -->
        <div id="sideNav" class="lg:block hidden bg-white w-64 h-screen fixed rounded-none border-none">
            <!-- Items -->
            <div class="p-4 space-y-4">
                <!-- Inicio -->
                <a href="#" aria-label="dashboard"
                    class="relative px-4 py-3 flex items-center space-x-4 rounded-lg text-white bg-green-700">
                    <i class="fas fa-home text-black"></i>
                    <span class="-mr-1 font-medium">Inicio</span>
                </a>

                <a href="{{route ('user.index')}}" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-500 group">
                    <i class="fas fa-users"></i>
                    <span>Usuarios</span>
                </a>

                <a href="{{ route('ficha.index') }}" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-500 group">
                    <i class="fas fa-id-card"></i>
                    <span>Fichas</span>
                </a>

                <a href="{{ route('program.index') }}"
                    class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-500 group">
                    <i class="fas fa-book"></i>
                    <span>Programas</span>
                </a>

                <a href="{{ route('timeTable.index') }}" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-500 group">
                    <i class="far fa-clock"></i>
                    <span>Horarios</span>
                </a>

                <a href="#" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-500 group">
                    <i class="fas fa-file-alt"></i>
                    <span>Excusas</span>
                </a>

                <a href="#" class="px-4 py-3 flex items-center space-x-4 rounded-md text-gray-500 group">
                    <i class="fas fa-trophy"></i>
                    <span>Competencias</span>
                </a>

            </div>
        </div>

        <div class="lg:ml-64 lg:pl-4 lg:flex lg:flex-col lg:w-75% mt-5 mx-2">
            @yield('contenido')
        </div>

        @yield('js')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




        <!-- Script  -->
        <script>
            // lógica para mostrar/ocultar la navegación lateral al hacer clic en el ícono de menú
            const menuBtn = document.getElementById('menuBtn');
            const sideNav = document.getElementById('sideNav');

            menuBtn.addEventListener('click', () => {
                sideNav.classList.toggle('hidden');
            });
        </script>

    @endsection
