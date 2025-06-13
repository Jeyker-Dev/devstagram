@props(['submit' => ''])

<form {{ $attributes->merge(['class' => 'bg-white p-6 shadow rounded']) }}>
    {{ $slot }}
</form>
