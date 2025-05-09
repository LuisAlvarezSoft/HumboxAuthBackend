<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

// Este modelo User representa un usuario en la base de datos
class User extends Authenticatable {

    use HasApiTokens, HasFactory;

    // Campos asignables
    protected $fillable = [
        'name','username','email','password','estado_id',
    ];

    // Campos ocultos
    protected $hidden = ['password','remember_token'];

    // Casteos
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relacion uno a muchos inversa con el modelo Estado
    public function estado() {
        return $this->belongsTo(Estado::class);
    }
}
