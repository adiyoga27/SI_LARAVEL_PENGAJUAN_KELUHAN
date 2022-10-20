<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Adiyoga',
            'email' => 'adiyoga27new@gmail.com',
            'role' => 'admin',
        ]);

        \App\Models\Technician::factory(10)->create();

    }
}
