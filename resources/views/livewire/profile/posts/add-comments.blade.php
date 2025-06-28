<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    #[Validate('required|string')]
    public string $comment = '';
    public Post $post;
    public bool $commentAdded = false;

    public function mount(Post $post)
    {
        $this->post = $post;

    }

    public function addComment()
    {
        $this->validate();

        Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $this->post->id,
            'comment' => $this->comment,
        ]);

        $this->reset('comment');
        $this->commentAdded = true;
        $this->dispatch('hide-message');
    }
}; ?>

<div x-data="{ message: @entangle('commentAdded')}"
     @hide-message="setTimeout(() => message = false, 4000)"
>
    <template x-if="message">
            <p class="p-2 text-green-700 bg-green-300 text-center mb-4">
                Comentario agregado correctamente.
            </p>
    </template>
    <flux:textarea wire:model="comment" placeholder="Agrega un comentario"/>
    <flux:error name="comment" />

    <flux:button wire:click="addComment" class="!bg-sky-500 hover:!bg-sky-600 !text-white w-full !my-4">
        Comentar
    </flux:button>
</div>
