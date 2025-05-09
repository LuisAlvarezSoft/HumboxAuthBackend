<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

// Este request se encarga de validar los datos de inicio de sesión del usuario.
class LoginRequest extends FormRequest {
    
    // Indica si el usuario está autorizado a realizar esta solicitud.
    public function authorize(): bool {
        return true;
    }

    // Define las reglas de validación para los datos de inicio de sesión.
    public function rules(): array {
        return [
            'login' => ['required', 'string'], // Puede ser email o username
            'password' => ['required', 'string'],
            'remember' => ['sometimes', 'boolean'],
        ];
    }

    // Define los mensajes de error personalizados para las reglas de validación.
    public function messages(): array {
        return [
            'login.required' => 'El correo electrónico o nombre de usuario es obligatorio.',
            'password.required' => 'La contraseña es obligatoria.',
        ];
    }

    // Maneja la respuesta de error en caso de que la validación falle.
    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Errores de validación',
                'errors' => $validator->errors()
            ], 422)
        );
    }
}
