<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            ['id' => 1, 'nombre' => 'Admin', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nombre' => 'Usuario', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
