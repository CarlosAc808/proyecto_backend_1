<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorConsultoriosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('doctor_consultorios')->insert([
    ['id' => 1, 'doctor_id' => 2, 'consultorio_id' => 1, 'fecha_inicio' => null, 'fecha_fin' => null, 'activo' => 1, 'created_at' => '2026-06-02 06:02:51', 'updated_at' => '2026-06-02 06:02:51'],
    ['id' => 2, 'doctor_id' => 7, 'consultorio_id' => 2, 'fecha_inicio' => null, 'fecha_fin' => null, 'activo' => 1, 'created_at' => '2026-06-02 11:15:56', 'updated_at' => '2026-06-02 11:15:56'],
    ['id' => 3, 'doctor_id' => 13, 'consultorio_id' => 3, 'fecha_inicio' => null, 'fecha_fin' => null, 'activo' => 1, 'created_at' => '2026-06-04 06:20:39', 'updated_at' => '2026-06-04 06:20:39'],
]);

    }
}
