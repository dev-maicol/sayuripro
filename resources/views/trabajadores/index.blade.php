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
            <a href="{{ route('trabajadores.create') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                + Crear trabajador
            </a>
        </div>

        <div class="relative overflow-x-auto sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3">Nombres</th>
                        <th class="px-6 py-3">Paterno</th>
                        <th class="px-6 py-3">Materno</th>
                        <th class="px-6 py-3">Nacimiento</th>
                        <th class="px-6 py-3">Cargo</th>
                        <th class="px-6 py-3">Estado</th>
                        <th class="px-6 py-3">Acciones</th>
                    </tr>

                    <tr>
                        <form method="GET" action="{{ route('trabajadores.index') }}" class="contents">
                            {{-- Nombres --}}
                            <th class="px-6 py-2">
                                <div x-data="{ value: '{{ request('nombres') }}' }" class="relative">
                                    <input type="text" name="nombres" x-model="value"
                                        @keyup.enter="$refs.nombresInput.form.submit()" placeholder="Nombres..."
                                        class="w-full p-1 pl-3 pr-7 text-xs border rounded-md dark:bg-gray-800 dark:text-white dark:border-gray-600"
                                        x-ref="nombresInput">
                                    <button type="button" x-show="value"
                                        @click="value = ''; $nextTick(() => $refs.nombresInput.form.submit())"
                                        class="absolute inset-y-0 right-1 flex items-center text-gray-400 hover:text-red-500">✕</button>
                                </div>
                            </th>

                            {{-- Paterno --}}
                            <th class="px-6 py-2">
                                <div x-data="{ value: '{{ request('paterno') }}' }" class="relative">
                                    <input type="text" name="paterno" x-model="value"
                                        @keyup.enter="$refs.paternoInput.form.submit()" placeholder="Paterno..."
                                        class="w-full p-1 pl-3 pr-7 text-xs border rounded-md dark:bg-gray-800 dark:text-white dark:border-gray-600"
                                        x-ref="paternoInput">
                                    <button type="button" x-show="value"
                                        @click="value = ''; $nextTick(() => $refs.paternoInput.form.submit())"
                                        class="absolute inset-y-0 right-1 flex items-center text-gray-400 hover:text-red-500">✕</button>
                                </div>
                            </th>

                            {{-- Materno --}}
                            <th class="px-6 py-2">
                                <div x-data="{ value: '{{ request('materno') }}' }" class="relative">
                                    <input type="text" name="materno" x-model="value"
                                        @keyup.enter="$refs.maternoInput.form.submit()" placeholder="Materno..."
                                        class="w-full p-1 pl-3 pr-7 text-xs border rounded-md dark:bg-gray-800 dark:text-white dark:border-gray-600"
                                        x-ref="maternoInput">
                                    <button type="button" x-show="value"
                                        @click="value = ''; $nextTick(() => $refs.maternoInput.form.submit())"
                                        class="absolute inset-y-0 right-1 flex items-center text-gray-400 hover:text-red-500">✕</button>
                                </div>
                            </th>

                            {{-- Fecha nacimiento --}}
                            <th class="px-6 py-2">
                                <div x-data="{ value: '{{ request('fecha_nacimiento') }}' }" class="relative">
                                    <input type="date" name="fecha_nacimiento" x-model="value"
                                        @keyup.enter="$refs.fechaInput.form.submit()"
                                        class="w-full p-1 pr-7 text-xs border rounded-md dark:bg-gray-800 dark:text-white dark:border-gray-600"
                                        x-ref="fechaInput">
                                    <button type="button" x-show="value"
                                        @click="value = ''; $nextTick(() => $refs.fechaInput.form.submit())"
                                        class="absolute inset-y-0 right-1 flex items-center text-gray-400 hover:text-red-500">✕</button>
                                </div>
                            </th>

                            {{-- Otros vacíos --}}
                            <th></th>
                            <th></th>
                            <th>
                                <button type="submit" class="hidden">Buscar</button>
                            </th>
                        </form>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($trabajadores as $trabajador)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $trabajador->nombres }}
                            </td>
                            <td class="px-6 py-4">{{ $trabajador->paterno }}</td>
                            <td class="px-6 py-4">{{ $trabajador->materno }}</td>
                            <td class="px-6 py-4">{{ $trabajador->fecha_nacimiento }}</td>
                            <td class="px-6 py-4">{{ $trabajador->cargo->nombre ?? '-' }}</td>
                            <td class="px-6 py-4">
                                @if ($trabajador->activo)
                                    <span class="text-green-500 font-medium">Activo</span>
                                @else
                                    <span class="text-red-500 font-medium">Inactivo</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 flex items-center gap-2">
                                {{-- Editar --}}
                                <a href="{{ route('trabajadores.edit', $trabajador) }}"
                                    class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300"
                                    title="Editar">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.232 5.232l3.536 3.536M9 11l6.732-6.732a2.5 2.5 0 013.536 3.536L12 16l-4 1 1-4z" />
                                    </svg>
                                </a>

                                {{-- Eliminar --}}
                                <form action="{{ route('trabajadores.destroy', $trabajador) }}" method="POST"
                                    onsubmit="return confirm('¿Estás seguro de eliminar este trabajador?')">
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
                            <td colspan="7" class="text-center py-4 text-gray-500 dark:text-gray-400">
                                No se encontraron resultados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginación --}}
        <div class="mt-4">
            {{ $trabajadores->appends(request()->query())->links() }}
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
