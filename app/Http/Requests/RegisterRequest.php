<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

// Este request se encarga de validar los datos de registro del usuario.
class RegisterRequest extends FormRequest {

    // Indica si el usuario está autorizado a realizar esta solicitud.
    public function authorize(): bool {
        return true;
    }

    // Define las reglas de validación para los datos de inicio de sesión.
    public function rules(): array {
        return [
            'name'     => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50', 'unique:users,username'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    // Define los mensajes de error personalizados para las reglas de validación.
    public function messages(): array {
        return [
            'name.required'      => 'El nombre es obligatorio.',
            'name.string'        => 'El nombre debe ser una cadena de texto.',
            'name.max'           => 'El nombre no puede exceder los 255 caracteres.',

            'username.required'  => 'El nombre de usuario es obligatorio.',
            'username.string'    => 'El nombre de usuario debe ser una cadena de texto.',
            'username.max'       => 'El nombre de usuario no puede exceder los 50 caracteres.',
            'username.unique'    => 'El nombre de usuario ya está en uso.',

            'email.required'     => 'El correo electrónico es obligatorio.',
            'email.email'        => 'Debe ser una dirección de correo válida.',
            'email.max'          => 'El correo no puede exceder los 255 caracteres.',
            'email.unique'       => 'Este correo ya está registrado.',

            'password.required'  => 'La contraseña es obligatoria.',
            'password.string'    => 'La contraseña debe ser una cadena de texto.',
            'password.min'       => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
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
