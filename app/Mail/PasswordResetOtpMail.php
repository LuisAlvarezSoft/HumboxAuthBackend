<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

// Este Mailable se encarga de enviar el correo electrónico de recuperación de contraseña al usuario.
class PasswordResetOtpMail extends Mailable {
    // Propiedades para manejar la cola de trabajos y serializar el modelo.
    use Queueable, SerializesModels;

    // Propiedad para almacenar el código OTP.
    public string $otp;

    // Constructor para inicializar el Mailable con el código OTP.
    public function __construct(string $otp) {
        $this->otp = $otp;
    }

    // Método para construir el correo electrónico.
    public function build() {
        return $this->subject('Tu código de recuperación de contraseña')
                    ->view('emails.password-otp')
                    ->with(['otp' => $this->otp]);
    }
}
