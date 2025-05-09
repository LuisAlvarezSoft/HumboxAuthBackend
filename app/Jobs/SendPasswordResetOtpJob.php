<?php
namespace App\Jobs;

use App\Mail\PasswordResetOtpMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

// Este job se encarga de enviar un correo electrónico con el código OTP para la recuperación de contraseña.
class SendPasswordResetOtpJob implements ShouldQueue {
    // Variable para manejar cola de trabajos.
    use Queueable;

    // Propiedades para almacenar el correo electrónico y el código OTP.
    protected string $email;
    protected string $otp;

    // Constructor para inicializar el job con el correo electrónico y el código OTP.
    public function __construct(string $email,string $otp) {
        $this->email = $email;
        $this->otp   = $otp;
    }

    // Método para manejar el envío del correo electrónico con el código OTP.
    public function handle() {
        Mail::to($this->email)
            ->send(new PasswordResetOtpMail($this->otp));
    }
}
