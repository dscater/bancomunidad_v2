<?php

namespace App\Http\Controllers;

use App\Models\OpcionSistema;
use App\Models\PerfilSistema;
use App\Models\Sistema;
use Illuminate\Http\Request;

class SistemaController extends Controller
{
    public $validacion = [
        "nombre" => "required",
        "objetivo" => "required",
        "version" => "required",
        "tipo" => "required",
        "fecha_produccion" => "required|date",
        "empresa_proveedora" => "nullable",
    ];

    public $mensajes = [];

    public function index(Request $request)
    {
        $sistemas = Sistema::with("opciones")->get();
        if (isset($request->habilitados)) {
            $sistemas = Sistema::with("opciones")->where("estado", 1)->get();
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
            $sistemas = Sistema::where("estado", $estado)->get();
        }
        return response()->JSON(['sistemas' => $sistemas, 'total' => count($sistemas)], 200);
    }

    public function store(Request $request)
    {
        $request->validate($this->validacion, $this->mensajes);
        $request["fecha_registro"] = date("Y-m-d");
        $sistema = Sistema::create(array_map('mb_strtoupper', $request->except("opciones_id", "opciones_nombre")));

        $opciones_id = $request->opciones_id;
        $opciones_nombre = $request->opciones_nombre;

        if (isset($opciones_nombre) && count($opciones_nombre) > 0) {
            for ($i = 0; $i < count($opciones_nombre); $i++) {
                $sistema->opciones()->create([
                    "nombre" => $opciones_nombre[$i]
                ]);
            }
        }

        return response()->JSON([
            'sw' => true,
            'sistema' => $sistema,
            'msj' => 'El registro se realizó de forma correcta',
        ], 200);
    }

    public function update(Request $request, Sistema $sistema)
    {
        $request->validate($this->validacion, $this->mensajes);
        $sistema->update(array_map('mb_strtoupper', $request->except("opciones_id", "opciones_nombre", "eliminados")));

        $opciones_id = $request->opciones_id;
        $opciones_nombre = $request->opciones_nombre;
        $eliminados = $request->eliminados;

        if (isset($opciones_nombre) && count($opciones_nombre) > 0) {
            for ($i = 0; $i < count($opciones_nombre); $i++) {
                if ($opciones_id[$i] != 0) {
                    OpcionSistema::find($opciones_id[$i])->update([
                        "nombre" => $opciones_nombre[$i]
                    ]);
                } else {
                    $sistema->opciones()->create([
                        "nombre" => $opciones_nombre[$i]
                    ]);
                }
            }
        }
        if (isset($eliminados) && count($eliminados) > 0) {
            for ($i = 0; $i < count($eliminados); $i++) {
                $opcion_sistema = OpcionSistema::find($eliminados[$i]);
                if ($opcion_sistema) {
                    $opcion_sistema->delete();
                }
            }
        }

        return response()->JSON([
            'sw' => true,
            'sistema' => $sistema,
            'msj' => 'El registro se actualizó de forma correcta'
        ], 200);
    }

    public function show(Sistema $sistema)
    {
        return response()->JSON($sistema);
    }

    public function destroy(Sistema $sistema)
    {
        // $sistema->perfiles()->delete();
        // $sistema->opciones()->delete();
        $sistema->estado = 0;
        $sistema->save();
        return response()->JSON([
            'sw' => true,
            'msj' => 'El registro se eliminó correctamente'
        ], 200);
    }

    public function habilitar(Sistema $sistema)
    {
        $sistema->estado = 1;
        $sistema->save();
        return response()->JSON([
            'sw' => true,
            'msj' => 'El registro se habilitó correctamente'
        ], 200);
    }

    public function getPerfiles(Sistema $sistema)
    {
        $perfiles = PerfilSistema::where("sistema_id", $sistema->id)->where("estado", 1)->get();
        return response()->JSON($perfiles);
    }

    public function getOpcionesSistema(Sistema $sistema)
    {
        $opciones = OpcionSistema::where("sistema_id", $sistema->id)->get();
        return response()->JSON($opciones);
    }
}
