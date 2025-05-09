<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

// Este Mailable se encarga de enviar el correo electrónico de verificación al usuario después de su registro.
class EmailVerificationMail extends Mailable {
    // Propiedades para manejar la cola de trabajos y serializar el modelo.
    use Queueable, SerializesModels;

    // Propiedad para almacenar el token de verificación.
    public string $token;

    // Constructor para inicializar el Mailable con el token de verificación.
    public function __construct(string $token) {
        $this->token = $token;
    }

    // Método para construir el correo electrónico.
    public function build() {
        return $this->subject('Confirma tu correo electrónico')
                    ->view('emails.verify-email')
                    ->with(['token' => $this->token]);
    }
}
