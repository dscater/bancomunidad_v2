<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $connection = 'mysql_dos';

    protected $fillable = [
        "ci",
        "nombre",
        "paterno",
        "materno",
        "cargo_id",
        "regional_id",
        "agencia_id",
        "fecha_registro",
        "usuario",
        "contrasenia",
        "tipo",
        "acceso",
    ];

    public $timestamps = false;
}
