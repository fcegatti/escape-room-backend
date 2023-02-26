<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Escape;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EscapeTest extends TestCase
{


    private $token;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:fresh --seed');
        $data_super_admin = [
            'email' => 'super_admin@gmail.com',
            'password' => 'adminpassword',
        ];

        //login with data_super_admin
        $response = $this->post('/api/login', $data_super_admin);

        // get token super admin
        $this->token = $response['token'];
    }

    public function tearDown(): void
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }

    /** @test */
    public function a_escape_can_be_created_return_escape_room()
    {

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->post('/api/escape', [
            'title' => 'Test Title',
            'status' => 'Test Status',
            'time' => 9,
            'stage' => 2,
            'rooms_amount' => 3,
        ]);

        $response->assertStatus(201);


        $response->assertJsonStructure([
            'success',
            'message',
            'escape' => [
                'title',
                'status',
                'time',
                'rooms_amount',
                'updated_at',
                'created_at',
                'id'
            ]
        ]);
    }
    /** @test */
    public function test_index_escape_return_escapes_with_rooms()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->get('/api/escape');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'success',
            'escape' => [
                '*' => [
                    'id',
                    'created_at',
                    'updated_at',
                    'title',
                    'status',
                    'time',
                    'rooms_amount',
                    'problems',
                    'rooms' => [
                        '*' => [
                            'id',
                            'escape_id',
                            'maxUsers',
                            'init_time',
                            'points',
                            'created_at',
                            'updated_at',
                        ]
                    ]
                ]
            ]
        ]);
    }
    /** @test */

    public function test_update_escape_room_return_new_escape_room()
    {

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->post('/api/escape', [
            'title' => 'Test Title',
            'status' => 'Test Status',
            'time' => 9,
            'stage' => 2,
            'rooms_amount' => 3,
        ]);

        $response->assertStatus(201);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->put('/api/escape/1', [
            'title' => 'Test Title updated',
            'status' => 'Test Status updated',
            'time' => 10,
            'stage' => 3,
            'rooms_amount' => 4,
        ]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'success',
            'message',
            'escape' => [
                'title',
                'status',
                'time',
                'rooms_amount',
                'updated_at',
                'created_at',
                'id'
            ]
        ]);

        // Verifica el título actualizado del escape
        $response->assertJsonFragment([
            'title' => 'Test Title updated'
        ]);

        // Verifica el estado actualizado del escape
        $response->assertJsonFragment([
            'status' => 'Test Status updated'
        ]);

        // Verifica el tiempo actualizado del escape
        $response->assertJsonFragment([
            'time' => 10
        ]);

        $response->assertJsonFragment([
            'rooms_amount' => 4,
        ]);
    }
    /** @test */

    public function test_delete_escape_return_status_204()
    {
        // Crear un escape
        $escape = Escape::factory()->create();

        // Hacer la solicitud de eliminación del escape creado
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->delete('/api/escape/' . $escape->id);

        // Verificar que la respuesta tenga el código 204 (sin contenido)
        $response->assertStatus(204);

        // Verificar que el escape ya no exista en la base de datos
        $this->assertDatabaseMissing('escapes', ['id' => $escape->id]);
    }
}
