<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpcionSistemasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opcion_sistemas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("sistema_id");
            $table->string("nombre", 255);
            $table->timestamps();
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
        Schema::dropIfExists('opcion_sistemas');
    }
}
