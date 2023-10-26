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
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->decimal('valor', 10, 2);
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('usuario_cadastrante_id');
            $table->foreign('usuario_cadastrante_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('usuario_modificante_id');
            $table->foreign('usuario_modificante_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');

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
        Schema::dropIfExists('contratos');
    }
};
