@extends('layouts.dashboard')

@section('content')
    <div class="max-w-md mx-auto mt-10 bg-gray-800 p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-white mb-6">Editar cargo</h2>

        <form action="{{ route('cargos.update', $cargo) }}" method="POST" x-data="{ loading: false }" @submit="loading = true">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-white">Nombre</label>
                <input type="text" name="nombre" id="nombre" required
                    class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('nombre', $cargo->nombre) }}">
                @error('nombre')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="nombre_corto" class="block text-sm font-medium text-white">Nombre corto</label>
                <input type="text" name="nombre_corto" id="nombre_corto" required
                    class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('nombre_corto', $cargo->nombre_corto) }}">
                @error('nombre_corto')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="funciones" class="block text-sm font-medium text-white">Funciones</label>
                <textarea name="funciones" id="funciones" rows="4"
                    class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('funciones', $cargo->funciones) }}</textarea>
                @error('funciones')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between">
                <button type="submit" :disabled="loading"
                    class="flex items-center justify-center gap-2 text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5"
                    :class="{ 'opacity-50 cursor-not-allowed': loading }">
                    <svg x-show="loading" class="w-4 h-4 text-white animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                    <span x-text="loading ? 'Guardando...' : 'Guardar'"></span>
                </button>

                <a href="{{ route('cargos.index') }}"
                    class="text-white bg-red-600 hover:bg-red-700 font-medium rounded-lg text-sm px-5 py-2.5">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection
