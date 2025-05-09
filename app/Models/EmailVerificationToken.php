<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

// Este modelo EmailVerificationToken representa un token de verificación de correo electrónico
class EmailVerificationToken extends Model {
    // Los campos que son asignables
    protected $fillable = ['user_id','token','expires_at'];

    // Casteos del modelo
    protected $casts = [
        'expires_at' => 'datetime',
    ];

    // Funcion para comprobar si esta expirado el token
    public function isExpired(): bool {
        return $this->expires_at->lt(Carbon::now());
    }

    // Relacion uno a muchos inversa con el modelo User
    public function user() {
        return $this->belongsTo(User::class);
    }
}
