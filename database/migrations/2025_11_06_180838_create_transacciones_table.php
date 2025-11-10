<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('transacciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users');
            $table->foreignId('parqueadero_id')->constrained('parqueaderos');
            $table->foreignId('vehiculo_id')->constrained('vehiculos');
            $table->foreignId('reserva_id')->nullable()->constrained('reservas')->nullOnDelete();
            $table->foreignId('mensualidad_id')->nullable()->constrained('mensualidades')->nullOnDelete();
            $table->string('tipo_transaccion');
            $table->decimal('valor', 10, 2);
            $table->string('metodo_pago');
            $table->dateTime('fecha');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transacciones');
    }
};
