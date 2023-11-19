<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    use HasFactory;

    protected $fillable = ["funcionario_id", "sistema_id", "fecha_registro",];

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'funcionario_id');
    }

    public function sistema()
    {
        return $this->belongsTo(Sistema::class, 'sistema_id');
    }

    public function asignacion_detalles()
    {
        return $this->hasMany(AsignacionDetalle::class, 'asignacion_id');
    }
}
