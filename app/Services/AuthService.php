<?php

// app/Services/AuthService.php
namespace App\Services;

use App\Repositories\UserRepository;
use App\Repositories\EmailVerificationRepository;
use App\Repositories\PasswordOtpRepository;
use App\Jobs\SendEmailVerificationJob;
use App\Jobs\SendPasswordResetOtpJob;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

// Este servicio maneja la lógica de autenticación y registro de usuarios
class AuthService {
    // Repositorios
    protected UserRepository $userRepo;
    protected EmailVerificationRepository $evRepo;
    protected PasswordOtpRepository $poRepo;

    // Constructor
    public function __construct(
        UserRepository $userRepo,
        EmailVerificationRepository $evRepo,
        PasswordOtpRepository $poRepo
    ) {
        $this->userRepo = $userRepo;
        $this->evRepo   = $evRepo;
        $this->poRepo   = $poRepo;
    }

    /**
     * Registra un usuario, envía email de verificación y retorna token
     */
    public function register(array $data) {
        $data['password']  = Hash::make($data['password']);
        $data['estado_id'] = 2;
        $user = $this->userRepo->create($data);

        $tokenEntity = $this->evRepo->createForUser($user->id);
        dispatch(new SendEmailVerificationJob($user, $tokenEntity->token));

        return $user->createToken('auth_token');
    }

    /**
     * Autentica con email o username, maneja "remember me" y retorna token
     */
    public function login(string $login, string $password, bool $remember = false) {
        $user = $this->userRepo->findByEmailOrUsername($login);
    
        if (!$user || !Hash::check($password, $user->password)) {
            return null;
        }
        
        // Verificar si el usuario está activo y verificado
        if ($user->estado_id !== 1) {
            return 'blocked';
        }

        $expiresAt = $remember
            ? Carbon::now()->addDays(30)
            : Carbon::now()->addHour();

        return $user->createToken('auth_token', ['*'], $expiresAt);
    }

    /**
     * Cierra sesión del token actual
     */
    public function logout(): void {
        Auth::user()->currentAccessToken()->delete();
    }

    /**
     * Cierra sesión en todos los dispositivos
     */
    public function logoutAllSessions(): void {
        Auth::user()->tokens()->delete();
    }

    /**
     * Verifica email con token
     */
    public function verifyEmail(string $token): bool {
        $entity = $this->evRepo->findByToken($token);
        if (!$entity || $entity->isExpired()) {
            return false;
        }
        
        $user = $entity->user;
        $user->update([
            'email_verified_at' => Carbon::now(),
            'estado_id' => 1 // Cambiar a activo
        ]);
        
        $this->evRepo->delete($entity);
        return true;
    }

    /**
     * Envía OTP para recuperación de contraseña
     */
    public function sendResetOtp(string $login): bool {
        $user = $this->userRepo->findByEmailOrUsername($login);
        if (!$user) {
            return false;
        }
        $otpEntity = $this->poRepo->createForEmail($user->email);
        dispatch(new SendPasswordResetOtpJob($user->email, $otpEntity->otp));
        return true;
    }

    /**
     * Resetea contraseña con OTP
     */
    public function resetPasswordWithOtp(string $login, string $otp, string $newPassword): bool {
        $user = $this->userRepo->findByEmailOrUsername($login);
        if (!$user) {
            return false;
        }
        $entity = $this->poRepo->findValid($user->email, $otp);
        if (!$entity) {
            return false;
        }
        $user->password = Hash::make($newPassword);
        $user->save();
        $this->poRepo->delete($entity);
        return true;
    }
}