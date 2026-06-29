<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distribuidor;

class DistribuidorController extends Controller
{


    public function getApiDistribuidor() {
        // Se usa el método all para obtener todos los formularios
        // "SELECT * FROM formularios"
         $distribuidor = Distribuidor::all();
        return ["distribuidor" => $distribuidor];
    }

     public function proveedores()
    {
        return response()->json(
            Distribuidor::select('id', 'nombre','rfc','direccion','telefono','contacto','ciudad')->get()
        );
    }


    public function getDistribuidoresSelect()
{
    $distribuidores = Distribuidor::select('id', 'nombre')->get();

    return response()->json([
        'data' => $distribuidores
    ]);
}


public function addDistribuidor(Request $request)
{
    $data = $request->all();

    $distribuidor = new Distribuidor();

    $distribuidor->farmacia_id = $data['farmacia_id'] ?? 1; //  obligatorio
    $distribuidor->nombre = $data['nombre'];
    $distribuidor->rfc = $data['rfc'];
    $distribuidor->categoria = $data['categoria'];
    $distribuidor->contacto = $data['contacto'];
    $distribuidor->correo = $data['correo'];
    $distribuidor->telefono = $data['telefono'];
    $distribuidor->direccion = $data['direccion'];
    $distribuidor->ciudad = $data['ciudad'];
    $distribuidor->creado_en = hoy(); //  tu helper

    $distribuidor->save();

    return response()->json([
        'message' => 'Distribuidor guardado con éxito',
        'id' => $distribuidor->id
    ], 201);
}



     public function deleteDistribuidor($id)
{
    $distribuidor = Distribuidor::find($id);

    if (!$distribuidor) {
        return response()->json([
            'message' => 'Distribuidor no encontrado'
        ], 404);
    }

    $distribuidor->delete();

    return response()->json([
        'message' => 'Distribuidor eliminado correctamente'
    ]);
}



public function putApiUpdateDistribuidor($id, Request $request)
{
    $data = $request->all();

    $distribuidor = Distribuidor::find($id);

    if (!$distribuidor) {
        return response()->json([
            'message' => 'Distribuidor no encontrado'
        ], 404);
    }

    $distribuidor->nombre = $data['nombre'];
    $distribuidor->rfc = $data['rfc'];
    $distribuidor->categoria = $data['categoria'];
    $distribuidor->contacto = $data['contacto'];
    $distribuidor->correo = $data['correo'];
    $distribuidor->telefono = $data['telefono'];
    $distribuidor->direccion = $data['direccion'];
    $distribuidor->ciudad = $data['ciudad'];

    $distribuidor->save();

    return response()->json([
        'message' => 'Distribuidor actualizado correctamente',
        'distribuidor' => $distribuidor
    ]);
}
}
