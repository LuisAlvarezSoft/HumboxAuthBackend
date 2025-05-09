<?php
namespace App\Jobs;

use App\Mail\EmailVerificationMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

// Este job se encarga de enviar un correo electrónico de verificación al usuario después de su registro.
class SendEmailVerificationJob implements ShouldQueue {
    // Variable para manejar cola de trabajos.
    use Queueable;

    // Propiedades para almacenar el usuario y el token de verificación.
    protected User $user;
    protected string $token;

    // Constructor para inicializar el job con el usuario y el token.
    public function __construct(User $user,string $token) {
        $this->user  = $user;
        $this->token = $token;
    }

    // Método para manejar el envío del correo electrónico de verificación.
    public function handle() {
        Mail::to($this->user->email)
            ->send(new EmailVerificationMail($this->token));
    }
}
