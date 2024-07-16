<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'card']);

Route::get('login', [AuthController::class, 'loginForm'])->name('login');
Route::get('register', [AuthController::class, 'registerForm'])->name('register');

Route::post('login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
