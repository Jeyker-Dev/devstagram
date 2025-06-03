<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-gray-100 antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
        <x-general.header />

       {{ $slot }}
        @fluxScripts
    </body>
</html>
