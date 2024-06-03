<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/crear-cuenta', function () {
    return view('auth/register');
});
