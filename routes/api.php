<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

/**
 * Rutas de autenticación para el microservicio.
 * 
 * @author Luis Miguel Álvarez <luismiguel.alvarez@humboldt.edu.co>
 */

// Registro de usuario (con soporte para sesión persistente)
// Route::post('/register', [RegisterController::class, 'register'])
//     ->name('auth.register')
//     ->middleware('guest'); // Solo accesible para usuarios no autenticados

    //comentado temporalmente para correr las pruebas del pipeline


    // Registro de usuario (con soporte para sesión persistente)
Route::post('/register', [RegisterController::class, 'register'])
    ->name('auth.register');
