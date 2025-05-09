<?php
namespace App\Repositories;

use App\Models\PasswordOtp;
use Carbon\Carbon;
use Illuminate\Support\Str;

// Este repositorio maneja la lógica de negocio relacionada con los OTPs para recuperación de contraseña
class PasswordOtpRepository {
    // Tiempo de vida del OTP en minutos
    protected $otpTTL = 15;

    // funcion para crear un OTP para la recuperación de contraseña
    public function createForEmail(string $email): PasswordOtp {
        $otp = mt_rand(100000,999999); // 6 dígitos
        $expiresAt = Carbon::now()->addMinutes($this->otpTTL);

        return PasswordOtp::create([
            'email'      => $email,
            'otp'        => $otp,
            'expires_at' => $expiresAt,
        ]);
    }

    // funcion para verificar si el OTP es valido
    public function findValid(string $email, string $otp): ?PasswordOtp {
        return PasswordOtp::where('email',$email)
            ->where('otp',$otp)
            ->where('expires_at','>', Carbon::now())
            ->first();
    }

    // funcion para borrar un OTP
    public function delete(PasswordOtp $po): void {
        $po->delete();
    }
}
