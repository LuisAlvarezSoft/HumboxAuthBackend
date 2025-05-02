<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 *
 * Modelo User para la autenticación y gestión de usuarios.
 * 
 * @author Luis Miguel Álvarez <luismiguel.alvarez@humboldt.edu.co>
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Atributos asignables masivamente.
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'remember_token', // Para sesiones persistentes
    ];

    /**
     * Atributos ocultos en respuestas JSON/API.
     * @var array<string>
     */
    protected $hidden = [
        'password',
        'remember_token', // Asegura que no se exponga
    ];

    /**
     * Atributos casteados a tipos nativos.
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}