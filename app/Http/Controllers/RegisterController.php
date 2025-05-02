<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * Controlador para el registro de usuarios.
 * 
 * @author Luis Miguel Álvarez <luismiguel.alvarez@humboldt.edu.co>
 */
class RegisterController extends Controller
{
    /**
     * Registra un nuevo usuario y genera un token de acceso.
     * 
     * @param Request $request Datos del formulario (name, email, password, remember).
     * @return \Illuminate\Http\JsonResponse Respuesta JSON con el usuario y token.
     */
    public function register(Request $request)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'remember' => 'nullable|boolean', // Campo opcional para sesión persistente
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Crear usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'remember_token' => $request->remember ? Str::random(60) : null, // Genera token si "remember" es true
        ]);

        // Generar token de acceso (para APIs)
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
            'remember_token' => $user->remember_token, // Solo para debug, no exponer en producción
            'message' => 'Usuario registrado exitosamente',
        ], 201);
    }
}
