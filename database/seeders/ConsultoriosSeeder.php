<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConsultoriosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('consultorios')->insert([
    ['id' => 1, 'clinica_id' => 11, 'nombre' => 'consultorio 1', 'numero' => '101', 'piso' => '1', 'descripcion' => 'este es un consultorio normal para consulatas normales', 'activo' => 1, 'created_at' => '2026-06-02 04:34:05', 'updated_at' => '2026-06-02 04:34:05', 'estado' => 'Disponible'],
    ['id' => 2, 'clinica_id' => 11, 'nombre' => 'consultorio 2', 'numero' => '102', 'piso' => '1', 'descripcion' => 'consultorio especialisado en pedriatia', 'activo' => 1, 'created_at' => '2026-06-02 11:13:23', 'updated_at' => '2026-06-02 11:13:23', 'estado' => 'Disponible'],
    ['id' => 3, 'clinica_id' => 11, 'nombre' => 'consultorio 3', 'numero' => '103', 'piso' => '2', 'descripcion' => 'esta en el tercer piso', 'activo' => 1, 'created_at' => '2026-06-04 06:19:26', 'updated_at' => '2026-06-04 06:19:26', 'estado' => 'Disponible'],
]);

    }
}
