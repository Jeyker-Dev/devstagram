<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $username = '';
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'username' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirectIntended(route('my-profile', ['user' => Auth::user()], absolute: false), navigate: true);
    }
}; ?>

<div>
    <x-general.title>
        Crear Cuenta en Devstagram
    </x-general.title>

    <div class="flex flex-col md:flex-row w-11/12 lg:w-9/12 xl:w-8/12 mx-auto gap-6 lg:gap-20 my-10">
        <img src="{{ asset('img/registrar.jpg') }}" alt="" class="object-center object-cover w-1/2 max-w-2xl">

        <div class="flex flex-col justify-center gap-6 bg-white shadow-lg w-full p-6">
            <x-auth-header :title="__('Crear una cuenta')" :description="__('Coloca tus datos para crear una cuenta')" />

            <!-- Session Status -->
            <x-auth-session-status class="text-center" :status="session('status')" />

            <form wire:submit="register" class="flex flex-col gap-6">
                <flux:input
                    wire:model="username"
                    :label="__('Nombre de Usuario')"
                    type="text"
                    required
                    autofocus
                    autocomplete="username"
                    :placeholder="__('Usuario123')"
                />

                <!-- Name -->
                <flux:input
                    wire:model="name"
                    :label="__('Nombre')"
                    type="text"
                    required
                    autofocus
                    autocomplete="name"
                    :placeholder="__('Full name')"
                />

                <!-- Email Address -->
                <flux:input
                    wire:model="email"
                    :label="__('Email')"
                    type="email"
                    required
                    autocomplete="email"
                    placeholder="email@example.com"
                />

                <!-- Password -->
                <flux:input
                    wire:model="password"
                    :label="__('Contraseña')"
                    type="password"
                    required
                    autocomplete="new-password"
                    :placeholder="__('Password')"
                    viewable
                />

                <!-- Confirm Password -->
                <flux:input
                    wire:model="password_confirmation"
                    :label="__('Confirmar contraseña')"
                    type="password"
                    required
                    autocomplete="new-password"
                    :placeholder="__('Confirm password')"
                    viewable
                />

                <div class="flex items-center justify-end">
                    <flux:button type="submit" variant="primary" class="w-full !bg-sky-600 hover:!bg-sky-500">
                        {{ __('Crear Cuenta') }}
                    </flux:button>
                </div>
            </form>

            <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
                {{ __('Already have an account?') }}
                <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
            </div>
        </div>
    </div>
</div>
