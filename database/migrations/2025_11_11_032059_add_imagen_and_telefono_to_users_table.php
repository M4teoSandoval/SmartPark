<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('imagen')->nullable()->after('email'); // ruta de la foto de perfil
            $table->string('telefono')->nullable()->after('imagen'); // número de teléfono
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['imagen', 'telefono']);
        });
    }
};
