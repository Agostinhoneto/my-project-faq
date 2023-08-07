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
        Schema::table('empresas', function($table){
            $table->unsignedBigInteger('tipo_empresa_id')->nullable();
            $table->unsignedBigInteger('natureza_empresa_id')->nullable();
            $table->unsignedBigInteger('inscricao_empresa_id')->nullable();

            $table->foreign('tipo_empresa_id')->references('id')->on('tipo_empresas');
            $table->foreign('natureza_empresa_id')->references('id')->on('natureza_empresas');
            $table->foreign('inscricao_empresa_id')->references('id')->on('inscricao_sociais');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
