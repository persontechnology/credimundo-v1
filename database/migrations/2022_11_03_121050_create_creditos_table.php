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
        Schema::create('creditos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            
            $table->string('numero')->unique();
            $table->decimal('monto',19,2);
            $table->date('dia_pago')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->decimal('tasa_efectiva_anual',7,2)->nullable();
            $table->decimal('tasa_nominal',7,2);
            $table->integer('numero_cuotas')->nullable();
            $table->string('plazo');
            $table->decimal('pago_mensual',19,2);
            $table->decimal('pagos_totales',19,2);
            $table->decimal('interes_totales',19,2);
            $table->enum('estado',['INGRESADO','ENTREGADO','CANCELADO','ANULADO']);
            $table->decimal('ahorro_programado');
            $table->decimal('total_ahorro_programado');
            $table->string('detalle')->nullable();
            $table->string('actividad')->nullable();
            $table->foreignId('tipo_credito_id')->constrained('tipo_creditos');
            $table->foreignId('cuenta_user_id')->constrained('cuenta_users');
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
        Schema::dropIfExists('creditos');
    }
};
