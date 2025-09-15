<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoanApplicationConttroller;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/loan/form', [LoanApplicationConttroller::class, 'index'])->name('loan.form');
    Route::post('/loan/form', [LoanApplicationConttroller::class, 'getOffers'])->name('offers.get');
    Route::post('/loan/apply', [LoanApplicationConttroller::class, 'apply'])->name('offers.apply');
    Route::get('/loan', [LoanApplicationConttroller::class, 'show'])->name('loan.show');
});
