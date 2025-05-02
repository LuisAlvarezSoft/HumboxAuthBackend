HumboxAuthBackend

Microservicio de Autenticación

Descripción

Backend de autenticación para la plataforma estudiantil Humbox, desarrollado en Laravel. Proporciona sistema de registro y autenticación de usuarios con gestión de roles y estados.

Tecnologías
Laravel 10

MySQL

Instalación
Clonar repositorio:
git clone https://github.com/LuisAlvarezSoft/HumboxAuthBackend.git
cd HumboxAuthBackend

Instalar dependencias:
composer install

Configurar base de datos:
Copiar .env.example a .env y configurar credenciales

Ejecutar migraciones:
php artisan migrate --seed

Iniciar servidor:
php artisan serve

Modelos Principales
User: Usuarios del sistema

Role: Roles de usuario (admin, user)

Status: Estados polimórficos

UserProfile: Información adicional de usuarios

Middlewares Implementados
Autenticación

Verificación de roles

Control de estados de usuario

Contribución
Crear rama para nueva funcionalidad

Realizar commits descriptivos

Enviar Pull Request
