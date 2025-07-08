@extends('layouts.dashboard')

@section('content')
    <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow max-w-xl mx-auto">
        <h2 class="text-xl font-semibold mb-6 text-white">Crear trabajador</h2>

        <form method="POST" action="{{ route('trabajadores.store') }}" x-data="{ loading: false }"
            @submit.prevent="loading = true; $el.submit()">
            @csrf

            <div class="mb-4">
                <label for="nombres" class="block text-sm font-medium text-white mb-1">Nombres</label>
                <input type="text" name="nombres" id="nombres" required
                    class="w-full px-4 py-2 border border-gray-600 rounded-md bg-gray-700 text-white"
                    value="{{ old('nombres') }}">
            </div>

            <div class="mb-4">
                <label for="paterno" class="block text-sm font-medium text-white mb-1">Apellido paterno</label>
                <input type="text" name="paterno" id="paterno"
                    class="w-full px-4 py-2 border border-gray-600 rounded-md bg-gray-700 text-white"
                    value="{{ old('paterno') }}">
            </div>

            <div class="mb-4">
                <label for="materno" class="block text-sm font-medium text-white mb-1">Apellido materno</label>
                <input type="text" name="materno" id="materno"
                    class="w-full px-4 py-2 border border-gray-600 rounded-md bg-gray-700 text-white"
                    value="{{ old('materno') }}">
            </div>

            <div class="mb-4">
                <label for="fecha_nacimiento" class="block text-sm font-medium text-white mb-1">Fecha de nacimiento</label>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" required
                    class="w-full px-4 py-2 border border-gray-600 rounded-md bg-gray-700 text-white"
                    value="{{ old('fecha_nacimiento') }}">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-white mb-1">Correo electrónico</label>
                <input type="email" name="email" id="email" required
                    class="w-full px-4 py-2 border border-gray-600 rounded-md bg-gray-700 text-white"
                    value="{{ old('email') }}">
            </div>

            <div class="mb-6">
                <label for="cargo_id" class="block text-sm font-medium text-white mb-1">Cargo</label>
                <select name="cargo_id" id="cargo_id" required
                    class="w-full px-4 py-2 border border-gray-600 rounded-md bg-gray-700 text-white">
                    <option value="">Seleccione un cargo</option>
                    @foreach ($cargos as $cargo)
                        <option value="{{ $cargo->id }}" {{ old('cargo_id') == $cargo->id ? 'selected' : '' }}>
                            {{ $cargo->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-between">
                <button type="submit" :disabled="loading"
                    class="flex items-center justify-center gap-2 text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5"
                    :class="{ 'opacity-50 cursor-not-allowed': loading }">
                    <svg x-show="loading" class="w-4 h-4 text-white animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                    <span x-text="loading ? 'Guardando...' : 'Guardar'"></span>
                </button>

                <a href="{{ route('trabajadores.index') }}"
                    class="text-white bg-red-600 hover:bg-red-700 font-medium rounded-lg text-sm px-5 py-2.5">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection
