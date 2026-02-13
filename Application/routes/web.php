<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\AdminController as ControllersAdminController;
use App\Http\Controllers\PenjualController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebAuthnController;

use App\Http\Controllers\MasterSelect;
use App\Models\User;

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
    Route::get('/webauthn/login/options', [WebAuthnController::class, 'loginOptions'])->name('webauthn_login_options');
    Route::post('/webauthn/login', [WebAuthnController::class, 'loginProcess'])->name('webauthn_login');
});

// =======ADMIN========
Route::prefix('admin')->middleware('auth.session', 'role:1')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin_dashboard');
    Route::get('/profile', [ControllersAdminController::class, 'profile'])->name('admin_profile');
    Route::post('/profile', [ControllersAdminController::class, 'profileProcess'])->name('admin_profileprocess');
    Route::get('/menu', [ControllersAdminController::class, 'menu'])->name('admin_master_menu');
    Route::get('/user', [ControllersAdminController::class, 'user'])->name('admin_master_user');
    Route::get('/datatable/{type}', [ControllersAdminController::class, 'datatable'])->name('admin_datatable');
    Route::get('/form/{type}', [ControllersAdminController::class, 'addForm'])->name('admin_form_add');
    Route::post('/form/{type}', [ControllersAdminController::class, 'addProcess'])->name('admin_formaddprocess');
    Route::get('/form/{type}/{id}', [ControllersAdminController::class, 'editForm'])->name('admin_form_edit');
    Route::post('/form/{type}/{id}', [ControllersAdminController::class, 'editProcess'])->name('admin_editformprocess');
    Route::post('/delete/{type}/{id}', [ControllersAdminController::class, 'delete'])->name('admin_delete');
    Route::get('/detail/{type}/{id}', [ControllersAdminController::class, 'detail'])->name('admin_form_view');
    Route::post('/changerole', [ControllersAdminController::class, 'changeRole'])->name('admin_changerole');
    Route::get('/taxinvoice', [ControllersAdminController::class, 'taxinvoicedetail'])->name('admin_taxinvoicedetail');
});

// ======PENJUAL=======
Route::prefix('penjual')->middleware('auth.session', 'role:2')->group(function () {
    Route::get('/', [PenjualController::class, 'index'])->name('penjual_dashboard');
    Route::get('/profile', [PenjualController::class, 'profile'])->name('penjual_profile');
    Route::post('/profile', [PenjualController::class, 'profileProcess'])->name('penjual_profileprocess');
    Route::get('/produk', [PenjualController::class, 'produk'])->name('penjual_produk');
    Route::get('/datatable', [PenjualController::class, 'datatable'])->name('penjual_datatable');
    Route::get('/form', [PenjualController::class, 'addForm'])->name('penjual_add_form');
    Route::post('/form', [PenjualController::class, 'addProcess'])->name('penjual_formaddprocess');
    Route::get('/form/{id}', [PenjualController::class, 'editForm'])->name('penjual_edit_form');
    Route::post('/form/{id}', [PenjualController::class, 'editProcess'])->name('penjual_formeditprocess');
    Route::get('/detail/{id}', [PenjualController::class, 'detail'])->name('penjual_form_view');
    Route::post('/delete/{id}', [PenjualController::class, 'delete'])->name('penjual_delete_produk');
    Route::get('/transaction', [PenjualController::class, 'transaction'])->name('penjual_transaction');
});

// ========USER========
Route::prefix('user')->middleware('auth.session', 'role:3')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('user_dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('user_profile');
    Route::post('/profile', [UserController::class, 'profileProcess'])->name('user_profileprocess');
    Route::get('/shop', [UserController::class, 'shop'])->name('user_belanja');
    Route::get('/keranjang', [UserController::class, 'keranjang'])->name('user_keranjang');
    Route::post('/topup', [UserController::class, 'topup'])->name('user_topup');
    Route::post('/topup/complete', [UserController::class, 'topupComplete'])->name('user_topup_complete');
    Route::post('/withdraw', [UserController::class, 'withdraw'])->name('user_withdraw');
    Route::post('/shop/addcart', [UserController::class, 'addToCart'])->name('user_add_cart');
    Route::post('/shop/updatecart', [UserController::class, 'updateToCart'])->name('user_update_cart');
    Route::get('/history', [UserController::class, 'history'])->name('user_history');
});

Route::middleware('auth.session')->group(function () {
    
    Route::get('/webauthn/register/options', [WebAuthnController::class, 'registerOptions'])->name('webauthn_register_options');
    Route::post('/webauthn/register', [WebAuthnController::class, 'registerProcess'])->name('webauthn_register');
    Route::delete('/webauthn/{id}', [WebAuthnController::class, 'destroy'])->name('webauthn_destroy');

    // ===MASTER SELECT====
    Route::prefix('select')->group(function () {
        Route::get('/roles', [MasterSelect::class, 'getRoles'])->name('select_roles');
        Route::get('/submenus', [MasterSelect::class, 'getSubmenus'])->name('select_submenus');
    });

    // ===LOGOUT===
    Route::prefix('logout')->group(function () {
        Route::get('/', [AuthController::class, 'logout'])->name('logout');
    });
});
