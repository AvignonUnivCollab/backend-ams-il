<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function user_can_register_with_valid_data() 
    {
        $payload = [
            'name' => 'Julien Le',
            'username' => 'ien_lep',
            'email' => 'jullep@gmail.com',
            'password' => 'Julien1.',
            'role' => 'user',
        ];

        $response = $this->postJson('api/register', $payload);

        $result = $response->assertStatus(200)
                         ->assertJsonStructure([
                            'success',
                            'data' => [
                                'token',
                                'user' => [
                                    'id',
                                    'name',
                                    'username',
                                    'email',
                                    'role',
                                    'created_at',
                                    'updated_at'
                                ],
                            ],
                            'message',
                         ]);

        //Verification si notre utilisateur a été ajouter
        $this->assertDatabaseHas('users', [
            'username' => 'julien_lep',
            'email' => 'julienlep@gmail.com',
        ]);
    }


    /** @test */
    public function user_can_not_register_with_invalid_data()
    {
        $payload = [
            'name' => '',
            'username' => '',
            'email' => 'julienlep@gmail.com',
            'password' => 'Julien1.',
            'role' => 'invalid-role',
        ];

        $response = $this->postJson('api/register', $payload);

        $response->assertStatus(422)
                 ->assertJson([
                    'success' => false,
                    'message' => 'Validation Error'
                 ]);
    }

    /** @test */
    public function user_can_login_with_valid_data() 
    {
        $user = User::create([
            'name' => 'Jhon Doe',
            'username' => 'jhon_doe',
            'email' => 'jhondoe@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        $response = $this->postJson('api/login', [
            'username' => 'jhon_doe',
            'password' => 'password123',
        ]);

        $result = $response->assertStatus(200)
                         ->assertJsonStructure([
                            'success',
                            'data' => [
                                'token',
                                'user' => [
                                    'id',
                                    'name',
                                    'username',
                                    'email',
                                    'role',
                                    'created_at',
                                    'updated_at'
                                ],
                            ],
                            'message',
                         ]);
    }


    /** @test */
    public function user_login_fails_with_invalid_credentials()
    {
        $user = User::create([
            'name' => 'Jhon Doe',
            'username' => 'jhon_doe',
            'email' => 'jhondoe@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        $response = $this->postJson('api/login', [
            'username' => 'jhon_d',
            'password' => 'passwd123',
        ]);

        $response->assertStatus(401)
                 ->assertJson([
                    'success' => false,
                    'message' => 'Validation Error'
                 ]);
    }
}
