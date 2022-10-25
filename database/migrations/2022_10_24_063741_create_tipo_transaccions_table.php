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
        Schema::create('tipo_transaccions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('codigo')->unique();
            $table->string('nombre')->unique();
            $table->string('descripcion')->nullable();
            $table->enum('tipo',['INGRESO','SALIDA','DEBITO','ABONO']);
            $table->enum('estado',['ACTIVO','INACTIVO']);
            $table->bigInteger('creado_x');
            $table->bigInteger('actualizado_x')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_transaccions');
    }
};
