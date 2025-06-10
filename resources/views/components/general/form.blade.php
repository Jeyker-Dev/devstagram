@props(['submit' => ''])

<form wire:submit.prevent="{{ $submit }}" {{ $attributes->merge(['class' => 'bg-white p-6 shadow rounded']) }}>
    {{ $slot }}
</form>
