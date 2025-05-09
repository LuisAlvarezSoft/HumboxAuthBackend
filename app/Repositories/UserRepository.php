<?php
namespace App\Repositories;

use App\Models\User;

// Este repositorio UserRepository maneja la lógica de acceso a datos para el modelo User
class UserRepository {
    // Crear usuario
    public function create(array $data): User {
        return User::create($data);
    }

    // Encontrar por email o username
    public function findByEmailOrUsername(string $login): ?User {
        return User::where('email',$login)
                   ->orWhere('username',$login)
                   ->first();
    }
}
