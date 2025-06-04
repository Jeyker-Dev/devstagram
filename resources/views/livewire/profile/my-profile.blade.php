<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';

    public function mount(): void
    {
        $this->name = Auth::user()->name;
    }
}; ?>

<div class="mt-6">
    <x-general.title>
        Tu Cuenta
    </x-general.title>

    <div class="flex flex-col gap-4 sm:flex-row justify-center items-center sm:items-start mt-10">
        <img src="{{ asset('img/usuario.svg') }}" alt="" class="w-11/12 max-w-sm">

        <p class="text-center text-lg md:text-xl">
            {{ $name }}
        </p>
    </div>
</div>
