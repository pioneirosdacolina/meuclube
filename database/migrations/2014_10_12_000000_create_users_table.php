<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role',
                [
                    'visitante',
                    'administrador',
                    'diretor',
                    'diretor_assoc',
                    'secretaria',
                    'tesoureiro',
                    'anciao',
                    'instrutor',
                    'conselheiro',
                    'desbravador',
                    'responsavel'
                ] )->default('visitante');
            $table->mediumText('bio')->nullable();
            $table->string('photo')->default('profile.png');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
