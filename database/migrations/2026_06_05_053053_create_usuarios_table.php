<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');

            // Llaves foráneas hacia las otras tablas
            $table->foreignId('rol_id')->constrained('rol');
            $table->foreignId('localidad_id')->constrained('localidad');
            $table->foreignId('area_id')->constrained('area');

            // Relación recursiva (jefe inmediato)
            $table->unsignedBigInteger('jefe_inmediato_id')->nullable();

            $table->foreign('jefe_inmediato_id')
                ->references('id')
                ->on('usuarios') // <-- Asegúrate de que tenga la "s" al final
                ->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
