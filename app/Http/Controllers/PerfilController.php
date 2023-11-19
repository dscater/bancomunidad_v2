<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public $validacion = [];

    public $mensajes = [];

    public function index(Request $request)
    {
        $perfils = Perfil::all();
        return response()->JSON(['perfils' => $perfils, 'total' => count($perfils)], 200);
    }

    public function store(Request $request)
    {
        $request->validate($this->validacion, $this->mensajes);
        $request["fecha_registro"] = date("Y-m-d");
        $perfil = Perfil::create(array_map('mb_strtoupper', $request->all()));
        return response()->JSON([
            'sw' => true,
            'perfil' => $perfil,
            'msj' => 'El registro se realizó de forma correcta',
        ], 200);
    }

    public function update(Request $request, Perfil $perfil)
    {
        $request->validate($this->validacion, $this->mensajes);
        $perfil->update(array_map('mb_strtoupper', $request->all()));
        return response()->JSON([
            'sw' => true,
            'perfil' => $perfil,
            'msj' => 'El registro se actualizó de forma correcta'
        ], 200);
    }

    public function show(Perfil $perfil)
    {
        return response()->JSON($perfil);
    }

    public function destroy(Perfil $perfil)
    {
        $perfil->delete();
        return response()->JSON([
            'sw' => true,
            'msj' => 'El registro se eliminó correctamente'
        ], 200);
    }
}
