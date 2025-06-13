<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;
use Livewire\Features\SupportRedirects\Redirector;

class PostForm extends Form
{
    #[Validate('required|string')]
    public string $title = '';
    #[Validate('required|string')]
    public string $description = '';
    #[Validate('required|image')]
    public ?TemporaryUploadedFile $image = null;
    public string $disk = '';

    public function boot(): void
    {
        $this->disk = config('filesystems.default');
    }


    public function store(): Redirector
    {
        $this->validate();

        $imagePath = Storage::disk($this->disk)->put('post', $this->image);

        Post::create([
            'title' => $this->title,
            'description' => $this->description,
            'image' => $imagePath,
            'user_id' => Auth::user()->id,
        ]);

        $this->reset();

        return redirect()->route('my-profile', Auth::user()->name);
    }
}
