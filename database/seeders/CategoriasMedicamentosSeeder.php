<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriasMedicamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorias_medicamentos')->insert([
    ['id' => 1, 'nombre' => 'Analgésicos', 'descripcion' => 'Medicamentos para aliviar el dolor'],
    ['id' => 2, 'nombre' => 'Antibióticos', 'descripcion' => 'Medicamentos para infecciones bacterianas'],
    ['id' => 3, 'nombre' => 'Antiinflamatorios', 'descripcion' => 'Reducen inflamación y dolor'],
    ['id' => 4, 'nombre' => 'Antialérgicos', 'descripcion' => 'Tratamiento para alergias'],
    ['id' => 5, 'nombre' => 'Gastrointestinales', 'descripcion' => 'Problemas del sistema digestivo'],
    ['id' => 6, 'nombre' => 'Vitaminas', 'descripcion' => 'Suplementos vitamínicos'],
    ['id' => 7, 'nombre' => 'Jarabes', 'descripcion' => 'Medicamentos líquidos para tos o garganta'],
    ['id' => 8, 'nombre' => 'Pediátricos', 'descripcion' => 'Medicamentos para niños'],
]);
    }
}
