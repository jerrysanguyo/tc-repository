<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    Auth\LoginController,
    Auth\RegisterController,
    Auth\VerifyController,
    HomeController,
};
//login
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.account');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
//registration
Route::get('/registration', [RegisterController::class, 'index'])->name('registration');
Route::post('/registration/store', [RegisterController::class, 'register'])->name('store.registration');
//verification and user details
Route::get('/verification/{userId}', [VerifyController::class, 'index'])->name('verification');
Route::post('/verification/otp/{userId}', [VerifyController::class, 'verify'])->name('otp.verify');
Route::post('/verification/detail/{userId}', [VerifyController::class, 'userDetail'])->name('store.detail');

//routes for super admin
Route::middleware(['auth', 'role:superadmin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
});
//routes for user
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
});