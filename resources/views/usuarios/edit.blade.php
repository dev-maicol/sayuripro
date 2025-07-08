@extends('layouts.dashboard')

@section('content')
    <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow max-w-xl mx-auto">
        <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-white">Editar Usuario</h2>

        @if ($errors->any())
            <div class="mb-4 text-red-500">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('usuarios.update', $usuario) }}" x-data="{ loading: false }"
            @submit.prevent="loading = true; $el.submit()">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-white" for="name">Nombre</label>
                <input type="text" name="name"
                    class="w-full p-2 rounded border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                    value="{{ old('name', $usuario->name) }}">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-white">Correo</label>
                <input type="email" name="email"
                    class="w-full p-2 rounded border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                    value="{{ old('email', $usuario->email) }}">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-white">Contraseña (opcional)</label>
                <input type="password" name="password"
                    class="w-full p-2 rounded border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-white">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation"
                    class="w-full p-2 rounded border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
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

                <a href="{{ route('usuarios.index') }}"
                    class="text-white bg-red-600 hover:bg-red-700 font-medium rounded-lg text-sm px-5 py-2.5">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection
