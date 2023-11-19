<?php

namespace App\Http\Controllers;

use App\Models\Alerta;
use App\Models\Cliente;
use App\Models\MaestroRegistro;
use App\Models\Nota;
use App\Models\Notificacion;
use App\Models\SeguimientoAprobado;
use App\Models\SeguimientoRectificacion;
use App\Models\SeguimientoTramite;
use App\Models\Tcont;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public $permisos = [
        'TI' => [
            'funcionarios.index',
            'funcionarios.create',
            'funcionarios.edit',
            'funcionarios.destroy',

            'agencias.index',
            'agencias.create',
            'agencias.edit',
            'agencias.destroy',

            'regionals.index',
            'regionals.create',
            'regionals.edit',
            'regionals.destroy',

            'cargos.index',
            'cargos.create',
            'cargos.edit',
            'cargos.destroy',

            'sistemas.index',
            'sistemas.create',
            'sistemas.edit',
            'sistemas.destroy',

            'perfil_sistemas.index',
            'perfil_sistemas.create',
            'perfil_sistemas.edit',
            'perfil_sistemas.destroy',

            'asignacions.index',
            'asignacions.create',
            'asignacions.edit',
            'asignacions.destroy',
        ],
        'SEGURIDAD DE LA INFORMACIÓN' => [
            'controls.index',

            'reportes.funcionario_sistemas',
        ],
        'SISTEMAS' => [
            'acceso_sistemas.index',
            'acceso_sistemas.create',
            'acceso_sistemas.edit',
            'acceso_sistemas.destroy',
        ],
        'ANALISTA DE SEGURIDAD' => [
            'formularios.index',
            'formularios.create',
            'formularios.edit',
            'formularios.destroy',
        ]
    ];

    public function getPermisos(User $usuario)
    {
        $tipo = $usuario->tipo;
        return response()->JSON($this->permisos[$tipo]);
    }
}
