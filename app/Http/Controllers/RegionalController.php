<?php

namespace App\Http\Controllers;

use App\Models\Regional;
use Illuminate\Http\Request;

class RegionalController extends Controller
{
    public $validacion = [
        'nombre' => 'required|min:3|unique:regionals,nombre',
    ];

    public $mensajes = [];

    public function index(Request $request)
    {
        $regionals = Regional::all();

        if (isset($request->habilitados)) {
            $regionals = Regional::where("estado", 1)->get();
        }

        if (isset($request->filtra_estado) && $request->filtra_estado == 1) {
            $estado_txt = mb_strtolower($request->estado);
            $estado = 2;
            if ($estado_txt == "habilitado") {
                $estado = 1;
            }
            if ($estado_txt == "deshabilitado") {
                $estado = 0;
            }
            $regionals = Regional::where("estado", $estado)->get();
        }
        return response()->JSON(['regionals' => $regionals, 'total' => count($regionals)], 200);
    }

    public function store(Request $request)
    {
        $request->validate($this->validacion, $this->mensajes);
        $request["fecha_registro"] = date("Y-m-d");
        $regional = Regional::create(array_map('mb_strtoupper', $request->all()));
        return response()->JSON([
            'sw' => true,
            'regional' => $regional,
            'msj' => 'El registro se realizó de forma correcta',
        ], 200);
    }

    public function update(Request $request, Regional $regional)
    {
        $this->validacion['nombre'] = 'required|min:3|unique:regionals,nombre,' . $regional->id;
        $request->validate($this->validacion, $this->mensajes);
        $regional->update(array_map('mb_strtoupper', $request->all()));
        return response()->JSON([
            'sw' => true,
            'regional' => $regional,
            'msj' => 'El registro se actualizó de forma correcta'
        ], 200);
    }

    public function show(Regional $regional)
    {
        return response()->JSON($regional);
    }

    public function destroy(Regional $regional)
    {
        $regional->estado = 0;
        $regional->save();
        return response()->JSON([
            'sw' => true,
            'msj' => 'El registro se eliminó correctamente'
        ], 200);
    }

    public function habilitar(Regional $regional)
    {
        $regional->estado = 1;
        $regional->save();
        return response()->JSON([
            'sw' => true,
            'msj' => 'El registro se habilitó correctamente'
        ], 200);
    }
}
