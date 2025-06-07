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

       <div>
           <p class="text-lg md:text-xl">
               {{ $name }}
           </p>

           <div class="flex flex-col gap-2 mt-4">
               <x-general.text class="!text-base">
                   <span class="font-bold">0</span>
                   Seguidores
               </x-general.text>

               <x-general.text class="!text-base">
                   <span class="font-bold">0</span>
                   Siguiendo
               </x-general.text>

               <x-general.text class="!text-base">
                   <span class="font-bold">0</span>
                   Post
               </x-general.text>
           </div>
       </div>
    </div>
</div>
