<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuarioNotificacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usuario_notificaciones')->insert([
    ['id' => 1, 'usuario_id' => 5, 'notificacion_id' => 1, 'habilitado' => 1, 'canal' => null, 'created_at' => null, 'updated_at' => '2026-04-02 03:36:44'],
    ['id' => 2, 'usuario_id' => 5, 'notificacion_id' => 2, 'habilitado' => 1, 'canal' => null, 'created_at' => null, 'updated_at' => '2026-04-02 03:37:09'],
    ['id' => 3, 'usuario_id' => 156, 'notificacion_id' => 1, 'habilitado' => 0, 'canal' => null, 'created_at' => null, 'updated_at' => null],
    ['id' => 4, 'usuario_id' => 156, 'notificacion_id' => 2, 'habilitado' => 0, 'canal' => null, 'created_at' => null, 'updated_at' => null],
]);

    }
}
