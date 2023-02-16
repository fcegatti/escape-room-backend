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
        //generate data user
        $dataUser = [
            'name' => 'nameexample',
            'email' => 'example@email.com',
            'password' => 'examplepassword',
            'password_confirmation' => 'examplepassword',
        ];
        
        //generate data super admin by seeders
        $data_super_admin = [
            'email' => 'super_admin@gmail.com',
            'password' => 'adminpassword',
        ];
        
        //login with data_super_admin
        $response = $this->post('/api/login',$data_super_admin);
        
        // get token super admin
        $token = $response['token'];
        
        $response->assertStatus(200);
        
        
        
        // create admin with dataUser and token of super admin
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            ])->post('/api/register_admin', $dataUser);
            
            $response->assertStatus(200);
            
            $response->assertJsonStructure(['token']);
            
            // compare the new admin
            $this->assertDatabaseHas('users', [
                'name' => 'nameexample',
                'email' => 'example@email.com',
                'role' => 'admin',
            ]);
            
        }
}
