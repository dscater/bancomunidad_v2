<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpcionSistema extends Model
{
    use HasFactory;

    protected $fillable = [
        "sistema_id",
        "nombre",
    ];
}
