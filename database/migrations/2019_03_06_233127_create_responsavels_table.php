<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsavelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responsavels', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("membro_id")->nullable();
            $table->string('nome', 191 );
            $table->unsignedBigInteger( 'cpf');
            $table->unsignedInteger('img_cpf_id')->nullable();
            $table->string( 'rg');
            $table->unsignedInteger('img_rg_id')->nullable();

            $table->timestamps();

            $table->foreign( 'membro_id' )->references( 'id' )->on( 'membros' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('responsavels');
    }
}
