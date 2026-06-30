<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistribuidoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('distribuidores')->insert([
    ['id' => 2, 'farmacia_id' => 1, 'nombre' => 'Gabriel', 'rfc' => '213123', 'contacto' => 'angel', 'correo' => 'Sanlucas@gmail.com', 'telefono' => '9991234569', 'direccion' => 'Calle 56, Distrito 1, Mérida, Yucatán, 97180, México', 'ciudad' => 'Merida', 'activo' => 1, 'categoria' => 'vendedor', 'creado_en' => '2026-03-24 23:33:19'],
    ['id' => 3, 'farmacia_id' => 1, 'nombre' => 'Paris Texas', 'rfc' => '213123', 'contacto' => 'angel', 'correo' => 'Sanlucas@gmail.com', 'telefono' => '9992346745', 'direccion' => 'Ramal Puerto Progreso, Mérida, Yucatán, México', 'ciudad' => 'Progreso', 'activo' => 1, 'categoria' => 'vendedor', 'creado_en' => '2026-03-25 09:19:24'],
]);

    }
}
