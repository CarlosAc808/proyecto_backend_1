<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicamentosCaducadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('medicamentos_caducados')->insert([
    ['id' => 1, 'inventario_id' => 7, 'cantidad' => 12, 'motivo' => 'ya caduco'],
]);

    }
}
