<?php

namespace App\Http\Controllers;

use App\Models\AccesoSistema;
use App\Models\Funcionario;
use App\Models\Sistema;
use App\Models\Usuario;
use Illuminate\Http\Request;

class AccesoSistemaController extends Controller
{
    public $validacion = [];

    public $mensajes = [];

    public function index(Request $request)
    {
        $acceso_sistemas = AccesoSistema::all();
        return response()->JSON(['acceso_sistemas' => $acceso_sistemas, 'total' => count($acceso_sistemas)], 200);
    }

    public function store(Request $request)
    {

        $acceso_sistema = AccesoSistema::where("funcionario_id", $request->funcionario_id)
            ->where("sistema_id", $request->sistema_id)
            ->get()->first();
        $acceso = false;

        $funcionario = Funcionario::find($request->funcionario_id);

        $primer_sistema = Sistema::first();

        if (!$acceso_sistema) {
            $acceso_sistema = AccesoSistema::create([
                "funcionario_id" => $request->funcionario_id,
                "sistema_id" => $request->sistema_id,
            ]);
            $acceso = true;
            if ($primer_sistema && $request->sistema_id == $primer_sistema->id) {
                Usuario::where("ci", $funcionario->ci)->first()->update(["acceso" => 1]);
            }
        } else {
            $acceso_sistema->delete();
            $acceso = false;
            if ($primer_sistema && $request->sistema_id == $primer_sistema->id) {
                Usuario::where("ci", $funcionario->ci)->first()->update(["acceso" => 0]);
            }
        }

        return response()->JSON([
            'sw' => true,
            'acceso_sistema' => $acceso_sistema,
            'acceso' => $acceso,
            'msj' => 'El registro se realizó de forma correcta',
        ], 200);
    }

    public function update(Request $request, AccesoSistema $acceso_sistema)
    {
        $request->validate($this->validacion, $this->mensajes);
        $acceso_sistema->update(array_map('mb_strtoupper', $request->all()));
        return response()->JSON([
            'sw' => true,
            'acceso_sistema' => $acceso_sistema,
            'msj' => 'El registro se actualizó de forma correcta'
        ], 200);
    }

    public function show(AccesoSistema $acceso_sistema)
    {
        return response()->JSON($acceso_sistema);
    }

    public function destroy(AccesoSistema $acceso_sistema)
    {
        $acceso_sistema->delete();
        return response()->JSON([
            'sw' => true,
            'msj' => 'El registro se eliminó correctamente'
        ], 200);
    }

    public function getAccesoSistema(Request $request)
    {
        $existe = AccesoSistema::where("funcionario_id", $request->funcionario_id)
            ->where("sistema_id", $request->sistema_id)
            ->get()->first();

        if ($existe) {
            return response()->JSON(true);
        }
        return response()->JSON(false);
    }
}
