<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('vehiculo_id')
                ->constrained('vehiculos')
                ->onDelete('cascade');

            $table->foreignId('parqueadero_id')
                ->constrained('parqueaderos')
                ->onDelete('cascade');

            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->enum('tipo', ['entrada', 'salida']);
            $table->dateTime('fecha_hora');

            // ✅ nuevos campos para cobro
            $table->decimal('monto', 10, 2)->nullable();
            $table->string('metodo_pago')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('movimientos');
    }
};
