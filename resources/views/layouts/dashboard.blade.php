<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-gray-900">

    <div class="flex">
        {{-- Sidebar --}}
        <aside class="w-64 h-screen bg-white border-r dark:bg-gray-800 dark:border-gray-700">
            <div class="p-4 text-lg font-semibold text-gray-900 dark:text-white border-b dark:border-gray-700">
                {{ config('app.name') }}
            </div>
            <nav class="p-4 space-y-2">
                <a href="{{ route('dashboard') }}"
                    class="block px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200">Dashboard</a>
                <a href="{{ route('usuarios.index') }}"
                    class="block px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200">Usuarios</a>
                <a href="{{ route('cargos.index') }}"
                    class="block px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200">Cargos</a>
                <a href="{{ route('trabajadores.index') }}"
                    class="block px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200">Trabajadores</a>
                <a href="{{ route('unidades_medida.index') }}"
                    class="block px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200">Unidades de Medida</a>
                <a href="{{ route('categorias.index') }}"
                    class="block px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200">Categorías</a>
                <a href="{{ route('sub_categorias.index') }}"
                    class="block px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200">Subcategorías</a>
                <a href="#"
                    class="block px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200">Configuraciones</a>
            </nav>
        </aside>

        {{-- Contenido principal --}}
        <div class="flex-1 flex flex-col h-screen">
            {{-- Navbar --}}
            <header
                class="flex items-center justify-between px-6 py-4 bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <h1 class="text-xl font-semibold text-gray-800 dark:text-white">Dashboard</h1>
                <div class="flex items-center gap-4">
                    <!-- Botón de cambio de tema -->
                    <button id="theme-toggle" type="button"
                        class="text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm">
                        <svg id="theme-toggle-dark-icon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.293 13.95A8 8 0 016.05 2.707a8 8 0 1011.243 11.243z">
                            </path>
                        </svg>
                        {{-- <svg id="theme-toggle-light-icon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zM4.22 4.22a1 1 0 011.42 0l.71.7a1 1 0 01-1.41 1.42l-.71-.71a1 1 0 010-1.41zM2 10a1 1 0 011-1h1a1 1 0 110 2H3a1 1 0 01-1-1zm8 6a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm5.66-1.34a1 1 0 011.41 1.42l-.7.7a1 1 0 11-1.42-1.41l.71-.71zM17 10a1 1 0 100-2h-1a1 1 0 100 2h1zm-2.34-5.66a1 1 0 00-1.41-1.42l-.71.71a1 1 0 001.42 1.41l.7-.7z">
                            </path>
                        </svg> --}}
                        <svg id="theme-toggle-light-icon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.875 6v2.469c0 .844-.375 1.25-1.156 1.25s-1.156-.406-1.156-1.25V6c0-.813.375-1.219 1.156-1.219s1.156.406 1.156 1.219m2.344 3.25 1.438-2.031c.469-.625 1.063-.75 1.656-.313s.656 1 .188 1.688l-1.438 2c-.469.688-1.031.75-1.656.313-.594-.438-.656-.969-.188-1.656zm-8.438-2 1.469 2c.469.688.406 1.219-.219 1.656-.594.469-1.156.375-1.625-.313l-1.469-2c-.469-.688-.406-1.219.219-1.656.594-.469 1.156-.375 1.625.313m4.938 3.875A4.88 4.88 0 0 1 15.594 16c0 2.656-2.188 4.813-4.875 4.813S5.844 18.657 5.844 16a4.88 4.88 0 0 1 4.875-4.875m-9.125.688 2.375.75c.781.25 1.063.719.813 1.469-.219.75-.75.969-1.563.719l-2.313-.75q-1.172-.375-.844-1.5c.25-.719.75-.938 1.531-.688zm15.906.75 2.344-.75c.813-.25 1.313-.031 1.531.688.25.75-.031 1.25-.844 1.469l-2.313.781c-.781.25-1.281.031-1.531-.719-.219-.75.031-1.219.813-1.469m-6.781 6.125c1.5 0 2.719-1.219 2.719-2.688 0-1.5-1.219-2.719-2.719-2.719S8.031 14.5 8.031 16a2.69 2.69 0 0 0 2.688 2.688m-9.813-.719 2.344-.75c.781-.25 1.313-.063 1.531.688.25.75-.031 1.219-.813 1.469l-2.375.781c-.781.25-1.281.031-1.531-.719-.219-.75.063-1.219.844-1.469m17.313-.75 2.344.75c.781.25 1.063.719.813 1.469-.219.75-.719.969-1.531.719l-2.344-.781c-.813-.25-1.031-.719-.813-1.469.25-.75.75-.938 1.531-.688M3.938 23.344l1.469-1.969c.469-.688 1.031-.781 1.625-.313.625.438.688.969.219 1.656l-1.469 1.969c-.469.688-1.031.813-1.656.375-.594-.438-.656-1.031-.188-1.719zm12.125-1.969 1.438 1.969c.469.688.406 1.281-.188 1.719s-1.188.281-1.656-.344l-1.438-2c-.469-.688-.406-1.219.188-1.656.625-.438 1.188-.375 1.656.313zm-4.188 2.094v2.469c0 .844-.375 1.25-1.156 1.25s-1.156-.406-1.156-1.25v-2.469c0-.844.375-1.25 1.156-1.25s1.156.406 1.156 1.25"/>
                        </svg>
                    </button>


                    {{-- Botón de notificaciones --}}
                    {{-- Información del usuario --}}

                    @if (Auth::check())
                        <span class="text-sm text-gray-600 dark:text-gray-300">{{ Auth::user()->name }}</span>
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-red-600 hover:underline dark:text-red-400">Cerrar
                            sesión</button>
                    </form>
                </div>
            </header>

            {{-- Contenido dinámico --}}
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        const themeToggleBtn = document.getElementById('theme-toggle');
        const darkIcon = document.getElementById('theme-toggle-dark-icon');
        const lightIcon = document.getElementById('theme-toggle-light-icon');

        // Inicial: Mostrar el ícono correcto
        if (localStorage.getItem('color-theme') === 'dark' ||
            (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            darkIcon.classList.add('hidden');
            lightIcon.classList.remove('hidden');
        } else {
            document.documentElement.classList.remove('dark');
            lightIcon.classList.add('hidden');
            darkIcon.classList.remove('hidden');
        }

        themeToggleBtn.addEventListener('click', function() {
            // toggle icons
            darkIcon.classList.toggle('hidden');
            lightIcon.classList.toggle('hidden');

            // cambiar tema
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        });
    </script>


</body>

</html>
