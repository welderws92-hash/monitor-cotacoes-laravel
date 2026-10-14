<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Autenticação: visitantes
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

// Sair da conta: usuários autenticados
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');