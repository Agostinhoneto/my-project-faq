<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->integer('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('nome');
            $table->string('nome_social');
            $table->string('razao_social');           
            $table->string('endereco');
            $table->integer('cnpj');
            $table->string('telefone');
            $table->string('email');
            $table->timestamps();          
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
        Schema::dropIfExists('empresas');
    }
};
