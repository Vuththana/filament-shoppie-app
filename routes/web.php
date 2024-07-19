<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\DiscordNotificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'card']);

Route::get('/test', function() {
    return view('filament.pages.test');
});

Route::get('login', [AuthController::class, 'loginForm'])->name('login');
Route::get('register', [AuthController::class, 'registerForm'])->name('register');

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth', 'role:Customer']], function () { 
    Route::get('/checkout/{id}', [StripeController::class, 'checkout'])->name('checkout');
    Route::post('/session/{id}', [StripeController::class, 'session'])->name('checkout.session');
    Route::get('/success', [StripeController::class, 'success'])->name('success');
});

Route::get('notification', [DiscordNotificationController::class, 'sendNotification']);
Route::get('success/{id}', [StripeController::class, 'success'])->name('success');
