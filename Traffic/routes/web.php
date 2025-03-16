<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
});

// Middleware de autenticación
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();

        // Verificar si el usuario tiene un rol
        if (!$user->role) {
            return redirect()->route('home')->with('error', 'No tienes un rol asignado.');
        }

        // Redirigir al usuario según su rol
        return redirect(match ($user->role->nombre) {
            'Administrador' => route('admin.dashboard'),
            'Supervisor' => route('supervisor.dashboard'),
            'Monitoreador' => route('monitoreador.dashboard'),
            default => route('home'), // Redirige a la página de inicio
        });
    })->name('dashboard');

    // Rutas específicas para cada rol
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/supervisor/dashboard', function () {
        return view('supervisor.dashboard');
    })->name('supervisor.dashboard');

    Route::get('/monitoreador/dashboard', function () {
        return view('monitoreador.dashboard');
    })->name('monitoreador.dashboard');
});