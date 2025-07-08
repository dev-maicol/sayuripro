@extends('layouts.dashboard')

@section('content')
    {{-- Alertas --}}
    @if (session('success'))
        <div id="alert-3"
            class="fixed top-5 right-5 z-50 flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800"
            role="alert" data-dismissible="alert">
            <svg class="shrink-0 w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <div class="ms-3 text-sm font-medium">
                {{ session('success') }}
            </div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-3" aria-label="Close">
                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14">
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
            <a href="{{ route('cargos.create') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                + Crear cargo
            </a>
        </div>

        {{-- Filtros dentro de tabla --}}
        <div class="relative overflow-x-auto sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nombre</th>
                        <th scope="col" class="px-6 py-3">Nombre corto</th>
                        <th scope="col" class="px-6 py-3">Funciones</th>
                        <th scope="col" class="px-6 py-3">Acciones</th>
                    </tr>

                    {{-- Fila de filtros --}}
                    <tr>
                        <form method="GET" action="{{ route('cargos.index') }}" class="contents">
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

                            <th class="px-6 py-2">
                                <div x-data="{ value: '{{ request('nombre_corto') }}' }" class="relative">
                                    <input type="text" name="nombre_corto" x-model="value"
                                        @keyup.enter="$refs.nombreCortoInput.form.submit()" placeholder="Nombre corto..."
                                        class="w-full p-1 pl-3 pr-7 text-xs border rounded-md dark:bg-gray-800 dark:text-white dark:border-gray-600"
                                        x-ref="nombreCortoInput">
                                    <button type="button" x-show="value"
                                        @click="value = ''; $nextTick(() => $refs.nombreCortoInput.form.submit())"
                                        class="absolute inset-y-0 right-1 flex items-center text-gray-400 hover:text-red-500">✕</button>
                                </div>
                            </th>

                            <th class="px-6 py-2">
                                <div x-data="{ value: '{{ request('funciones') }}' }" class="relative">
                                    <input type="text" name="funciones" x-model="value"
                                        @keyup.enter="$refs.funcionesInput.form.submit()" placeholder="Funciones..."
                                        class="w-full p-1 pl-3 pr-7 text-xs border rounded-md dark:bg-gray-800 dark:text-white dark:border-gray-600"
                                        x-ref="funcionesInput">
                                    <button type="button" x-show="value"
                                        @click="value = ''; $nextTick(() => $refs.funcionesInput.form.submit())"
                                        class="absolute inset-y-0 right-1 flex items-center text-gray-400 hover:text-red-500">✕</button>
                                </div>
                            </th>

                            {{-- Botón oculto --}}
                            <th>
                                <button type="submit" class="hidden">Filtrar</button>
                            </th>
                        </form>

                    </tr>
                </thead>

                <tbody>
                    @forelse ($cargos as $cargo)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $cargo->nombre }}
                            </td>
                            <td class="px-6 py-4">{{ $cargo->nombre_corto }}</td>
                            <td class="px-6 py-4">{{ $cargo->funciones }}</td>
                            <td class="px-6 py-4 flex items-center gap-2">
                                {{-- Editar --}}
                                <a href="{{ route('cargos.edit', $cargo) }}"
                                    class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300"
                                    title="Editar">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.232 5.232l3.536 3.536M9 11l6.732-6.732a2.5 2.5 0 013.536 3.536L12 16l-4 1 1-4z" />
                                    </svg>
                                </a>

                                {{-- Eliminar --}}
                                <form action="{{ route('cargos.destroy', $cargo) }}" method="POST"
                                    onsubmit="return confirm('¿Estás seguro de eliminar este cargo?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Eliminar"
                                        class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500 dark:text-gray-400">
                                No se encontraron resultados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginación --}}
        <div class="mt-4">
            {{ $cargos->appends(request()->query())->links() }}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const alerts = document.querySelectorAll('[data-dismissible="alert"]');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.classList.add('opacity-0', 'transition-opacity', 'duration-500');
                    setTimeout(() => alert.remove(), 500);
                }, 4000);
            });
        });
    </script>
@endsection
