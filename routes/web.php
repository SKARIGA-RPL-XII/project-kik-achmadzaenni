<?php

use App\Http\Controllers\Admincontroller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/register', function () {
    // Registration logic here
});
Route::post('/login', function () {
    // Registration logic here
});


Route::prefix('admin')->group(function () {
    Route::get('/', [Admincontroller::class, 'index'])->name('index');
});