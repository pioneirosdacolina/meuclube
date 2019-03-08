<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('origem_id');
            $table->enum('origem', [ 'membro', 'responsavel' ] );
            $table->string('cep', 8 );
            $table->string('logradouro', 255);
            $table->string('numero', 10);
            $table->string('bairro', 150);
            $table->string('complemento', 50);
            $table->string('referencia', 50)->nullable();
            $table->string('localidade', 150);
            $table->string('uf', 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enderecos');
    }
}
