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
        Schema::create('filial_empresas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresa_id')->nullable();
            $table->string('nome_fantasia');
            $table->string('cnpj');
            $table->string('telefone',11);
            $table->boolean('status')->default(1);
            $table->string('inscricao_estadual');
            $table->timestamps();
            $table->foreign('empresa_id')->references('id')->on('empresas');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filial_empresa');
    }
};
