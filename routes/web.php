<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MobilsController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PesananController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginpost'])->name('login');
});
Route::get('/logout',[AuthController::class,'logout'])->name('logout');
Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::get('/home', function () {
        return view('layout/home');
    });
    Route::resource('mobil',MobilsController::class);
    Route::resource('pesanan',PesananController::class);
    Route::resource('pengembalian',PengembalianController::class);
});