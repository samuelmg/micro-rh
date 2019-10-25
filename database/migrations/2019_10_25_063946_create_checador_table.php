<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChecadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checador', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('numero');
            $table->string('nombre');
            $table->dateTime('fecha_hora');
            $table->enum('registro', ['Entrada', 'Salida']);
            $table->string('dispositivo', 10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checador');
    }
}
