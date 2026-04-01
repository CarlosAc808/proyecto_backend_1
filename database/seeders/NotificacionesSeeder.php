<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class NotificacionesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('notificaciones')->insert([
            [
                'nombre' => 'Notificaciones por WhatsApp',
                'descripcion' => 'Recibir mensajes vía WhatsApp',
                'canal' => 'whatsapp',
                'activo' => 1
            ],
            [
                'nombre' => 'Notificaciones por Correo',
                'descripcion' => 'Recibir mensajes por email',
                'canal' => 'email',
                'activo' => 1
            ]
        ]);
    }
}