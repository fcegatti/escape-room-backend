<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Room;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Escape::factory(5)->create();
        
        \App\Models\Problem::factory(5)->create();
        \App\Models\Room::factory(5)->create();

        $escape = \App\Models\Escape::factory()->create([
            'title' => fake()->name(),
            'status' => 'status',
            'time' => fake()->time(),
            'init_time' => fake()->date(),
            'stage' =>fake()->randomDigit(),
            'rooms_amount' =>fake()->randomDigit(),

        ]);
        // many to many
        $escape->problems()->attach([
            1,2,3
        ]);
        // one to many
        $room = Room::find(1);
        $escape->rooms()->save($room);

        $room = Room::find(2);
        $escape->rooms()->save($room);
        
        $room = Room::find(2);
        $escape->rooms()->save($room);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(SuperAdminSeed::class);
    }
}
