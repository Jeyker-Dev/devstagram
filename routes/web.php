<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerlfilController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\RegisterController;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\ComentarioController;
use Illuminate\Foundation\Configuration\Middleware;

// Route of HomeController
Route::get('/', HomeController::class)->middleware('auth')->name('home');


// Routes of RegisterController
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register/users', [RegisterController::class, 'store'])->name('register.store');

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

// Routes of LikeController
Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');

// Middleware Auth Perfil
Route::group(['middleware' => 'auth'], function()
{
// Routes of PerfilController
Route::get('{user:username}/editar-perfil', [PerlfilController::class, 'index'])->name('perfil.index');
Route::post('{user:username}/editar-perfil', [PerlfilController::class, 'store'])->name('perfil.store');
});

// Routes of FollowerController
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');