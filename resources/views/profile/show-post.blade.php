<x-layouts.auth>
    <x-general.title>
        {{ $post->title }}
    </x-general.title>

    <div class="h-screen grid grid-cols-1 sm:grid-cols-2 w-11/12 lg:w-9/12 xl:w-7/12 mx-auto my-10 gap-6">
        <div class="flex flex-col gap-4">
            <img src="{{ $post->post_image_url }}" alt="" class="h-md">

            <livewire:profile.posts.likes :post="$post"/>

            <p class="flex flex-col gap-2">
                {{ $user->name }}
                <span>
                    {{ $post->created_at->diffForHumans() }}
                </span>
            </p>
        </div>

        <div class="bg-white shadow-md rounded p-6 flex flex-col max-h-96">
            <h2 class="text-black md:text-lg mb-2">
                Comentarios de la publicacion
            </h2>

            <livewire:profile.posts.add-comments :post="$post"/>

            <livewire:profile.posts.show-comments/>
        </div>
    </div>
</x-layouts.auth>
