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
            $table->id();
            $table->string('nome');
            $table->string('nome_social');
            $table->string('razao_social');
            $table->integer('cnpj');
            $table->integer('telefone');
            $table->string('email');
            $table->enum('status', ['A','I']);
            $table->timestamps();
            $table->unsignedBigInteger('usuario_cadastrante_id');
            $table->foreign('usuario_cadastrante_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('usuario_modificante_id');
            $table->foreign('usuario_modificante_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
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
