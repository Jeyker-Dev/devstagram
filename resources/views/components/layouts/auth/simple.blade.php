<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-gray-100 antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
        <x-general.header />

        <x-general.title>
            Iniciar Sesión en Devstagram
        </x-general.title>

        <div class="flex flex-col md:flex-row w-11/12 lg:w-9/12 xl:w-8/12 mx-auto gap-6 lg:gap-20 my-10">
            <img src="{{ asset('img/login.jpg') }}" alt="" class="object-center object-cover w-1/2 max-w-2xl">

            {{ $slot }}
        </div>
        @fluxScripts
    </body>
</html>
