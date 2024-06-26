<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Devstagram - @yield('titulo')</title>

        <script src="{{ asset('js/app.js') }}" defer></script>

        @vite('resources/css/app.css')
    </head>
<!--    Here End Head -->
    <body class="bg-gray-100">
        <header class="p-5 border-p bg-white shadow">
            <div class="container mx-auto flex justify-between">
                <h1 class="text-3xl font-black">Devstagram</h1>

                <nav class="flex gap-2 items-center">
                    <a class="font-bold uppercase text-gray-600 text-sm" href="#">Login</a>
                    <a class="font-bold uppercase text-gray-600 text-sm" href="/crear-cuenta">Crear Cuenta</a>
                </nav>
<!--    Here End Nav -->
            </div>
        </header>
<!--    Here End Header -->
        <main class="container mx-auto mt-10">
            <h2 class="font-black text-center text-3xl mb-10">
                @yield('titulo')
            </h2>

            @yield('contenido')
        </main>
<!--    Here End Main -->
        <footer class="mt-10 text-center p-5 text-gray-500 font-bold uppercase">
            Devstagram - Todos los Derechos Reservados
            {{ now()->year}}
        </footer>
<!--    Here End Footer -->
    </body>
</html>