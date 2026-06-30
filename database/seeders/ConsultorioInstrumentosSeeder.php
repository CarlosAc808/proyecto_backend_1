<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConsultorioInstrumentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('consultorio_instrumentos')->insert([
    ['id' => 1, 'consultorio_id' => 1, 'instrumento_id' => 1, 'cantidad' => 1, 'created_at' => '2026-06-21 04:43:14', 'updated_at' => '2026-06-21 04:43:14'],
    ['id' => 2, 'consultorio_id' => 3, 'instrumento_id' => 2, 'cantidad' => 1, 'created_at' => '2026-06-29 03:47:27', 'updated_at' => '2026-06-29 03:47:27'],
]);

    }
}
