<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $username = '';
    public ?int $postsCount = null;

    public function mount(): void
    {
        $this->username = Auth::user()->username;
        $this->postsCount = Auth::user()->posts()->count();
    }

    public function with(): array
    {
        return [
            'posts' => Auth::user()->posts()->paginate(6),
        ];
    }

    public function updatedUsername(): void
    {
        $this->validate(['username' => 'required']);
        $user = Auth::user();
        $user->username = $this->username;
        $user->save();
    }
}; ?>

<div x-data="{ editing: false }" class="mt-6">
    <x-general.title>
        Tu Cuenta
    </x-general.title>

    <div class="flex flex-col gap-4 sm:flex-row justify-center items-center sm:items-start mt-10">
        <img src="{{ asset('img/usuario.svg') }}" alt="" class="w-11/12 max-w-sm">

       <div>
           <p class="text-lg md:text-xl flex gap-4 items-center">
               <template x-if="editing">
                   <flux:input
                          wire:model.change="username"
                          @click.outside="editing = false"
                          class="input-username"
                          autofocus

                   />
               </template>
               <template x-if="!editing">
                   <span class="flex gap-2 items-center">
                       <span x-text="$wire.username"></span>
                       <flux:icon.pencil @click="editing = true" class="cursor-pointer"/>
                   </span>
               </template>
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
                <a href="{{ route('show-post', [Auth::user(), $post->title]) }}">
                    <div class="h-72 md:h-96">
                        <img src="{{ $post->post_image_url }}" alt="" class="w-full h-full object-cover">
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
