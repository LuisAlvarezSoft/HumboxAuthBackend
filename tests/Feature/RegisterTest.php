<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_registers_a_user_successfully()
    {
        $response = $this->postJson('/api/register', [
            'username' => 'testuser', // CAMBIADO
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'remember' => true,
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'user' => ['id', 'username', 'email'], // CAMBIADO
                     'token',
                     'remember_token',
                     'message',
                 ]);

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);
    }

    /** @test */
    public function it_fails_when_data_is_missing()
    {
        $response = $this->postJson('/api/register', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['username', 'email', 'password']); // CAMBIADO
    }

    /** @test */
    public function it_fails_when_email_is_not_unique()
    {
        User::factory()->create([
            'email' => 'duplicate@example.com',
        ]);

        $response = $this->postJson('/api/register', [
            'username' => 'anotheruser', // CAMBIADO
            'email' => 'duplicate@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['email']);
    }
}