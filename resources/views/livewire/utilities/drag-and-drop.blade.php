<?php

use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

new class extends Component {
    use WithFileUploads;

    #[Validate('image')]
    public TemporaryUploadedFile $image;

    public function updatedImage(): void
    {
        $this->validate();

        $this->dispatch('image-uploaded', image: $this->image);
    }
}; ?>

<div>
    <ul
        x-data="{
            dragging: false,
            imageUrl: null,
            handleDrop(e) {
                this.dragging = false;
                const files = e.dataTransfer.files;
                if (files.length) {
                    this.setPreview(files[0]);
                    $wire.upload('image', files[0]);
                }
            },
            triggerFileInput() {
                this.$refs.fileInput.click();
            },
            handleFileChange(e) {
                const files = e.target.files;
                if (files.length) {
                    this.setPreview(files[0]);
                    $wire.upload('image', files[0]);
                }
            },
            setPreview(file) {
                if (file && file.type.startsWith('image/')) {
                    this.imageUrl = URL.createObjectURL(file);
                }
            }
        }"
        @dragover.prevent="dragging = true"
        @dragleave.prevent="dragging = false"
        @drop.prevent="handleDrop($event)"
        @click="triggerFileInput"
        :class="{ 'bg-gray-100 border border-dashed border-blue-500': dragging }"
        class="rounded cursor-pointer bg-white h-full"
    >
        <input
            x-ref="fileInput"
            type="file"
            accept="image/*"
            class="hidden"
            @change="handleFileChange"
        >

        <template x-if="imageUrl">
            <li class="flex flex-col items-center justify-center h-full">
                <img :src="imageUrl" alt="Preview" class="max-h-48 mb-2 rounded shadow"/>
            </li>
        </template>

        <li class="h-full flex items-center justify-center">
            <p class="text-center text-gray-500 md:text-lg">
                Drag & drop an image here or click to select
            </p>
        </li>
    </ul>
</div>
