<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    use HasFactory;

    protected $fillable = [
        "codigo", "fecha_solicitud", "fecha_respuesta", "hora_solicitud", "hora_respuesta", "funcionario_id",
        "tipo_acceso", "cargo_id", "agencia_origen", "agencia_destino", "fecha_registro",
    ];

    protected $with = ["cargo", "funcionario", "origen", "destino"];

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'funcionario_id');
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'cargo_id');
    }

    public function origen()
    {
        return $this->belongsTo(Agencia::class, 'agencia_origen');
    }

    public function destino()
    {
        return $this->belongsTo(Agencia::class, 'agencia_destino');
    }

    public static function ultimoCodigo()
    {
        $codigo = 1;
        $ultimo = Formulario::get()->last();
        if ($ultimo) {
            $codigo = (int)$ultimo->codigo + 1;
        }
        return $codigo;
    }
}
