<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // user admin
        User::create([
            'name' => 'Admin',
            'lastname' => 'Admin',
            'typeDoc' => 'Cedula',
            'numberDoc' => '1010101010',
            'role' => 'admin',
            'phone' => '3144534311',
            'cellphone' => '3144534311',
            'country' => '57',
            'level' => '1',
            'isActive' => '1',
            'ownerId' => 'Administrador',
            'email' => 'admin@arluxury.net',
            'email_verified_at' => now(),
            'password' => bcrypt('ARluxury2021*') // password

        ]);
    }
}
