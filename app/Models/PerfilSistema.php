<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfilSistema extends Model
{
    use HasFactory;

    protected $fillable = ["perfil_id", "sistema_id", "fecha_registro"];

    protected $with = ["perfil", "sistema"];

    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'perfil_id');
    }

    public function sistema()
    {
        return $this->belongsTo(Sistema::class, 'sistema_id');
    }
}
