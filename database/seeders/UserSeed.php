<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Usuario test',
            'last_name' => 'Usuario test',
            'email' => 'test@gmail.com',
            'edad' => fake()->numberBetween(1, 100),
            'type_document' => fake()->randomElement(['CC', 'TI', 'CE']),
            'number_document' => fake()->numberBetween(10000000, 99999999),
            'image' => null,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ])->assignRole('administrador');

        User::create([
            'name' => 'Usuario test',
            'last_name' => 'Usuario test',
            'email' => 'test2@gmail.com',
            'edad' => fake()->numberBetween(1, 100),
            'type_document' => fake()->randomElement(['CC', 'TI', 'CE']),
            'number_document' => fake()->numberBetween(10000000, 99999999),
            'image' => null,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ])->assignRole('aprendiz');


    }
}
