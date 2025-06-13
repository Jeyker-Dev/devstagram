<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public ?int $postsCount = null;

    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->postsCount = Auth::user()->posts()->count();
    }

    public function with(): array
    {
        return [
            'posts' => Auth::user()->posts()->paginate(6),
        ];
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
                   <span class="font-bold">{{ $postsCount }}</span>
                   Post
               </x-general.text>
           </div>
       </div>
    </div>

    <div>
        <x-general.title>
            Publicaciones
        </x-general.title>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 w-11/12 lg:w-10/12 xl:w-9/12 mx-auto my-10">
            @foreach($posts as $post)
                <div class="h-72 md:h-96">
                    <img src="{{ $post->post_image_url }}" alt="" class="w-full h-full object-cover">
                </div>
            @endforeach
        </div>
    </div>
</div>
