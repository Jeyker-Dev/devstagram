<?php

use Livewire\Volt\Component;
use App\Models\Post;
use Livewire\Attributes\On;

new class extends Component {
    public Post $post;

    public function mount(Post $post): void
    {
        $this->post = $post;
    }

    public function with(): array
    {
        return [
            'comments' => $this->post->comments()->with('user')->get(),
        ];
    }

    #[On('comment-added')]
    public function refreshComments(): void
    {
        $this->with();
    }
}; ?>

<div class="p-10 border border-gray-100 shadow-md">
    @foreach($comments as $comment)
        <div class="mb-4">
            <p class="font-semibold">{{ $comment->user->name ?? 'Usuario' }}</p>
            <p>{{ $comment->comment }}</p>
            <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
        </div>
    @endforeach

    @if($comments->isEmpty())
        <p class="text-center md:text-lg">
            No hay comentarios aún
        </p>
    @endif
</div>
