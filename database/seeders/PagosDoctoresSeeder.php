<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PagosDoctoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pagos_doctores')->insert([
    ['id' => 1, 'doctor_id' => 1, 'tipo_pago_id' => 1, 'salario_mensual' => 1999997.00, 'porcentaje_consulta' => null, 'renta_mensual' => null, 'observaciones' => null, 'created_at' => '2026-06-02 05:12:41', 'updated_at' => '2026-06-02 05:12:41'],
    ['id' => 2, 'doctor_id' => 3, 'tipo_pago_id' => 1, 'salario_mensual' => 400003.00, 'porcentaje_consulta' => null, 'renta_mensual' => null, 'observaciones' => null, 'created_at' => '2026-06-02 05:40:41', 'updated_at' => '2026-06-02 05:40:41'],
    ['id' => 3, 'doctor_id' => 10, 'tipo_pago_id' => 2, 'salario_mensual' => null, 'porcentaje_consulta' => null, 'renta_mensual' => 230000.00, 'observaciones' => null, 'created_at' => '2026-06-02 11:28:06', 'updated_at' => '2026-06-02 11:28:06'],
    ['id' => 4, 'doctor_id' => 12, 'tipo_pago_id' => 1, 'salario_mensual' => 23303000.00, 'porcentaje_consulta' => null, 'renta_mensual' => null, 'observaciones' => null, 'created_at' => '2026-06-04 06:19:52', 'updated_at' => '2026-06-04 06:19:52'],
]);

    }
}
