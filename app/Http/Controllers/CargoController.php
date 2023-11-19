<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    public $validacion = [
        'nombre' => 'required|min:3|unique:cargos,nombre',
        'departamento' => 'required',
    ];

    public $mensajes = [];

    public function index(Request $request)
    {
        $cargos = Cargo::all();
        return response()->JSON(['cargos' => $cargos, 'total' => count($cargos)], 200);
    }

    public function store(Request $request)
    {
        $request->validate($this->validacion, $this->mensajes);
        $request["fecha_registro"] = date("Y-m-d");
        $cargo = Cargo::create(array_map('mb_strtoupper', $request->all()));
        return response()->JSON([
            'sw' => true,
            'cargo' => $cargo,
            'msj' => 'El registro se realizó de forma correcta',
        ], 200);
    }

    public function update(Request $request, Cargo $cargo)
    {
        $this->validacion['nombre'] = 'required|min:3|unique:cargos,nombre,' . $cargo->id;
        $request->validate($this->validacion, $this->mensajes);
        $cargo->update(array_map('mb_strtoupper', $request->all()));
        return response()->JSON([
            'sw' => true,
            'cargo' => $cargo,
            'msj' => 'El registro se actualizó de forma correcta'
        ], 200);
    }

    public function show(Cargo $cargo)
    {
        return response()->JSON($cargo);
    }

    public function destroy(Cargo $cargo)
    {
        $cargo->delete();
        return response()->JSON([
            'sw' => true,
            'msj' => 'El registro se eliminó correctamente'
        ], 200);
    }
}
