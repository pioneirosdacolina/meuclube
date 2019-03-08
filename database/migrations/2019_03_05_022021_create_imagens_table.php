<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('caminhho', 191);
            $table->enum('servidor', [ "local", "ftp", "sftp", "s3", "rackspace" ])->default("local");
            $table->timestamps();
        });

        Schema::table('membros', function (Blueprint $table){
            $table->foreign('img_cpf_id')->references('id')->on('imagens');
            $table->foreign('img_rg_id')->references('id')->on('imagens');
            $table->foreign('img_certidao_id')->references('id')->on('imagens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagens');
    }
}
