<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate --seed');
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

    public function test_register_admin_return_access_token()
    {

        $dataUser = [
            'name' => 'nameexample',
            'email' => 'example@email.com',
            'password' => 'examplepassword',
            'password_confirmation' => 'examplepassword',
        ];

        $data_super_admin = [
            'email' => 'super_admin@gmail.com',
            'password' => 'adminpassword',
        ];
        
        $response = $this->post('/api/login',$data_super_admin);
        
        $response->assertStatus(200);
        

        $token = $response['token'];


        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/register_admin', $dataUser);
        
        $response->assertStatus(200);
        
        $response->assertJsonStructure(['token']);
        
        $this->assertDatabaseHas('users', [
            'name' => 'nameexample',
            'email' => 'example@email.com',
            'role' => 'admin',
        ]);
        
    }
}
