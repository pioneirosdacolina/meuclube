<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsavelMembrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responsavel_membros', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("membro_id");
            $table->unsignedInteger("responsavel_id");
            $table->string("parentesco");

            $table->timestamps();

            $table->foreign( 'membro_id' )->references( 'id' )->on( 'membros' );
            $table->foreign( 'responsavel_id' )->references( 'id' )->on( 'responsavels' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('responsavel_membros');
    }
}
