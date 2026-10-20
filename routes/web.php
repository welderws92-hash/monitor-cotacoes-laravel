<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AssetController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Rotas para visitantes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');

    Route::get('/cadastro', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/cadastro', [AuthController::class, 'register'])
        ->name('register.store');
});

// Rotas para usuários autenticados
Route::middleware('auth')->group(function () {
    Route::get('/cotacoes', [AssetController::class, 'index'])
        ->name('assets.index');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});
