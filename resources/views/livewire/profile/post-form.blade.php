<?php

use Livewire\Volt\Component;

new class extends Component {


    public function save(): void
    {

    }
}; ?>

<div>
    <x-general.form submit="save" class="flex flex-col gap-6">
        <flux:input wire.model="title" label="Titulo" placeholder="Vacaciones en Miami" />

        <flux:textarea wire.model="description" label="Descripcion" placeholder="Me he ido de vaciones a una playa en miami, tomando el sol y bebiendo unos cocteles." />

        <flux:button class="!bg-sky-600 hover:!bg-sky-500 !text-white">
            Crear Publicacion
        </flux:button>
    </x-general.form>
</div>
