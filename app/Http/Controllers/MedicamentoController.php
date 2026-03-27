<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Models\Medicamento;
use App\Models\Inventario;
use App\Models\Categoria;


class MedicamentoController extends Controller
{

public function listado()
{

$medicamentos = Medicamento::leftJoin(
    'inventario',
    'medicamentos.id',
    '=',
    'inventario.medicamento_id'
)
->leftJoin(
    'categorias_medicamentos',
    'medicamentos.categoria_id',
    '=',
    'categorias_medicamentos.id'
)
->select(
    'medicamentos.*',
    'categorias_medicamentos.nombre as categoria',
    'inventario.stock',
    'inventario.stock_minimo',
    'inventario.fecha_caducidad',
    'inventario.lote'
)
->get();

return response()->json($medicamentos);

}




    function formulario($id = 0){

        $datos = array();

        if($id == 0){

            $datos['operacion'] = 'Agregar';

            $medicamento = new Medicamento();
            $medicamento->id = 0;

        }else{

            $datos['operacion'] = 'Modificar';

            $medicamento = Medicamento::find($id);

        }

        $datos['medicamento'] = $medicamento;

          return response()->json([
        "mensaje"=>"ok"
    ]);
    }



    function operaciones(Request $r){

        $datos = $r->all();

        $archivo = $r->file('imagen');

        switch ($datos['operacion']) {

            case 'Agregar':

    // Guardar medicamento
    $m = new Medicamento();

    $m->nombre = $datos['nombre'];
    $m->categoria_id = $datos['categoria_id'];
    $m->sustancia_activa = $datos['sustancia_activa'];
    $m->concentracion = $datos['concentracion'];
    $m->unidad = $datos['unidad'];
    $m->presentacion = $datos['presentacion'];
    $m->cantidad_presentacion = $datos['cantidad_presentacion'];
    $m->requiere_receta = $datos['requiere_receta'];
    $m->descripcion_general = $datos['descripcion_general'];
    $m->imagen_url = '';

    $m->save();


    // SUBIR IMAGEN
    if($r->hasFile('imagen')){

        $nombre_archivo = 'medicamento-'.$m->id.'.'.$archivo->getClientOriginalExtension();

        $archivo->storeAs('fotos/medicamentos', $nombre_archivo, 'public');

        $m->imagen_url = $nombre_archivo;

        $m->save();
    }


    // GUARDAR INVENTARIO
    $inventario = new Inventario();

    $inventario->farmacia_id = $datos['farmacia_id'];
    $inventario->medicamento_id = $m->id;
    $inventario->distribuidor_id = $datos['distribuidor_id'];
    $inventario->stock = $datos['stock'];
    $inventario->stock_minimo = $datos['stock_minimo'];
    $inventario->precio_compra = $datos['precio_compra'];
    $inventario->precio_venta = $datos['precio_venta'];
    $inventario->lote = $datos['lote'];
    $inventario->fecha_caducidad = $datos['fecha_caducidad'];

    $inventario->save();

break;




    case 'Modificar':

$m = Medicamento::find($datos['id']);

if(isset($datos['nombre'])){
    $m->nombre = $datos['nombre'];
}

if(isset($datos['categoria_id'])){
    $m->categoria_id = $datos['categoria_id'];
}

if(isset($datos['sustancia_activa'])){
    $m->sustancia_activa = $datos['sustancia_activa'];
}

if(isset($datos['concentracion'])){
    $m->concentracion = $datos['concentracion'];
}

if(isset($datos['unidad'])){
    $m->unidad = $datos['unidad'];
}

if(isset($datos['presentacion'])){
    $m->presentacion = $datos['presentacion'];
}

if(isset($datos['cantidad_presentacion'])){
    $m->cantidad_presentacion = $datos['cantidad_presentacion'];
}

if(isset($datos['requiere_receta'])){
    $m->requiere_receta = $datos['requiere_receta'];
}

if(isset($datos['descripcion_general'])){
    $m->descripcion_general = $datos['descripcion_general'];
}

if($r->hasFile('imagen')){

    if($m->imagen_url != ''){
        Storage::disk('public')->delete('fotos/medicamentos/'.$m->imagen_url);
    }

    $nombre_archivo = 'medicamento-'.$m->id.'.'.$archivo->getClientOriginalExtension();

    $archivo->storeAs('fotos/medicamentos', $nombre_archivo, 'public');

    $m->imagen_url = $nombre_archivo;
}

$m->save();

if(isset($datos['stock'])){

    Inventario::where('medicamento_id',$m->id)->update([
        'stock' => $datos['stock']
    ]);

}
break;




           case 'Eliminar':

    $m = Medicamento::find($datos['id']);

    // eliminar inventario relacionado
    Inventario::where('medicamento_id', $m->id)->delete();

    // eliminar imagen
    if($m->imagen_url != ''){
        Storage::disk('public')->delete('fotos/medicamentos/'.$m->imagen_url);
    }

    // eliminar medicamento
    $m->delete();

break;


        }

        return response()->json([
    "mensaje" => "Operación realizada correctamente"
]);

    }



    public function mostrar_imagen($nombre_imagen){

        $path = storage_path('app/public/fotos/medicamentos/'.$nombre_imagen);


        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);

        $type = File::mimeType($path);

        $response = Response::make($file, 200);

        $response->header("Content-Type", $type);

        return $response;
    }


    public function categorias()
{
    $categorias = Categoria::all();

    return response()->json($categorias);
}

public function index()
{
    return response()->json(
        \App\Models\Medicamento::select('id', 'nombre')->get()
    );
} 
}
