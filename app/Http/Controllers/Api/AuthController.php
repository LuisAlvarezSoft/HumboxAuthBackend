<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

// Este controlador maneja la autenticación de usuarios, incluyendo registro, inicio de sesión, cierre de sesión y restablecimiento de contraseña.
class AuthController extends Controller {
    // Inyecta el servicio de autenticación
    public function __construct(protected AuthService $authService) {

    }

    // Registra usuarios
    public function register(RegisterRequest $request): JsonResponse {
        $token = $this->authService->register($request->validated());
        return response()->json([
            'access_token' => $token->plainTextToken,
            'token_type'   => 'Bearer',
        ], 201);
    }

    // Inicia sesión de usuario
    public function login(LoginRequest $request): JsonResponse {
        $data = $request->validated();
        $result = $this->authService->login(
            $data['login'], 
            $data['password'], 
            $data['remember'] ?? false
        );
        // Retorna error si la cuenta está bloqueada
        if ($result === 'blocked') {
            return response()->json(['message' => 'Tu cuenta está inactiva o bloqueada.'], 403);
        }
        // Retorna error si las credenciales son inválidas
        if (!$result) {
            return response()->json(['message' => 'Credenciales inválidas.'], 401);
        }
        // Retorna token y datos del usuario
        return response()->json([
            'access_token' => $result->plainTextToken,
            'token_type'   => 'Bearer',
            'expires_at'   => $result->accessToken->expires_at,
            'user'         => Auth::user(),
        ], 200);
    }

    // Cierra la sesión actual
    public function logout(Request $request): JsonResponse {
        $this->authService->logout();
        return response()->json(['message' => 'Sesión cerrada correctamente.'], 200);
    }

    // Cierra todas las sesiones
    public function logoutAll(): JsonResponse {
        $this->authService->logoutAllSessions();
        return response()->json(['message' => 'Todas las sesiones han sido cerradas.'], 200);
    }

    // Confirma el correo electrónico
    public function confirmEmail(Request $request) {
        $verified = $this->authService->verifyEmail($request->input('token'));
        
        if ($verified) {
            return view('auth.email-verified');
        }
        
        return view('auth.email-verification-error');
    }

    // Envía OTP para restablecer contraseña
    public function sendResetOtp(Request $request): JsonResponse {
        $request->validate(['login' => 'required|string']);
        if ($this->authService->sendResetOtp($request->login)) {
            return response()->json(['message' => 'OTP enviado.'], 200);
        }
        return response()->json(['message' => 'Usuario no registrado.'], 404);
    }

    // Restablece la contraseña usando OTP
    public function resetPassword(ResetPasswordRequest $request): JsonResponse {
        $data = $request->validated();
        if ($this->authService->resetPasswordWithOtp(
            $data['login'],
            $data['otp'],
            $data['password']
        )) {
            return response()->json(['message' => 'Contraseña actualizada.'], 200);
        }
        return response()->json(['message' => 'OTP inválido o expirado.'], 422);
    }
}
