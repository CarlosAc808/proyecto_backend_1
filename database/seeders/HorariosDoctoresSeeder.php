<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HorariosDoctoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('horarios_doctores')->insert([
    ['id' => 1, 'doctor_id' => 2, 'consultorio_id' => 1, 'dia_semana' => 4, 'hora_inicio' => '06:00:00', 'hora_fin' => '20:00:00', 'activo' => 1, 'created_at' => '2026-06-02 06:02:51', 'updated_at' => '2026-06-02 06:02:51'],
    ['id' => 2, 'doctor_id' => 2, 'consultorio_id' => 1, 'dia_semana' => 6, 'hora_inicio' => '09:00:00', 'hora_fin' => '20:00:00', 'activo' => 1, 'created_at' => '2026-06-02 06:02:51', 'updated_at' => '2026-06-02 06:02:51'],
    ['id' => 3, 'doctor_id' => 7, 'consultorio_id' => 2, 'dia_semana' => 1, 'hora_inicio' => '08:00:00', 'hora_fin' => '18:16:00', 'activo' => 1, 'created_at' => '2026-06-02 11:15:56', 'updated_at' => '2026-06-02 11:15:56'],
    ['id' => 4, 'doctor_id' => 7, 'consultorio_id' => 2, 'dia_semana' => 3, 'hora_inicio' => '05:20:00', 'hora_fin' => '10:00:00', 'activo' => 1, 'created_at' => '2026-06-02 11:15:56', 'updated_at' => '2026-06-02 11:15:56'],
    ['id' => 5, 'doctor_id' => 7, 'consultorio_id' => 2, 'dia_semana' => 5, 'hora_inicio' => '08:00:00', 'hora_fin' => '11:00:00', 'activo' => 1, 'created_at' => '2026-06-02 11:15:56', 'updated_at' => '2026-06-02 11:15:56'],
    ['id' => 6, 'doctor_id' => 7, 'consultorio_id' => 2, 'dia_semana' => 7, 'hora_inicio' => '10:00:00', 'hora_fin' => '05:30:00', 'activo' => 1, 'created_at' => '2026-06-02 11:15:56', 'updated_at' => '2026-06-02 11:15:56'],
    ['id' => 7, 'doctor_id' => 13, 'consultorio_id' => 3, 'dia_semana' => 5, 'hora_inicio' => '08:12:00', 'hora_fin' => '23:22:00', 'activo' => 1, 'created_at' => '2026-06-04 06:20:39', 'updated_at' => '2026-06-04 06:20:39'],
]);

    }
}
