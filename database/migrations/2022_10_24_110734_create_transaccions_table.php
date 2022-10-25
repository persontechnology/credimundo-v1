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
        Schema::create('transaccions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('numero');
            $table->decimal('valor_efectivo',19,2);
            $table->decimal('valor_cheque',19,2)->default(0);
            $table->decimal('valor_disponible',19,2)->default(0);
            $table->enum('estado',['ACTIVO','ANULAR']);
            $table->string('detalle')->nullable();
            $table->foreignId('cuenta_user_id')->constrained('cuenta_users');
            $table->foreignId('tipo_transaccion_id')->constrained('tipo_transaccions');
            
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
        Schema::dropIfExists('transaccions');
    }
};
