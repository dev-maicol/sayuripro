@extends('layouts.dashboard')

@section('content')
<div class="p-6">
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
                                <input
                                    type="text"
                                    name="nombre"
                                    x-model="value"
                                    @keyup.enter="$refs.nombreInput.form.submit()"
                                    placeholder="Nombre..."
                                    class="w-full p-1 pl-3 pr-7 text-xs border rounded-md dark:bg-gray-800 dark:text-white dark:border-gray-600"
                                    x-ref="nombreInput"
                                >
                                <button
                                    type="button"
                                    x-show="value"
                                    @click="value = ''; $nextTick(() => $refs.nombreInput.form.submit())"
                                    class="absolute inset-y-0 right-1 flex items-center text-gray-400 hover:text-red-500"
                                >✕</button>
                            </div>
                        </th>

                        {{-- Correo --}}
                        <th class="px-6 py-2">
                            <div x-data="{ value: '{{ request('correo') }}' }" class="relative">
                                <input
                                    type="text"
                                    name="correo"
                                    x-model="value"
                                    @keyup.enter="$refs.correoInput.form.submit()"
                                    placeholder="Correo..."
                                    class="w-full p-1 pl-3 pr-7 text-xs border rounded-md dark:bg-gray-800 dark:text-white dark:border-gray-600"
                                    x-ref="correoInput"
                                >
                                <button
                                    type="button"
                                    x-show="value"
                                    @click="value = ''; $nextTick(() => $refs.correoInput.form.submit())"
                                    class="absolute inset-y-0 right-1 flex items-center text-gray-400 hover:text-red-500"
                                >✕</button>
                            </div>
                        </th>

                        {{-- Fecha --}}
                        <th class="px-6 py-2">
                            <div x-data="{ value: '{{ request('fecha') }}' }" class="relative">
                                <input
                                    type="date"
                                    name="fecha"
                                    x-model="value"
                                    @keyup.enter="$refs.fechaInput.form.submit()"
                                    class="w-full p-1 pr-7 text-xs border rounded-md dark:bg-gray-800 dark:text-white dark:border-gray-600"
                                    x-ref="fechaInput"
                                >
                                <button
                                    type="button"
                                    x-show="value"
                                    @click="value = ''; $nextTick(() => $refs.fechaInput.form.submit())"
                                    class="absolute inset-y-0 right-1 flex items-center text-gray-400 hover:text-red-500"
                                >✕</button>
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
                            <td colspan="3" class="text-center py-4 text-gray-500 dark:text-gray-400">No se encontraron resultados.</td>
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
@endsection
