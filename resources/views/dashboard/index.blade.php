@extends('layouts.dashboard')

@section('content')
    {{-- <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Bienvenido, {{ Auth::user()->name }}</h2>
        <p class="mt-2 text-gray-600 dark:text-gray-300">Este es tu panel con Flowbite y Laravel 12.</p>
    </div> --}}

    <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
        @auth
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                Bienvenido, {{ Auth::user()->name }}
            </h2>
            <p class="mt-2 text-gray-600 dark:text-gray-300">Este es tu panel administrativo.</p>
        @else
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                Bienvenido
            </h2>
            <p class="mt-2 text-gray-600 dark:text-gray-300">Por favor, inicia sesión para continuar.</p>
        @endauth
    </div>
@endsection
