<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Devstagram - @yield('titulo')</title>

        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        @livewireStyles
        @stack('styles')
        @stack('scripts')
    </head>
<!--    Here End Head -->
    <body class="bg-gray-100">
        <header class="p-5 border-p bg-white shadow">
            <div class="container mx-auto flex justify-between">
                <a href="{{route('home')}}" class="text-3xl font-black">Devstagram</a>

                @auth
                <nav class="flex gap-2 items-center">

                    <a href="{{ route('posts.create') }}" class="flex items-center gap-2 bg-white border p-2 text-gray-600 text-sm uppercase font-bold cursor-pointer">

                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-photo"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 8h.01" /><path d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12z" /><path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5" /><path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3" /></svg>
                        Crear

                    </a>

                    <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('posts.index', auth()->user()->username) }}">Hola: 
                        <span class="font-normal">
                            {{ auth()->user()->username }}
                        </span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                    <button type="submit" class="font-bold uppercase text-gray-600 text-sm" href="{{ route('logout') }}">Cerrar Sesion</button>
                    </form>
                </nav>
<!--    Here End Nav -->
                @endauth

                @guest
                    <nav class="flex gap-2 items-center">
                        <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('login') }}">Login</a>
                        <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('register') }}">Crear Cuenta</a>
                    </nav>
<!--    Here End Nav -->
                @endguest

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
        @livewireScripts

    </body>
</html>