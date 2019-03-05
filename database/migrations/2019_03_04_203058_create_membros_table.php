<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membros', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('codigo_sgc' )->nullable();
            $table->string('nome', 191 );
            $table->date('data_nascimento');
            $table->unsignedTinyInteger('idade' );
            $table->enum('sexo', [ 'M', 'F' ] );
            $table->string('unidade', 50);
            $table->enum('estado_civil', ['solteiro', 'casado', 'uniao_estavel', 'divorciado', 'viuvo', 'outros']);
            $table->unsignedBigInteger( 'cpf')->nullable();
            $table->unsignedInteger('img_cpf_id')->nullable();
            $table->string( 'rg')->nullable();
            $table->unsignedInteger('img_rg_id')->nullable();
            $table->string( 'certidao')->nullable();
            $table->unsignedInteger('img_certidao_id')->nullable();
            $table->unsignedInteger( 'user_create')->nullable();
            $table->unsignedInteger( 'user_id')->nullable();
            $table->timestamps();

             $table->foreign('user_create')->references('id')->on('users');
             $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membros');
    }
}
