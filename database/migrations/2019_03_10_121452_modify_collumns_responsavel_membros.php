<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyCollumnsResponsavelMembros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('responsavel_membros', function (Blueprint $table) {
            $table->renameColumn( "membro_id", "membros_id" );
            $table->renameColumn( "responsavel_id", "responsavels_id" );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('responsavel_membros', function (Blueprint $table) {
            $table->renameColumn( "membros_id", "membro_id" );
            $table->renameColumn( "responsavels_id", "responsavel_id" );
        });
    }
}
