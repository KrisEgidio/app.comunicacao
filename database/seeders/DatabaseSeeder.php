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
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Kris',
            'email' => 'kris@gmail.com',
            'password' => bcrypt('123456'),
            'degree' => 2,
            'is_admin' => true,
            'is_active' => true,
        ]);

        $this->call([
            EstadoSeeder::class,
            CidadeSeeder::class,
        ]);
    }
}
