<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Faker\Factory as Faker;

use App\Models\Usuario;
use App\Models\Paciente;
use App\Models\Doctor;
use App\Models\Cita;
use App\Models\Consulta;
use App\Models\Medicamento;
use App\Models\Inventario;
use App\Models\Receta;
use App\Models\RecetaDetalle;
use App\Models\MovimientoInventario;

class FakerController extends Controller
{

    public function generarDatos()
    {
        $faker = Faker::create('es_MX');
        $password = bcrypt('123456');

        // ============================
        // 1. CREAR USUARIOS PACIENTES
        // ============================
        for ($i = 0; $i < 50; $i++) {

            $usuario = Usuario::create([
                'rol_id' => 2, // Paciente
                'nombre' => $faker->name,
                'correo' => $faker->unique()->safeEmail,
                'telefono' => $faker->phoneNumber,
                'password' => $password,
                'activo' => 1
            ]);

            Paciente::create([
                'usuario_id' => $usuario->id,
                'fecha_nacimiento' => $faker->date(),
                'genero' => $faker->randomElement(['M', 'F']),
                'tipo_sangre' => $faker->randomElement(['A+', 'O+', 'B+', 'AB+']),
                'alergias' => $faker->sentence,
                'antecedentes' => $faker->sentence,
                'direccion' => $faker->address
            ]);
        }

        // ============================
        // 2. CREAR USUARIOS DOCTORES
        // ============================
        for ($i = 0; $i < 10; $i++) {

            $usuario = Usuario::create([
                'rol_id' => 3, // Doctor
                'nombre' => $faker->name,
                'correo' => $faker->unique()->safeEmail,
                'telefono' => $faker->phoneNumber,
                'password' => $password,
                'activo' => 1
            ]);

            Doctor::create([
                'usuario_id' => $usuario->id,
                'clinica_id' => 1,
                'especialidad_id' => $faker->randomElement([2,3]),
                'cedula_profesional' => $faker->numerify('######'),
                'anios_exp' => $faker->numberBetween(1, 40),
                'telefono' => $faker->phoneNumber
            ]);
        }

        // ============================
        // 3. CREAR CITAS
        // ============================
        $pacientes = Paciente::all();
        $doctores = Doctor::all();

        foreach ($pacientes as $paciente) {

            $doctor = $doctores->random();

            $fechaInicio = $faker->dateTimeBetween('-1 month', '+1 month');

            $cita = Cita::create([
                'doctor_id' => $doctor->id,
                'paciente_id' => $paciente->id,
                'clinica_id' => 1,
                'fecha_inicio' => $fechaInicio,
                'fecha_fin' => (clone $fechaInicio)->modify('+30 minutes'),
                'estado' => $faker->randomElement(['pendiente', 'completada', 'cancelada']),
                'motivo' => $faker->sentence
            ]);

            // ============================
            // 4. CREAR CONSULTAS
            // ============================
    if ($cita && $cita->estado == 'completada') {

    Consulta::create([
        'cita_id' => $cita->id,
        'doctor_id' => $doctor->id,
        'paciente_id' => $paciente->id,
        'sintomas' => $faker->sentence,
        'diagnostico' => $faker->sentence,
        'notas_clinicas' => $faker->paragraph
    ]);
}
        }

        // ============================
        // 5. INVENTARIO SIMPLE
        // ============================
        $medicamentos = Medicamento::all();

        foreach ($medicamentos as $med) {

            Inventario::create([
                'farmacia_id' => 1,
                'medicamento_id' => $med->id,
                'distribuidor_id' => 1,
                'stock' => $faker->numberBetween(10, 500),
                'stock_minimo' => 5,
                'precio_compra' => $faker->randomFloat(2, 10, 50),
                'precio_venta' => $faker->randomFloat(2, 60, 150),
                'lote' => strtoupper($faker->bothify('LOT###??')),
                'fecha_caducidad' => $faker->dateTimeBetween('+6 months', '+2 years')
            ]);
        }

        return "Datos generados correctamente con Faker.";
    }


public function generarMedicamentosFake()
{
    $faker = Faker::create('es_MX');

    $categorias = \App\Models\Categoria::all();

    if ($categorias->isEmpty()) {
        return "No hay categorías, crea al menos una.";
    }

    for ($i = 0; $i < 30; $i++) {

        $medicamento = Medicamento::create([
            'nombre' => $faker->randomElement([
                'Paracetamol', 'Ibuprofeno', 'Amoxicilina',
                'Aspirina', 'Omeprazol', 'Loratadina'
            ]) . ' ' . $faker->randomElement(['500mg', '250mg', '100mg']),

            'categoria_id' => $categorias->random()->id,
            'sustancia_activa' => $faker->word,
            'concentracion' => $faker->randomElement(['100', '250', '500']),
            'unidad' => 'mg',
            'presentacion' => $faker->randomElement(['Tabletas', 'Cápsulas', 'Jarabe']),
            'cantidad_presentacion' => rand(10, 30),
            'requiere_receta' => $faker->boolean,
            'descripcion_general' => $faker->sentence,
            'imagen_url' => null
        ]);

        //  INVENTARIO LIGADO PERO SEGURO
        Inventario::create([
            'farmacia_id' => 1,
            'medicamento_id' => $medicamento->id,
            'distribuidor_id' => 2,
            'stock' => rand(20, 150),
            'stock_minimo' => 5,
            'precio_compra' => $faker->randomFloat(2, 5, 50),
            'precio_venta' => $faker->randomFloat(2, 60, 150),
            'lote' => strtoupper($faker->bothify('LOT###??')),
            'fecha_caducidad' => $faker->dateTimeBetween('+6 months', '+2 years')
        ]);
    }

    return " Medicamentos + inventario generados correctamente";
}

public function dashboardFarmacia(Request $request)
{
    $faker = \Faker\Factory::create('es_MX'); //  FALTABA

    $mes = $request->query('mes');

    $inventarios = Inventario::with('medicamento')->get();
    $doctores = \App\Models\Doctor::pluck('id');
    $consultas = Consulta::pluck('id');

    if ($inventarios->isEmpty()) {
        return response()->json(['error' => 'No hay inventario registrado']);
    }

    if ($doctores->isEmpty()) {
        return response()->json(['error' => 'No hay doctores registrados']);
    }

    // =========================
    // 1. RECETAS (MEJORADAS)
    // =========================
    for ($i = 0; $i < 40; $i++) {

        try {

            $consultaId = $consultas->isNotEmpty()
                ? $consultas->random()
                : null;

            //  CLAVE: TIPOS DE FECHA
            if ($i < 15) {
                $fechaRandom = now(); // HOY
            } else {
                $fechaRandom = now()->subDays(rand(1, 90)); // HISTORIAL
            }

            $receta = \App\Models\Receta::create([
                'consulta_id' => $consultaId,
                'doctor_id' => $doctores->random(),
                'paciente_id' => 1,
                'farmacia_id' => 1,
                'estado' => $faker->randomElement(['pendiente', 'entregada']),
                'creado_en' => $fechaRandom
            ]);

            // DETALLES
            for ($j = 0; $j < rand(1, 3); $j++) {

                $inv = $inventarios->random();

                \App\Models\RecetaDetalle::create([
                    'receta_id' => $receta->id,
                    'medicamento_id' => $inv->medicamento_id,
                    'dosis' => '1 tableta',
                    'frecuencia' => 'Cada 8 horas',
                    'duracion' => rand(3, 10) . ' días',
                    'instrucciones' => 'Tomar con alimentos',
                    'creado_en' => $fechaRandom
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al crear receta',
                'detalle' => $e->getMessage()
            ]);
        }
    }

    // =========================
    // 2. MOVIMIENTOS
    // =========================
    foreach ($inventarios as $inv) {

        for ($i = 0; $i < rand(1, 2); $i++) {

            $fecha = now()->subDays(rand(0, 120));

            if ($mes && $fecha->format('Y-m') !== $mes) continue;

            \App\Models\MovimientoInventario::create([
                'inventario_id' => $inv->id,
                'tipo' => rand(0, 1) ? 'entrada' : 'salida',
                'cantidad' => rand(5, 50),
                'motivo' => 'Generado automático',
                'proveedor_id' => $inv->distribuidor_id,
                'receta_id' => \App\Models\Receta::inRandomOrder()->value('id'),
                'usuario_id' => 1,
                'fecha_movimiento' => $fecha,
            ]);
        }
    }

    // =========================
    // 3. MOVIMIENTOS LISTADO
    // =========================
    $movimientos = \App\Models\MovimientoInventario::with([
        'inventario.medicamento',
        'proveedor'
    ])
    ->when($mes, function ($q) use ($mes) {
        $q->whereRaw("DATE_FORMAT(fecha_movimiento, '%Y-%m') = ?", [$mes]);
    })
    ->orderBy('fecha_movimiento', 'desc')
    ->get()
    ->map(function ($m) {
        return [
            'id' => $m->id,
            'fecha' => optional($m->fecha_movimiento)->format('Y-m-d'),
            'medicamento' => $m->inventario->medicamento->nombre ?? 'N/A',
            'proveedor' => $m->proveedor->nombre ?? 'N/A',
            'tipo' => $m->tipo,
            'cantidad' => $m->cantidad,
        ];
    });

    // =========================
    // 4. RECETAS (SEPARADAS )
    // =========================
    $recetasHoy = \App\Models\Receta::whereDate('creado_en', now())
        ->with('detalles.medicamento')
        ->get();

    $historial = \App\Models\Receta::whereDate('creado_en', '<', now())
        ->limit(20)
        ->get();

    // =========================
    // 5. INVENTARIO
    // =========================
    $inventario = $inventarios->map(function ($inv) {
        return [
            'nombre' => $inv->medicamento->nombre ?? 'N/A',
            'stock' => $inv->stock,
            'minimo' => $inv->stock_minimo,
            'caducaEn' => $inv->fecha_caducidad 
                ? now()->diffInDays($inv->fecha_caducidad, false)
                : null,
        ];
    });

    // =========================
    // 6. CONSUMO
    // =========================
    $consumo = \App\Models\MovimientoInventario::selectRaw('inventario_id, SUM(cantidad) as total')
        ->where('tipo', 'salida')
        ->groupBy('inventario_id')
        ->with('inventario.medicamento')
        ->get()
        ->map(function ($c) {
            return [
                'nombre' => $c->inventario->medicamento->nombre ?? 'N/A',
                'total' => $c->total,
            ];
        });

    return response()->json([
        'mensaje' => ' Dashboard PRO listo',
        'movimientos' => $movimientos,
        'recetas_hoy' => $recetasHoy,
        'historial' => $historial,
        'inventario' => $inventario,
        'consumo' => $consumo
    ]);
}


public function generarCaducidadDemo()
{
    $inventarios = \App\Models\Inventario::with('medicamento')->get();

    if ($inventarios->isEmpty()) {
        return response()->json(['error' => 'No hay inventario']);
    }

    foreach ($inventarios as $inv) {

        // Generar fechas cercanas y lejanas
        $dias = rand(1, 60);

        $inv->update([
            'fecha_caducidad' => now()->addDays($dias)
        ]);
    }

    return response()->json([
        'mensaje' => 'Caducidad generada correctamente'
    ]);
}
}