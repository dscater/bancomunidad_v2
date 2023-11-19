<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfilSistema extends Model
{
    use HasFactory;

    protected $fillable = ["perfil_id", "sistema_id", "fecha_registro", "estado"];

    protected $with = ["perfil", "sistema"];

    protected $appends = ["estado_txt"];

    public function getEstadoTxtAttribute()
    {
        return $this->estado == 1 ? 'HABILITADO' : 'DESHABILITADO';
    }

    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'perfil_id');
    }

    public function sistema()
    {
        return $this->belongsTo(Sistema::class, 'sistema_id');
    }
}
