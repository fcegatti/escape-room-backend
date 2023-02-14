<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Artisan;

class UserTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate');
    }

    public function tearDown(): void
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }

    /** @test */
    public function test_register_return_access_token()
    {
        $dataUser = [
            'name' => 'nameexample',
            'email' => 'example@email.com',
            'password' => 'examplepassword',
            'password_confirmation' => 'examplepassword',
        ];

        $response = $this->post('/api/register', $dataUser);

        $response->assertStatus(201);

        $response->assertJsonStructure(['token']);

        $this->assertDatabaseHas('users', [
            'name' => 'nameexample',
            'email' => 'example@email.com',
        ]);
    }

    public function test_login_return_access_token()
    {
        $dataUser = [
            'name' => 'nameexample',
            'email' => 'example@email.com',
            'password' => 'examplepassword',
            'password_confirmation' => 'examplepassword',
        ];

        $response = $this->post('/api/register', $dataUser);
        
        $response->assertStatus(201);
        
        $response->assertJsonStructure(['token']);
        
        $this->assertDatabaseHas('users', [
            'name' => 'nameexample',
            'email' => 'example@email.com',
        ]);

        $dataUserLogin = [
            'email' => 'example@email.com',
            'password' => 'examplepassword',
        ];
        
        $response = $this->post('/api/login', $dataUserLogin);
        
        $response->assertStatus(200);

        $response->assertJsonStructure(['token']);
        
    }
}
