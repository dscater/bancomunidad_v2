<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formularios', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("codigo");
            $table->date("fecha_solicitud")->nullable();
            $table->date("fecha_respuesta")->nullable();
            $table->time("hora_solicitud")->nullable();
            $table->time("hora_respuesta")->nullable();
            $table->unsignedBigInteger("funcionario_id");
            $table->string("tipo_acceso", 255);
            $table->unsignedBigInteger("cargo_id")->nullable();
            $table->unsignedBigInteger("agencia_origen")->nullable();
            $table->unsignedBigInteger("agencia_destino")->nullable();
            $table->date("fecha_registro")->nullable();
            $table->timestamps();

            $table->foreign("funcionario_id")->on("funcionarios")->references("id");
            $table->foreign("cargo_id")->on("cargos")->references("id");
            $table->foreign("agencia_origen")->on("agencias")->references("id");
            $table->foreign("agencia_destino")->on("agencias")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formularios');
    }
}
