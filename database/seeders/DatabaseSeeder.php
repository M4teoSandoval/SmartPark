<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ✅ Ejecutar el seeder de roles primero
        $this->call([
            RolesSeeder::class,
        ]);

        // ✅ (Opcional) crear un usuario admin de prueba
        // \App\Models\User::factory()->create([
        //     'name' => 'Admin',
        //     'email' => 'admin@smartpark.com',
        //     'password' => bcrypt('admin123'),
        //     'role_id' => 1, // admin
        // ]);
    }
}
