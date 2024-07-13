<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\ComentarioController;
use Illuminate\Foundation\Configuration\Middleware;

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

// Routes of PostController
Route::get('/{user:username}', [PostController::class, 'index'])->withoutMiddleware('auth')->name('posts.index');
Route::group(['middleware' => 'auth'], function()
{
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
});
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->withoutMiddleware(['auth'])->name('posts.show');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');


// Routes of ImagenController
Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');

// Routes of ComentarioController
Route::post('/{user:username}/posts/{post}', [ComentarioController::class,'store'])->name('comentarios.store');