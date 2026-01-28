<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\AdminController as ControllersAdminController;
use App\Http\Controllers\PenjualController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect()->route('loginForm');
});

//=====AUTHENTIKASI=====
Route::prefix('auth')->middleware('guest.only')->group(function () {
    Route::get('/register', [Authcontroller::class, 'registerForm'])->name('registerForm');
    Route::post('/register', [Authcontroller::class, 'registerProcess'])->name('registerProcess');

    Route::get('/otp', [Authcontroller::class, 'otpForm'])->name('otpForm');
    Route::post('/otp', [Authcontroller::class, 'otpProcess'])->name('otpProcess');
    Route::post('/otp-resend', [Authcontroller::class, 'otpResend'])->name('otpResend');

    Route::get('/login', [Authcontroller::class, 'loginForm'])->name('loginForm');
    Route::post('/login', [Authcontroller::class, 'loginProcess'])->name('loginProcess');
});

// =======ADMIN========
Route::prefix('admin')->middleware('auth.session', 'role:1')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin_dashboard');
    Route::get('/profile', [ControllersAdminController::class, 'profile'])->name('admin_profile');
    Route::get('/menu', [ControllersAdminController::class, 'menu'])->name('admin_master_menu');
    Route::get('/user', [ControllersAdminController::class, 'user'])->name('admin_master_user');
});

// ======PENJUAL=======
Route::prefix('penjual')->middleware('auth.session', 'role:2')->group(function () {
    Route::get('/', [PenjualController::class, 'index'])->name('penjual_dashboard');
    Route::get('/profile', [PenjualController::class, 'profile'])->name('penjual_profile');
});

// ========USER========
Route::prefix('user')->middleware('auth.session', 'role:3')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('user_dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('user_profile');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
