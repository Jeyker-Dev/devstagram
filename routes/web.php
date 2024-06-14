<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () 
{
    return view('index');
});


// Routes of RegisterController
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// Routes of LoginController
Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/login', [LoginController::class,'store']);

// Routes of LogoutController
Route::post('/logout', [LogoutController::class,'store'])->name('logout');

Route::get('/{user:username}', [PostController::class, 'index'])->middleware(['auth'])->name('posts.index');