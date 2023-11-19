<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sistema extends Model
{
    use HasFactory;

    protected $fillable = [
        "nombre", "objetivo", "version", "tipo",
        "fecha_produccion", "empresa_proveedora", "fecha_registro", "estado"
    ];

    protected $appends = ["estado_txt"];

    public function getEstadoTxtAttribute()
    {
        return $this->estado == 1 ? 'HABILITADO' : 'DESHABILITADO';
    }

    public function perfiles()
    {
        return $this->hasMany(PerfilSistema::class, 'sistema_id');
    }

    public function opciones()
    {
        return $this->hasMany(OpcionSistema::class, 'sistema_id');
    }
}
