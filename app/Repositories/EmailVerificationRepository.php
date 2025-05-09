<?php
namespace App\Repositories;

use App\Models\EmailVerificationToken;
use Carbon\Carbon;
use Illuminate\Support\Str;

// Este repositorio maneja la lógica de negocio relacionada con los tokens de verificación de correo electrónico
class EmailVerificationRepository {
    protected $tokenTTL = 60; // en minutos

    // funcion para crear un token de verificación de correo electrónico
    public function createForUser(int $userId): EmailVerificationToken {
        // Genera token aleatorio y fecha de expiración
        $token = Str::random(64);
        $expiresAt = Carbon::now()->addMinutes($this->tokenTTL);

        return EmailVerificationToken::create([
            'user_id'    => $userId,
            'token'      => $token,
            'expires_at' => $expiresAt,
        ]);
    }

    // funcion para verificar si el token es valido
    public function findByToken(string $token): ?EmailVerificationToken {
        return EmailVerificationToken::where('token',$token)->first();
    }

    // funcion para borrar un token de verificación de correo electrónico
    public function delete(EmailVerificationToken $evt): void {
        $evt->delete();
    }
}
