<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerfilSistemasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfil_sistemas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("perfil_id");
            $table->unsignedBigInteger("sistema_id");
            $table->date("fecha_registro");
            $table->timestamps();
            $table->foreign("perfil_id")->on("perfils")->references("id");
            $table->foreign("sistema_id")->on("sistemas")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perfil_sistemas');
    }
}
