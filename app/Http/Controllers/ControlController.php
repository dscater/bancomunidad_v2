<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControlController extends Controller
{

    public function index(Request $request)
    {
        $funcionarios = Funcionario::all();
        return response()->JSON(['funcionarios' => $funcionarios, 'total' => count($funcionarios)], 200);
    }

    public function acceso(){
        
    }
}
