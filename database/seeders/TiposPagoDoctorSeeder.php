<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TiposPagoDoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipos_pago_doctor')->insert([
    ['id' => 1, 'nombre' => 'SALARIO_FIJO', 'descripcion' => 'Pago mensual fijo'],
    ['id' => 2, 'nombre' => 'RENTA_CONSULTORIO', 'descripcion' => 'El doctor renta el consultorio'],
    ['id' => 3, 'nombre' => 'PORCENTAJE_CONSULTA', 'descripcion' => 'Pago basado en porcentaje por consulta'],
    ['id' => 4, 'nombre' => 'MIXTO', 'descripcion' => 'Salario fijo mas porcentaje'],
]);

    }
}
