<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Escape;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EscapeTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:fresh --seed');
    }

    public function tearDown(): void
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }


    /** @test */
    public function a_escape_can_be_created_return_escape_room()
    {

        $data_super_admin = [
            'email' => 'super_admin@gmail.com',
            'password' => 'adminpassword',
        ];

        //login with data_super_admin
        $response = $this->post('/api/login', $data_super_admin);

        // get token super admin
        $token = $response['token'];

        $response->assertStatus(200);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/escape', [
            'title' => 'Test Title',
            'status' => 'Test Status',
            'time' => 9,
            'init_time' => '2023-03-15 20:30:00',
            'stage' => 2,
            'rooms_amount' => 3,
        ]);

        $response->assertStatus(201);

        // $this->assertCount(1, Escape::all());

        // $escape = Escape::first();
        // $this->assertEquals($escape->title, 'Test Title');
        // $this->assertEquals($escape->status, 'Test Status');
        // $this->assertEquals($escape->time, 'Test Time');
        // $this->assertEquals($escape->init_time, 'Test Init_time');
        // $this->assertEquals($escape->stage, 'Test Stage');
        // $this->assertEquals($escape->amount, 'Test Rooms_amount');
    }
}
