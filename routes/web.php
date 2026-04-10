<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::prefix('auth')->group(function () {
    Route::get('/login', fn () => view('pages.auth.login'))->name('login');
    Route::get('/reset', fn () => view('pages.auth.reset'))->name('reset');
});


