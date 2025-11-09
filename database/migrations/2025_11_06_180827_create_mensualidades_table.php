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
        Schema::create('mensualidades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('vehiculo_id')->constrained('vehiculos')->onDelete('cascade');
            $table->foreignId('parqueadero_id')->constrained('parqueaderos')->onDelete('cascade');

            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->string('estado');
            $table->decimal('valor', 10, 2);
            $table->string('metodo_pago')->nullable();  // ✅ NUEVO

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mensualidades');
    }
};
