<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignacionDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignacion_detalles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("asignacion_id");
            $table->unsignedBigInteger("perfil_id");
            $table->timestamps();

            $table->foreign("asignacion_id")->on("asignacions")->references("id");
            $table->foreign("perfil_id")->on("perfils")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asignacion_detalles');
    }
}
