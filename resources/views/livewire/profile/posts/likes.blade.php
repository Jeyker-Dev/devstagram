<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Like;

new class extends Component {
    public ?bool $likes = null;
    public ?Post $post = null;
    public ?Like $like = null;
    public ?bool $isLikedByUser = null;

    public function mount()
    {
        $this->isLikedByUser();
    }

    public function incrementLikes(): void
    {
        if (!$this->isLikedByUser) $this->likes = true;
        $this->updateLikes();
        $this->isLikedByUser();
    }

    public function decrementLikes(): void
    {
        if ($this->isLikedByUser) $this->likes = false;
        $this->updateLikes();
        $this->isLikedByUser();
    }

    public function updateLikes(): void
    {
        if ($this->likes) {
            $this->like = Like::updateOrCreate([
                'user_id' => Auth::user()->id,
                'post_id' => $this->post->id,
            ]);
        } else {
            $this->like = Like::where('user_id', Auth::user()->id)
                ->where('post_id', $this->post->id)
                ->first();

            $this->like->delete();
        }
    }

    public function isLikedByUser()
    {
        $this->isLikedByUser = Like::where('user_id', Auth::user()->id)
            ->where('post_id', $this->post->id)
            ->exists();
    }
}; ?>

<div class="flex items-center gap-4">
    @if ($isLikedByUser)
        <flux:icon.heart variant="solid" class="cursor-pointer text-red-500" wire:click="decrementLikes"/>
    @else
        <flux:icon.heart class="cursor-pointer" wire:click="incrementLikes"/>
    @endif
    <p class="font-bold flex gap-2">
        {{ $post->likes->count() }}
        <span class="font-normal">Likes</span>
    </p>
</div>
