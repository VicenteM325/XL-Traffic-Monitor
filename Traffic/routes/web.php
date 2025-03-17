<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\MonitoreadorController;

Route::get('/', function () {
    return view('auth.login');
});

// Middleware de autenticación
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Redirigir al dashboard según el rol
    Route::get('/dashboard', [DashboardController::class, 'redirectToDashboard'])->name('dashboard');

    // Rutas específicas para cada rol
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/supervisor/dashboard', [SupervisorController::class, 'dashboard'])->name('supervisor.dashboard');
    Route::get('/monitoreador/dashboard', [MonitoreadorController::class, 'dashboard'])->name('monitoreador.dashboard');

    Route::get('/monitoreador/calles', [MonitoreadorController::class, 'calles'])->name('monitoreador.calles');
    Route::get('/monitoreador/flujo-vehicular', [MonitoreadorController::class, 'flujoVehicular'])->name('monitoreador.flujo-vehicular');
});