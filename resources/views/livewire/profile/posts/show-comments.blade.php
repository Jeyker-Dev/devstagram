<?php

use Livewire\Volt\Component;
use App\Models\Post;

new class extends Component {
    public Post $post;

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function with(): array
    {
        return [
            'comments' => $this->post->comments()->with('user')->get(),
        ];
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
