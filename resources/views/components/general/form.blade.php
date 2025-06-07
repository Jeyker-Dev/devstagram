@props(['submit' => ''])

<form wire:submit.prevent="{{ $submit }}" {{ $attributes->merge(['class' => 'bg-white p-6 shadow my-10 rounded']) }}>
    {{ $slot }}
</form>
