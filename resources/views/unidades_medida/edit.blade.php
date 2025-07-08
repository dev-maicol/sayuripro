@extends('layouts.dashboard')

@section('content')
    <div class="p-6 max-w-lg mx-auto">
        <h2 class="text-lg font-semibold text-gray-700 dark:text-white mb-4">Editar unidad de medida</h2>

        <form x-data="{ loading: false }" @submit="loading = true" action="{{ route('unidades_medida.update', $unidadMedida) }}"
            method="POST" class="space-y-4 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            @csrf
            @method('PUT')

            {{-- Nombre --}}
            <div>
                <label for="nombre" class="block mb-1 text-sm font-medium text-gray-700 dark:text-white">Nombre</label>
                <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $unidadMedida->nombre) }}"
                    class="w-full px-3 py-2 text-sm border rounded-lg dark:bg-gray-700 dark:text-white dark:border-gray-600 @error('nombre') border-red-500 @enderror"
                    required>
                @error('nombre')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Botones --}}
            <div class="flex justify-between">
                <button type="submit" :disabled="loading"
                    class="flex items-center justify-center gap-2 text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5"
                    :class="{ 'opacity-50 cursor-not-allowed': loading }">
                    <svg x-show="loading" class="w-4 h-4 text-white animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
                    </svg>
                    <span x-text="loading ? 'Actualizando...' : 'Actualizar'"></span>
                </button>

                <a href="{{ route('unidades_medida.index') }}"
                    class="text-white bg-red-600 hover:bg-red-700 font-medium rounded-lg text-sm px-5 py-2.5">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection
