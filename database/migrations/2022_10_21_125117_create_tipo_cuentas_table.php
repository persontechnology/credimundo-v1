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
        Schema::create('tipo_cuentas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('codigo')->unique();
            $table->string('nombre')->unique();
            $table->decimal('valor_apertura',19,2);
            $table->decimal('valor_debito',19,2);
            $table->enum('estado',['ACTIVO','INACTIVO']);
            $table->string('descripcion')->nullable();
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
        Schema::dropIfExists('tipo_cuentas');
    }
};
