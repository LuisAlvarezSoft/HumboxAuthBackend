<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasswordOtpsTable extends Migration {
    public function up() {
        Schema::create('password_otps', function (Blueprint $table) {
            $table->id();
            $table->string('email')->comment('Correo del usuario que solicita OTP');
            $table->string('otp', 6)->comment('Código de 6 dígitos');
            $table->timestamp('expires_at')->comment('Fecha de expiración del OTP');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('password_otps');
    }
}
