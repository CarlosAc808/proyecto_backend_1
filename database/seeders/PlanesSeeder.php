<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('planes')->insert([
    ['id' => 1, 'nombre' => 'Plan Premium', 'precio' => 499.99, 'duracion_dias' => 30],
    ['id' => 2, 'nombre' => 'Básico (Freemium)', 'precio' => 0.00, 'duracion_dias' => 3650],
    ['id' => 3, 'nombre' => 'Pro Salud', 'precio' => 1499.00, 'duracion_dias' => 30],
    ['id' => 4, 'nombre' => 'Clínica Enterprise', 'precio' => 3499.00, 'duracion_dias' => 30],
]);

    }
}
