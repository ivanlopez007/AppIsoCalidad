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
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_documento');
            $table->string('url_documento')->nullable(); // Ruta del PDF en el storage
            $table->string('version')->default('1');
            $table->string('numero_iso')->nullable();

            // Relaciones / Claves Foráneas
            // (He usado 'usuarios' asumiendo el nombre de tu tabla de usuarios, cámbiala si es necesario)
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->foreignId('aprobar_id')->constrained('usuarios')->onDelete('cascade');

            $table->foreignId('nivel_id')->constrained('nivels')->onDelete('cascade');
            $table->foreignId('sub_nivel_id')->constrained('sub_nivels')->onDelete('cascade');
            $table->foreignId('localidad_id')->constrained('localidads')->onDelete('cascade');
            $table->foreignId('area_id')->constrained('areas')->onDelete('cascade');

            $table->foreignId('lugar_retencion_id')->constrained('lugar_retencions')->onDelete('cascade');
            $table->foreignId('periodo_retencion_id')->constrained('periodo_retencions')->onDelete('cascade');
            $table->foreignId('disposicion_final_id')->constrained('disposicion_finals')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
