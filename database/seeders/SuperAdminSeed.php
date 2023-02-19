<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuperAdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'name' => 'super_admin',
            'email' => 'super_admin@gmail.com',
            'password' => Hash::make('adminpassword'),
            'role' => 'super_admin'
        ]);
        }
}
