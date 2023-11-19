<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccesoSistema extends Model
{
    use HasFactory;

    protected $fillable = ["funcionario_id", "sistema_id"];

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'funcionario_id');
    }

    public function sistema()
    {
        return $this->belongsTo(Sistema::class, 'sistema_id');
    }
}
