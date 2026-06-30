<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
    ['id' => 1, 'nombre' => 'Administrador'],
    ['id' => 4, 'nombre' => 'Clinica/Farmacia'],
    ['id' => 3, 'nombre' => 'Doctor'],
    ['id' => 2, 'nombre' => 'Paciente'],
]);

    }
}
