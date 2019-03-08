<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEscolaridadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escolaridades', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('membro_id');
            $table->string('nome_escola', 200);
            $table->tinyInteger('serie' );
            $table->enum('periodo', [ 'MANHA', 'TARDE', 'NOITE'] );
            $table->timestamps();

            $table->foreign('membro_id')->references('id')->on('membros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('escolaridades');
    }
}
