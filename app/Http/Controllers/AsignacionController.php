<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use App\Models\Sistema;
use Illuminate\Http\Request;

class AsignacionController extends Controller
{
    public $validacion = [];

    public $mensajes = [];

    public function index(Request $request)
    {
        $asignacions = Asignacion::all();
        return response()->JSON(['asignacions' => $asignacions, 'total' => count($asignacions)], 200);
    }

    public function store(Request $request)
    {
        $existe_asignacion = Asignacion::where("funcionario_id", $request->funcionario_id)
            ->where("sistema_id", $request->sistema_id)->get()->first();

        $acceso = false;
        if (!$existe_asignacion) {
            $existe_asignacion = Asignacion::create(["funcionario_id" => $request->funcionario_id, "sistema_id" => $request->sistema_id, "fecha_registro" => date("Y-m-d")]);
        }
        $existe_asignacion_perfil = $existe_asignacion->asignacion_detalles()->where("perfil_id", $request->perfil_id)->get()->first();
        if ($existe_asignacion_perfil) {
            $existe_asignacion_perfil->delete();
            $acceso = false;
        } else {
            $existe_asignacion->asignacion_detalles()->create([
                "perfil_id" => $request->perfil_id
            ]);
            $acceso = true;
        }

        return response()->JSON([
            'sw' => true,
            'asignacion' => $existe_asignacion,
            'acceso' => $acceso,
            'msj' => 'El registro se realizó de forma correcta',
        ], 200);
    }

    public function update(Request $request, Asignacion $asignacion)
    {
        $request->validate($this->validacion, $this->mensajes);
        $asignacion->update(array_map('mb_strtoupper', $request->all()));
        return response()->JSON([
            'sw' => true,
            'asignacion' => $asignacion,
            'msj' => 'El registro se actualizó de forma correcta'
        ], 200);
    }

    public function show(Asignacion $asignacion)
    {
        return response()->JSON($asignacion);
    }

    public function destroy(Asignacion $asignacion)
    {
        $asignacion->delete();
        return response()->JSON([
            'sw' => true,
            'msj' => 'El registro se eliminó correctamente'
        ], 200);
    }

    public function getAsignacionFuncionario(Request $request)
    {
        $existe_asignacion = Asignacion::where("funcionario_id", $request->funcionario_id)
            ->where("sistema_id", $request->sistema_id)->get()->first();
        if ($existe_asignacion) {
            $existe_asignacion_perfil = $existe_asignacion->asignacion_detalles()->where("perfil_id", $request->perfil_id)->get()->first();
            if ($existe_asignacion_perfil) {
                return response()->JSON(true);
            }
        }
        return response()->JSON(false);
    }

    public function getEstadoAsignacion(Request $request)
    {
        $sistema = Sistema::find($request->sistema_id);

        $total_perfiles = count($sistema->perfiles);

        $asignaciones_funcionario = count(Asignacion::where("funcionario_id", $request->funcionario_id)
            ->join("asignacion_detalles", "asignacion_detalles.asignacion_id", "=", "asignacions.id")
            ->where("sistema_id", $request->sistema_id)->get());

        $array_perfiles = [];
        foreach ($sistema->perfiles as $perfil) {
            $existe_asignacion = Asignacion::where("funcionario_id", $request->funcionario_id)
                ->join("asignacion_detalles", "asignacion_detalles.asignacion_id", "=", "asignacions.id")
                ->where("sistema_id", $request->sistema_id)
                ->where("perfil_id", $perfil->perfil_id)->get()->first();
            if ($existe_asignacion) {
                $array_perfiles[] = [
                    "perfil" => $perfil->perfil,
                    "check" => true,
                ];
            } else {
                $array_perfiles[] = [
                    "perfil" => $perfil->perfil,
                    "check" => false,
                ];
            }
        }


        $estado = $total_perfiles == $asignaciones_funcionario ? 'CORRECTO' : 'PENDIENTE';
        return response()->JSON([
            "estado" => $estado,
            "total_perfiles" => $total_perfiles,
            "asignaciones_funcionario" => $asignaciones_funcionario,
            "array_perfiles" => $array_perfiles
        ]);
    }
}
