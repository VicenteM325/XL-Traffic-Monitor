<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function redirectToDashboard()
    {
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
    }
}