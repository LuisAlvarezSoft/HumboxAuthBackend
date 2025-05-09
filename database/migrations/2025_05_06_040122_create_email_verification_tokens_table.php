<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailVerificationTokensTable extends Migration {
    public function up() {
        Schema::create('email_verification_tokens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('Referencia al usuario');
            $table->string('token')->unique()->comment('Token único de verificación');
            $table->timestamp('expires_at')->comment('Fecha de expiración');
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('email_verification_tokens');
    }
}
