<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendudukController;
Route::resource('penduduk', controller: PendudukController::class);
use App\Http\Controllers\UsahaDesaController;
Route::resource('usaha_desa', UsahaDesaController::class);
Route::get('usaha_desa/{id}', [UsahaDesaController::class, 'show'])->name('usaha_desa.show');
use App\Http\Controllers\DashboardController;
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
