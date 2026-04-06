<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\TokenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/reset', [AuthController::class, 'reset']);
    Route::prefix('token')->group(function () {
        Route::get('/validar', [TokenController::class, 'valid']);
    });
});

