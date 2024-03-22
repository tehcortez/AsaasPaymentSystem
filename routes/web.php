<?php

use App\Http\Controllers\CobrancaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('users', UserController::class);
Route::get('/users/{user}/cobrancas/error', CobrancaController::class.'@error')->name('cobrancas.error');
Route::get('/users/{user}/cobrancas', [CobrancaController::class, 'index'])->name('cobrancas.index');
Route::get('/users/{user}/cobrancas/create', [CobrancaController::class, 'create'])->name('cobrancas.create');
Route::post('/users/{user}/cobrancas', [CobrancaController::class, 'store'])->name('cobrancas.store');
Route::get('/users/{user}/cobrancas/{cobranca}', [CobrancaController::class, 'show'])->name('cobrancas.show');
