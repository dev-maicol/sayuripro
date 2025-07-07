@extends('layouts.dashboard')

@section('content')
    @if (session('success'))
        {{-- <div class="mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-100 dark:bg-green-200 dark:text-green-900"
            role="alert">
            {{ session('success') }}
        </div> --}}
        {{-- <div id="alert-3"
            class="fixed top-5 right-5 z-50 flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert" data-dismissible="alert">
            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-medium">
                {{ session('success') }}
            </div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-3" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div> --}}

        <div id="alert-3"
            class="fixed top-5 right-5 z-50 flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800"
            role="alert" data-dismissible="alert">
            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <div class="ms-3 text-sm font-medium">
                {{ session('success') }}
            </div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-3" aria-label="Close">
                <span class="sr-only">Dismiss</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-100 dark:bg-red-200 dark:text-red-900" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div class="p-6">
        <div class="flex justify-start mb-4">
            <a href="{{ route('usuarios.create') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                + Crear usuario
            </a>
        </div>

        <form method="GET" action="{{ route('usuarios.index') }}" class="mb-6">
            <div class="relative overflow-x-auto sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        {{-- Encabezado --}}
                        <tr>
                            <th scope="col" class="px-6 py-3">Nombre</th>
                            <th scope="col" class="px-6 py-3">Correo</th>
                            <th scope="col" class="px-6 py-3">Fecha de registro</th>
                        </tr>

                        {{-- Filtros --}}
                        <tr>
                            {{-- Nombre --}}
                            <th class="px-6 py-2">
                                <div x-data="{ value: '{{ request('nombre') }}' }" class="relative">
                                    <input type="text" name="nombre" x-model="value"
                                        @keyup.enter="$refs.nombreInput.form.submit()" placeholder="Nombre..."
                                        class="w-full p-1 pl-3 pr-7 text-xs border rounded-md dark:bg-gray-800 dark:text-white dark:border-gray-600"
                                        x-ref="nombreInput">
                                    <button type="button" x-show="value"
                                        @click="value = ''; $nextTick(() => $refs.nombreInput.form.submit())"
                                        class="absolute inset-y-0 right-1 flex items-center text-gray-400 hover:text-red-500">✕</button>
                                </div>
                            </th>

                            {{-- Correo --}}
                            <th class="px-6 py-2">
                                <div x-data="{ value: '{{ request('correo') }}' }" class="relative">
                                    <input type="text" name="correo" x-model="value"
                                        @keyup.enter="$refs.correoInput.form.submit()" placeholder="Correo..."
                                        class="w-full p-1 pl-3 pr-7 text-xs border rounded-md dark:bg-gray-800 dark:text-white dark:border-gray-600"
                                        x-ref="correoInput">
                                    <button type="button" x-show="value"
                                        @click="value = ''; $nextTick(() => $refs.correoInput.form.submit())"
                                        class="absolute inset-y-0 right-1 flex items-center text-gray-400 hover:text-red-500">✕</button>
                                </div>
                            </th>

                            {{-- Fecha --}}
                            <th class="px-6 py-2">
                                <div x-data="{ value: '{{ request('fecha') }}' }" class="relative">
                                    <input type="date" name="fecha" x-model="value"
                                        @keyup.enter="$refs.fechaInput.form.submit()"
                                        class="w-full p-1 pr-7 text-xs border rounded-md dark:bg-gray-800 dark:text-white dark:border-gray-600"
                                        x-ref="fechaInput">
                                    <button type="button" x-show="value"
                                        @click="value = ''; $nextTick(() => $refs.fechaInput.form.submit())"
                                        class="absolute inset-y-0 right-1 flex items-center text-gray-400 hover:text-red-500">✕</button>
                                </div>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($usuarios as $usuario)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $usuario->name }}
                                </td>
                                <td class="px-6 py-4">{{ $usuario->email }}</td>
                                <td class="px-6 py-4">{{ $usuario->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4 text-gray-500 dark:text-gray-400">No se
                                    encontraron resultados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </form>

        {{-- Paginación --}}
        <div class="mt-4">
            {{ $usuarios->appends(request()->query())->links() }}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const dismissibleAlerts = document.querySelectorAll('[data-dismissible="alert"]');

            dismissibleAlerts.forEach((alert) => {
                setTimeout(() => {
                    alert.classList.add('opacity-0', 'transition-opacity', 'duration-500');
                    setTimeout(() => alert.remove(), 500); // Espera a que se desvanezca
                }, 4000); // 4 segundos
            });
        });
    </script>
@endsection
