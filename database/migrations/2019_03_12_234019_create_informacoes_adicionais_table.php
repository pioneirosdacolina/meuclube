<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformacoesAdicionaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informacoes_adicionais', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger( "membros_id");
            $table->enum("camiseta",
                [ 'GI', 'PPA', 'PA', 'MA', 'GA', 'GGA', '3G', '4G' ] );
            $table->enum("batizado", [ 'SIM', 'NAO' ] );
            $table->string( "religiao" );
            $table->enum("outro_clube", [ 'SIM', 'NAO' ] );
            $table->string( "nome_clube" );

            $table->timestamps();

            $table->foreign( "membros_id")
                ->references("id")->on("membros");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('informacoes_adicionais');
    }
}
