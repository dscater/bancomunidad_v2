<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccesoSistemasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acceso_sistemas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("funcionario_id");
            $table->unsignedBigInteger("sistema_id");
            $table->timestamps();

            $table->foreign("funcionario_id")->on("funcionarios")->references("id");
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
        Schema::dropIfExists('acceso_sistemas');
    }
}
