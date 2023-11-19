<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $fillable = [
        "ci", "nombre", "paterno", "materno", "cargo_id",
        "regional_id", "agencia_id", "fecha_registro", "estado"
    ];

    protected $with = ["cargo", "regional", "agencia"];

    protected $appends = ["full_name"];

    public function getFullNameAttribute()
    {
        return $this->nombre . ' ' . $this->paterno . ' ' . $this->materno;
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'cargo_id');
    }

    public function regional()
    {
        return $this->belongsTo(Regional::class, 'regional_id');
    }

    public function agencia()
    {
        return $this->belongsTo(Agencia::class, 'agencia_id');
    }

    public function asignacions()
    {
        return $this->hasMany(Asignacion::class, 'funcionario_id');
    }

    public function formularios()
    {
        return $this->hasMany(Formulario::class, 'funcionario_id');
    }

    public function acceso_sistemas()
    {
        return $this->hasMany(AccesoSistema::class, 'funcionario_id');
    }
}
