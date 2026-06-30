<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EspecialidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('especialidades')->insert([
    ['id' => 1, 'nombre' => 'cirujano'],
    ['id' => 2, 'nombre' => 'Pediatría'],
    ['id' => 3, 'nombre' => 'Cardiología'],
    ['id' => 4, 'nombre' => 'Dermatología'],
    ['id' => 5, 'nombre' => 'Ginecología'],
    ['id' => 6, 'nombre' => 'Traumatología'],
    ['id' => 7, 'nombre' => 'Normal'],
]);

    }
}
