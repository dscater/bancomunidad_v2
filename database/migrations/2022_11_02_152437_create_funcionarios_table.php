<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->string("ci");
            $table->string("nombre");
            $table->string("paterno");
            $table->string("materno");
            $table->unsignedBigInteger("cargo_id");
            $table->unsignedBigInteger("regional_id");
            $table->unsignedBigInteger("agencia_id");
            $table->date("fecha_registro");
            $table->timestamps();

            $table->foreign("cargo_id")->on("cargos")->references("id");
            $table->foreign("regional_id")->on("regionals")->references("id");
            $table->foreign("agencia_id")->on("agencias")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funcionarios');
    }
}
