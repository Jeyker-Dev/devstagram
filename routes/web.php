<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Models\User;
use App\Models\Post;

Route::get('/', function () {
    return redirect()->route('login');
});

Volt::route('/profile/{user:username}', 'profile.my-profile')
    ->middleware(['auth', 'verified'])
    ->name('my-profile');

Route::view('{user:username}/create-post', 'profile/create-post')
    ->middleware(['auth', 'verified'])
    ->name('create-post');

Route::get('{user:name}/{post:title}', function (User $user, Post $post) {
    return view('profile.show-post', compact('user', 'post'));
})
    ->middleware(['auth', 'verified'])
    ->name('show-post');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
