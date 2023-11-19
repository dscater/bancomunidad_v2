<?php

namespace App\Http\Controllers;

use App\Models\PerfilSistema;
use Illuminate\Http\Request;

class PerfilSistemaController extends Controller
{
    public $validacion = [
        "perfil_id" => "required",
        "sistema_id" => "required"
    ];

    public $mensajes = [];

    public function index(Request $request)
    {
        $perfil_sistemas = PerfilSistema::select("perfil_sistemas.*")
            ->join("sistemas", "sistemas.id", "=", "perfil_sistemas.sistema_id")
            ->where("sistemas.estado", 1)->get();
        if (isset($request->habilitados)) {
            $perfil_sistemas = PerfilSistema::where("estado", 1)->get();
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
            $perfil_sistemas = PerfilSistema::where("estado", $estado)->get();
        }

        return response()->JSON(['perfil_sistemas' => $perfil_sistemas, 'total' => count($perfil_sistemas)], 200);
    }

    public function store(Request $request)
    {
        $request->validate($this->validacion, $this->mensajes);
        $request["fecha_registro"] = date("Y-m-d");
        $perfil_sistema = PerfilSistema::create(array_map('mb_strtoupper', $request->all()));
        return response()->JSON([
            'sw' => true,
            'perfil_sistema' => $perfil_sistema,
            'msj' => 'El registro se realizó de forma correcta',
        ], 200);
    }

    public function update(Request $request, PerfilSistema $perfil_sistema)
    {
        $request->validate($this->validacion, $this->mensajes);
        $perfil_sistema->update(array_map('mb_strtoupper', $request->all()));
        return response()->JSON([
            'sw' => true,
            'perfil_sistema' => $perfil_sistema,
            'msj' => 'El registro se actualizó de forma correcta'
        ], 200);
    }

    public function show(PerfilSistema $perfil_sistema)
    {
        return response()->JSON($perfil_sistema);
    }

    public function destroy(PerfilSistema $perfil_sistema)
    {
        $perfil_sistema->estado = 0;
        $perfil_sistema->save();
        return response()->JSON([
            'sw' => true,
            'msj' => 'El registro se eliminó correctamente'
        ], 200);
    }

    public function habilitar(PerfilSistema $perfil_sistema)
    {
        $perfil_sistema->estado = 1;
        $perfil_sistema->save();
        return response()->JSON([
            'sw' => true,
            'msj' => 'El registro se habilitó correctamente'
        ], 200);
    }
}
