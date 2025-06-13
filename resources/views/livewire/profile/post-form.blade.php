<?php

use Livewire\Volt\Component;
use App\Livewire\Forms\PostForm;
use Livewire\WithFileUploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

new class extends Component {
    public PostForm $form;
    public ?TemporaryUploadedFile $image = null;

    use WithFileUploads;

    public function mount()
    {
        $this->form->image = $this->image;
    }

    public function save(): void
    {
        $this->form->store();
    }
}; ?>

<div class="grid grid-cols-1 sm:grid-cols-2 p-6">
    <x-general.drag-and-drop wire:model="form.image"/>

    <x-general.form wire:submit.prevent="save" class="flex flex-col gap-6">
        <flux:input wire:model="form.title" label="Titulo" placeholder="Vacaciones en Miami" />

        <flux:textarea wire:model="form.description" label="Descripcion" placeholder="Me he ido de vaciones a una playa en miami, tomando el sol y bebiendo unos cocteles." />

        <flux:button type="submit" class="!bg-sky-600 hover:!bg-sky-500 !text-white">
            Crear Publicacion
        </flux:button>
    </x-general.form>
</div>
