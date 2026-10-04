<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/', [UserController::class, 'cadastro'])
    ->name('cadastro');

Route::post('/users', [UserController::class, 'cadastroSubmit'])
    ->name('cadastroSubmit');

Route::get('/users/{user}', [UserController::class, 'perfil'])
    ->name('perfil');