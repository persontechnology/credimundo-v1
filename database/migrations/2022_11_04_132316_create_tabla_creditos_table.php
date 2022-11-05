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
        Schema::create('tabla_creditos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('numero');
            $table->date('fecha_pago');
            $table->decimal('monto_pago',19,2);
            $table->decimal('interes_total',19,2);
            $table->decimal('pagos_total',19,2);
            $table->decimal('saldo_capital',19,2);
            $table->decimal('total_pagar',19,2);
            $table->enum('estado',['PENDIENTE','CANCELADO','ATRASADO']);
            $table->foreignId('credito_id')->constrained('creditos');
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
        Schema::dropIfExists('tabla_creditos');
    }
};
