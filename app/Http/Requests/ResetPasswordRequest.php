<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

// Este request se encarga de validar los datos de registro del usuario.
class ResetPasswordRequest extends FormRequest {

    // Indica si el usuario está autorizado a realizar esta solicitud.
    public function authorize(): bool {
        return true;
    }

    // Define las reglas de validación para los datos de inicio de sesión.
    public function rules(): array {
        return [
            'login' => ['required', 'string'],
            'otp' => ['required', 'digits:6'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
        ];
    }

    // Define los mensajes de error personalizados para las reglas de validación.
    public function messages(): array {
        return [
            'login.required' => 'El correo o nombre de usuario es obligatorio.',
            'otp.required' => 'El código OTP es obligatorio.',
            'otp.digits' => 'El código OTP debe tener 6 dígitos.',
            'password.required' => 'La nueva contraseña es obligatoria.',
            'password.confirmed' => 'La confirmación de contraseña no coincide.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
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