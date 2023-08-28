<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        /*\App\Models\User::factory()->create([
            'name' => 'Test User',
            'last_name' => 'Test',
            'email' => 'test@example.com',
            'edad' => 20,
            'type_document' => 'CC',
            'number_document' => 12345678,
            'image' => null,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);*/


        // Roles
        $this->call(RoleSeed::class);

        // Usuario
        $this->call(UserSeed::class);
    }
}
