<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

// Form Mahasiswa (publik)
Route::get('/', [ReportController::class, 'index'])->name('home');
Route::post('/lapor', [ReportController::class, 'store'])->name('lapor.store');

// Login Admin
Route::get('/admin/login', [ReportController::class, 'showLogin'])->name('login');
Route::post('/admin/login', [ReportController::class, 'processLogin']);
Route::post('/admin/logout', [ReportController::class, 'logout'])->name('logout');

// Dashboard Admin (setelah login)
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [ReportController::class, 'dashboard'])->name('admin.dashboard');
    Route::put('/laporan/{id}', [ReportController::class, 'updateStatus'])->name('laporan.update');
    Route::delete('/laporan/{id}', [ReportController::class, 'destroy'])->name('laporan.destroy');
});