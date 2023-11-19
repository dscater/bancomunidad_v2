<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignacions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("funcionario_id");
            $table->unsignedBigInteger("sistema_id");
            $table->date("fecha_registro");
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
        Schema::dropIfExists('asignacions');
    }
}
