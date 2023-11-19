<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FuncionarioController extends Controller
{
    public $validacion = [
        "ci" => "required|unique:funcionarios,ci",
        "nombre" => "required",
        "paterno" => "required",
        "materno" => "required",
        "cargo_id" => "required",
        "regional_id" => "required",
        "agencia_id" => "required",
    ];

    public $mensajes = [];

    public function index(Request $request)
    {
        $filter_ci = $request->filter_ci;
        $filter_nombre = $request->filter_nombre;
        $filter_cargo = $request->filter_cargo;
        $filter_regional = $request->filter_regional;
        $filter_agencia = $request->filter_agencia;
        $filter_fecha = $request->filter_fecha;

        $funcionarios = Funcionario::orderBy("nombre", "asc");
        if (isset($filter_ci) &&  trim($filter_ci) != "") {
            $funcionarios->where("ci", "LIKE", "%$filter_ci%");
        }

        if (isset($filter_nombre) &&  trim($filter_nombre) != "") {
            $funcionarios->where(DB::raw('CONCAT(nombre, paterno, materno)'), 'LIKE', "%$filter_nombre%");
        }

        if (isset($filter_cargo) &&  trim($filter_cargo) != "") {
            $funcionarios->where("cargo_id", $filter_cargo);
        }

        if (isset($filter_regional) &&  trim($filter_regional) != "") {
            $funcionarios->where("regional_id", $filter_regional);
        }

        if (isset($filter_agencia) &&  trim($filter_agencia) != "") {
            $funcionarios->where("agencia_id", $filter_agencia);
        }

        if (isset($filter_fecha) &&  trim($filter_fecha) != "") {
            $funcionarios->where("fecha_registro", $filter_fecha);
        }

        $funcionarios = $funcionarios->get();

        return response()->JSON(['funcionarios' => $funcionarios, 'total' => count($funcionarios)], 200);
    }

    public function store(Request $request)
    {
        $request->validate($this->validacion, $this->mensajes);
        $request["fecha_registro"] = date("Y-m-d");
        $funcionario = Funcionario::create(array_map('mb_strtoupper', $request->all()));
        $request["tipo"] = 1;
        $request["acceso"] = 0;
        $request["usuario"] = $request->ci;
        $request["contrasenia"] = $request->nombre;
        Usuario::create(array_map('mb_strtoupper', $request->all()));

        return response()->JSON([
            'sw' => true,
            'funcionario' => $funcionario,
            'msj' => 'El registro se realizó de forma correcta',
        ], 200);
    }

    public function update(Request $request, Funcionario $funcionario)
    {
        $this->validacion["ci"] = "required|unique:funcionarios,ci," . $funcionario->id;
        $request->validate($this->validacion, $this->mensajes);
        $funcionario->update(array_map('mb_strtoupper', $request->all()));
        return response()->JSON([
            'sw' => true,
            'funcionario' => $funcionario,
            'msj' => 'El registro se actualizó de forma correcta'
        ], 200);
    }

    public function show(Funcionario $funcionario)
    {
        return response()->JSON($funcionario);
    }

    public function destroy(Funcionario $funcionario)
    {
        foreach($funcionario->asignacions as $value){
            $value->asignacion_detalles()->delete();
            $value->delete();
        }
        
        $funcionario->formularios()->delete();
        $funcionario->acceso_sistemas()->delete();
        $funcionario->delete();
        return response()->JSON([
            'sw' => true,
            'msj' => 'El registro se eliminó correctamente'
        ], 200);
    }
}
