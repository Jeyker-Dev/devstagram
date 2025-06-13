<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div class="bg-white shadow-md rounded p-6 flex flex-col gap-4 max-h-96">
    <h2 class="text-black md:text-lg">
        Comentarios de la publicacion
    </h2>

    <flux:textarea placeholder="Agrega un comentario"/>

    <flux:button class="!bg-sky-500 hover:!bg-sky-600 !text-white w-full">
        Comentar
    </flux:button>

    <div class="p-10 border border-gray-100 shadow-md">
        <p class="text-center">No hay comentarios aun</p>
    </div>
</div>
