<?php

use App\Http\Controllers\AccesoSistemaController;
use App\Http\Controllers\AgenciaController;
use App\Http\Controllers\AsignacionController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\ControlController;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PerfilSistemaController;
use App\Http\Controllers\RegionalController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\SistemaController;
use App\Http\Controllers\UserController;
use App\Models\PerfilSistema;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// LOGIN
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::prefix('admin')->group(function () {

    Route::get('usuarios/getPermisos/{usuario}', [UserController::class, 'getPermisos']);

    // FUNCIONARIOS
    Route::resource('funcionarios', FuncionarioController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);

    // AGENCIAS
    Route::resource('agencias', AgenciaController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);

    // REGIONAL
    Route::resource('regionals', RegionalController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);

    // CARGOS
    Route::resource('cargos', CargoController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);

    // SISTEMAS
    
    Route::get('sistemas/getOpcionesSistema/{sistema}', [SistemaController::class, "getOpcionesSistema"]);
    Route::get('sistemas/getPerfiles/{sistema}', [SistemaController::class, "getPerfiles"]);
    Route::resource('sistemas', SistemaController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);

    // PERFIL

    Route::resource('perfils', PerfilController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);

    // PERFIL SISTEMAS
    Route::resource('perfil_sistemas', PerfilSistemaController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);

    // ASIGNACIONS
    Route::get('asignacions/getAsignacionFuncionario', [AsignacionController::class, "getAsignacionFuncionario"]);
    Route::get('asignacions/getEstadoAsignacion', [AsignacionController::class, "getEstadoAsignacion"]);
    Route::resource('asignacions', AsignacionController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);

    // CONTROL
    Route::resource('controls', ControlController::class)->only([
        'index'
    ]);

    // ACCESO SISTEMA
    Route::get('acceso_sistemas/getAccesoSistema', [AccesoSistemaController::class, "getAccesoSistema"]);
    Route::resource('acceso_sistemas', AccesoSistemaController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);

    // FORMULARIOS
    Route::post('formularios/excel', [FormularioController::class, "excel"]);
    Route::resource('formularios', FormularioController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);

    // REPORTES
    Route::post('reportes/funcionario_sistemas', [ReporteController::class, 'funcionario_sistemas']);
});

// ---------------------------------------
Route::get('/{optional?}', function () {
    return view('app');
})->name('base_path')->where('optional', '.*');
