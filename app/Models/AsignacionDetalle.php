<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignacionDetalle extends Model
{
    use HasFactory;

    protected $fillable = ["asignacion_id", "perfil_id"];

    public function asignacion()
    {
        return $this->belongsTo(Asignacion::class, 'asignacion_id');
    }

    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'perfil_id');
    }
}
