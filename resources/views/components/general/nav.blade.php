<div x-data="{ open: false }">
    @if(!\Illuminate\Support\Facades\Auth::user())
        <nav class="hidden sm:flex sm:gap-4">
            <a href="{{ route('login') }}" class="font-bold">Iniciar Sesion</a>
            <a href="{{ route('register') }}" class="font-bold">Crear Cuenta</a>
        </nav>

        <button @click="open =! open" class="sm:hidden mb-4">
            <x-icons.menu class="cursor-pointer"/>
        </button>

        <nav x-show="open" class="flex flex-col gap-4"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-90"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-90"
        >
            <a href="{{ route('login') }}" class="font-bold">Iniciar Sesion</a>
            <a href="{{ route('register') }}" class="font-bold">Crear Cuenta</a>
        </nav>
    @else
        <div class="flex flex-col sm:flex-row gap-4">
            <p>Hola: {{ \Illuminate\Support\Facades\Auth::user()->name }}</p>
            <livewire:auth.logout/>
        </div>
    @endif
</div>
