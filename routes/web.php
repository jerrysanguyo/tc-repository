<?php

use Illuminate\Support\Facades\Route;
use App\{
    Http\Controllers\Auth\LoginController,
    Http\Controllers\Auth\RegisterController,
    Http\Controllers\Auth\VerifyController,
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