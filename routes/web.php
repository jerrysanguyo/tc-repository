<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    Auth\LoginController,
    Auth\RegisterController,
    Auth\VerifyController,
    CMS\DepartmentController,
    CMS\TagController,
    HomeController,
    AccountController,
    FolderController,
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
    // resources
    Route::resource('Tag', TagController::class);
    Route::resource('Department', DepartmentController::class);
    Route::resource('folder', FolderController::class);
    Route::resource('account', AccountController::class);
    Route::post('/account/{userId}', [AccountController::class, 'accountValidate'])->name('account.validate');
    Route::delete('account/{userId}/unvalidate', [AccountController::class, 'accountUnvalidate'])->name('account.unvalidate');
});

//routes for user
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::resource('account', AccountController::class);
});