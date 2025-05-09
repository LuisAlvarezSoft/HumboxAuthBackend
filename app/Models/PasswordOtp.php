<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

// Este modelo PasswordOtp representa un OTP para la recuperación de contraseña
class PasswordOtp extends Model {
    // Campos asignables
    protected $fillable = ['email','otp','expires_at'];

    // Casteos
    protected $casts = [
        'expires_at' => 'datetime',
    ];

    // Funcion para comprobar si esta expirado el OTP
    public function isExpired(): bool {
        return $this->expires_at->lt(Carbon::now());
    }
}
