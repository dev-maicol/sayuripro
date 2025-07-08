@extends('layouts.dashboard')

@section('content')
    <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow max-w-xl mx-auto">
        <h2 class="text-xl font-bold mb-4 text-white">Editar Categoría</h2>

        @if ($errors->any())
            <div class="mb-4 text-red-500">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('categorias.update', $categoria) }}" x-data="{ loading: false }"
            @submit.prevent="loading = true; $el.submit()">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-white">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre', $categoria->nombre) }}"
                    class="w-full p-2 rounded border border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600">
            </div>

            <div class="flex justify-between">
                <button type="submit" :disabled="loading"
                    class="flex items-center justify-center gap-2 text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5"
                    :class="{ 'opacity-50 cursor-not-allowed': loading }">
                    <svg x-show="loading" class="w-4 h-4 text-white animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                    <span x-text="loading ? 'Actualizando...' : 'Actualizar'"></span>
                </button>

                <a href="{{ route('categorias.index') }}"
                    class="text-white bg-red-600 hover:bg-red-700 font-medium rounded-lg text-sm px-5 py-2.5">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection
