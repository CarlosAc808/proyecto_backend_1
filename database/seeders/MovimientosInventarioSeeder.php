<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovimientosInventarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('movimientos_inventario')->insert([
    ['id' => 1, 'inventario_id' => 2, 'tipo' => 'salida', 'cantidad' => 36, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 8, 'usuario_id' => 1, 'fecha_movimiento' => '2026-03-24 09:43:16'],
    ['id' => 2, 'inventario_id' => 5, 'tipo' => 'salida', 'cantidad' => 12, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 8, 'usuario_id' => 1, 'fecha_movimiento' => '2025-12-04 09:43:17'],
    ['id' => 3, 'inventario_id' => 6, 'tipo' => 'entrada', 'cantidad' => 38, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 39, 'usuario_id' => 1, 'fecha_movimiento' => '2026-01-01 09:43:17'],
    ['id' => 4, 'inventario_id' => 6, 'tipo' => 'salida', 'cantidad' => 34, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 34, 'usuario_id' => 1, 'fecha_movimiento' => '2026-03-02 09:43:17'],
    ['id' => 5, 'inventario_id' => 7, 'tipo' => 'salida', 'cantidad' => 12, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 1, 'usuario_id' => 1, 'fecha_movimiento' => '2026-01-02 09:43:17'],
    ['id' => 6, 'inventario_id' => 8, 'tipo' => 'entrada', 'cantidad' => 28, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 16, 'usuario_id' => 1, 'fecha_movimiento' => '2026-03-06 09:43:17'],
    ['id' => 7, 'inventario_id' => 9, 'tipo' => 'entrada', 'cantidad' => 32, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 36, 'usuario_id' => 1, 'fecha_movimiento' => '2026-01-25 09:43:17'],
    ['id' => 8, 'inventario_id' => 10, 'tipo' => 'salida', 'cantidad' => 43, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 18, 'usuario_id' => 1, 'fecha_movimiento' => '2026-01-18 09:43:17'],
    ['id' => 9, 'inventario_id' => 11, 'tipo' => 'entrada', 'cantidad' => 29, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 28, 'usuario_id' => 1, 'fecha_movimiento' => '2025-12-12 09:43:17'],
    ['id' => 10, 'inventario_id' => 11, 'tipo' => 'salida', 'cantidad' => 6, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 7, 'usuario_id' => 1, 'fecha_movimiento' => '2026-02-09 09:43:17'],
    ['id' => 11, 'inventario_id' => 12, 'tipo' => 'salida', 'cantidad' => 18, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 5, 'usuario_id' => 1, 'fecha_movimiento' => '2026-01-11 09:43:17'],
    ['id' => 12, 'inventario_id' => 13, 'tipo' => 'salida', 'cantidad' => 7, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 38, 'usuario_id' => 1, 'fecha_movimiento' => '2026-02-23 09:43:17'],
    ['id' => 13, 'inventario_id' => 13, 'tipo' => 'salida', 'cantidad' => 14, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 39, 'usuario_id' => 1, 'fecha_movimiento' => '2025-12-24 09:43:17'],
    ['id' => 14, 'inventario_id' => 14, 'tipo' => 'salida', 'cantidad' => 21, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 14, 'usuario_id' => 1, 'fecha_movimiento' => '2025-12-08 09:43:17'],
    ['id' => 15, 'inventario_id' => 14, 'tipo' => 'entrada', 'cantidad' => 40, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 19, 'usuario_id' => 1, 'fecha_movimiento' => '2025-11-30 09:43:17'],
    ['id' => 16, 'inventario_id' => 15, 'tipo' => 'salida', 'cantidad' => 35, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 23, 'usuario_id' => 1, 'fecha_movimiento' => '2026-03-20 09:43:17'],
    ['id' => 17, 'inventario_id' => 16, 'tipo' => 'entrada', 'cantidad' => 41, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 26, 'usuario_id' => 1, 'fecha_movimiento' => '2025-12-29 09:43:17'],
    ['id' => 18, 'inventario_id' => 16, 'tipo' => 'salida', 'cantidad' => 20, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 19, 'usuario_id' => 1, 'fecha_movimiento' => '2025-12-29 09:43:17'],
    ['id' => 19, 'inventario_id' => 17, 'tipo' => 'entrada', 'cantidad' => 42, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 7, 'usuario_id' => 1, 'fecha_movimiento' => '2026-02-03 09:43:17'],
    ['id' => 20, 'inventario_id' => 17, 'tipo' => 'entrada', 'cantidad' => 14, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 4, 'usuario_id' => 1, 'fecha_movimiento' => '2026-03-05 09:43:17'],
    ['id' => 21, 'inventario_id' => 18, 'tipo' => 'salida', 'cantidad' => 20, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 15, 'usuario_id' => 1, 'fecha_movimiento' => '2026-02-08 09:43:17'],
    ['id' => 22, 'inventario_id' => 19, 'tipo' => 'entrada', 'cantidad' => 19, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 10, 'usuario_id' => 1, 'fecha_movimiento' => '2026-03-12 09:43:17'],
    ['id' => 23, 'inventario_id' => 19, 'tipo' => 'entrada', 'cantidad' => 26, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 1, 'usuario_id' => 1, 'fecha_movimiento' => '2026-01-16 09:43:17'],
    ['id' => 24, 'inventario_id' => 20, 'tipo' => 'entrada', 'cantidad' => 31, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 29, 'usuario_id' => 1, 'fecha_movimiento' => '2026-01-31 09:43:17'],
    ['id' => 25, 'inventario_id' => 20, 'tipo' => 'entrada', 'cantidad' => 49, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 4, 'usuario_id' => 1, 'fecha_movimiento' => '2026-03-23 09:43:17'],
    ['id' => 26, 'inventario_id' => 21, 'tipo' => 'salida', 'cantidad' => 9, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 30, 'usuario_id' => 1, 'fecha_movimiento' => '2026-01-07 09:43:17'],
    ['id' => 27, 'inventario_id' => 22, 'tipo' => 'entrada', 'cantidad' => 42, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 23, 'usuario_id' => 1, 'fecha_movimiento' => '2026-02-21 09:43:17'],
    ['id' => 28, 'inventario_id' => 22, 'tipo' => 'salida', 'cantidad' => 9, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 37, 'usuario_id' => 1, 'fecha_movimiento' => '2026-01-08 09:43:17'],
    ['id' => 29, 'inventario_id' => 23, 'tipo' => 'entrada', 'cantidad' => 15, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 7, 'usuario_id' => 1, 'fecha_movimiento' => '2026-03-06 09:43:17'],
    ['id' => 30, 'inventario_id' => 23, 'tipo' => 'salida', 'cantidad' => 22, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 37, 'usuario_id' => 1, 'fecha_movimiento' => '2025-12-25 09:43:17'],
    ['id' => 31, 'inventario_id' => 24, 'tipo' => 'entrada', 'cantidad' => 46, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 26, 'usuario_id' => 1, 'fecha_movimiento' => '2025-11-26 09:43:17'],
    ['id' => 32, 'inventario_id' => 24, 'tipo' => 'salida', 'cantidad' => 13, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 35, 'usuario_id' => 1, 'fecha_movimiento' => '2026-02-01 09:43:17'],
    ['id' => 33, 'inventario_id' => 25, 'tipo' => 'entrada', 'cantidad' => 23, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 7, 'usuario_id' => 1, 'fecha_movimiento' => '2026-03-05 09:43:17'],
    ['id' => 34, 'inventario_id' => 26, 'tipo' => 'entrada', 'cantidad' => 10, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 18, 'usuario_id' => 1, 'fecha_movimiento' => '2026-01-01 09:43:17'],
    ['id' => 35, 'inventario_id' => 27, 'tipo' => 'salida', 'cantidad' => 30, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 15, 'usuario_id' => 1, 'fecha_movimiento' => '2025-12-03 09:43:17'],
    ['id' => 36, 'inventario_id' => 28, 'tipo' => 'entrada', 'cantidad' => 28, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 33, 'usuario_id' => 1, 'fecha_movimiento' => '2026-01-21 09:43:17'],
    ['id' => 37, 'inventario_id' => 29, 'tipo' => 'entrada', 'cantidad' => 43, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 37, 'usuario_id' => 1, 'fecha_movimiento' => '2025-12-26 09:43:17'],
    ['id' => 38, 'inventario_id' => 29, 'tipo' => 'entrada', 'cantidad' => 21, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 29, 'usuario_id' => 1, 'fecha_movimiento' => '2026-01-26 09:43:17'],
    ['id' => 39, 'inventario_id' => 30, 'tipo' => 'salida', 'cantidad' => 27, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 14, 'usuario_id' => 1, 'fecha_movimiento' => '2026-01-08 09:43:17'],
    ['id' => 40, 'inventario_id' => 31, 'tipo' => 'salida', 'cantidad' => 44, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 34, 'usuario_id' => 1, 'fecha_movimiento' => '2026-01-27 09:43:17'],
    ['id' => 41, 'inventario_id' => 32, 'tipo' => 'salida', 'cantidad' => 25, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 13, 'usuario_id' => 1, 'fecha_movimiento' => '2026-01-07 09:43:17'],
    ['id' => 42, 'inventario_id' => 33, 'tipo' => 'entrada', 'cantidad' => 7, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 2, 'usuario_id' => 1, 'fecha_movimiento' => '2026-01-12 09:43:17'],
    ['id' => 43, 'inventario_id' => 33, 'tipo' => 'salida', 'cantidad' => 30, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 11, 'usuario_id' => 1, 'fecha_movimiento' => '2026-03-03 09:43:17'],
    ['id' => 44, 'inventario_id' => 34, 'tipo' => 'salida', 'cantidad' => 10, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 3, 'usuario_id' => 1, 'fecha_movimiento' => '2025-12-22 09:43:17'],
    ['id' => 45, 'inventario_id' => 34, 'tipo' => 'entrada', 'cantidad' => 11, 'motivo' => 'Generado automático', 'proveedor_id' => 2, 'receta_id' => 37, 'usuario_id' => 1, 'fecha_movimiento' => '2026-03-08 09:43:17'],
    ['id' => 46, 'inventario_id' => 7, 'tipo' => 'entrada', 'cantidad' => 234, 'motivo' => 'Almacen de medicamentos', 'proveedor_id' => 3, 'receta_id' => null, 'usuario_id' => 1, 'fecha_movimiento' => '2026-03-27 09:38:06'],
    ['id' => 47, 'inventario_id' => 5, 'tipo' => 'salida', 'cantidad' => 1, 'motivo' => 'compra', 'proveedor_id' => null, 'receta_id' => 7, 'usuario_id' => 1, 'fecha_movimiento' => '2026-06-02 11:10:15'],
]);

    }
}
