<?php

namespace App\Http\Controllers;

use App\Models\Agencia;
use Illuminate\Http\Request;

class AgenciaController extends Controller
{
    public $validacion = [
        'nombre' => 'required|min:3|unique:agencias,nombre',
    ];

    public $mensajes = [];


    public function index(Request $request)
    {
        $agencias = Agencia::all();
        return response()->JSON(['agencias' => $agencias, 'total' => count($agencias)], 200);
    }

    public function store(Request $request)
    {
        $request->validate($this->validacion, $this->mensajes);
        $request["fecha_registro"] = date("Y-m-d");
        $agencia = Agencia::create(array_map('mb_strtoupper', $request->all()));
        return response()->JSON([
            'sw' => true,
            'agencia' => $agencia,
            'msj' => 'El registro se realizó de forma correcta',
        ], 200);
    }

    public function update(Request $request, Agencia $agencia)
    {
        $this->validacion['nombre'] = 'required|min:3|unique:agencias,nombre,' . $agencia->id;
        $request->validate($this->validacion, $this->mensajes);
        $agencia->update(array_map('mb_strtoupper', $request->all()));
        return response()->JSON([
            'sw' => true,
            'agencia' => $agencia,
            'msj' => 'El registro se actualizó de forma correcta'
        ], 200);
    }

    public function show(Agencia $agencia)
    {
        return response()->JSON($agencia);
    }

    public function destroy(Agencia $agencia)
    {
        $agencia->delete();
        return response()->JSON([
            'sw' => true,
            'msj' => 'El registro se eliminó correctamente'
        ], 200);
    }
}
