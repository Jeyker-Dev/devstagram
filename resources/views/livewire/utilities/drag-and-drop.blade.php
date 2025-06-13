<?php

use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

new class extends Component {
    use WithFileUploads;

    public ?TemporaryUploadedFile $image = null;
}; ?>

<div>

</div>
