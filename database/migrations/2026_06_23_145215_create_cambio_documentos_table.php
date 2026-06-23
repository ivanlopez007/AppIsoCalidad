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
        Schema::create('cambio_documentos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_documento');
            $table->foreignId('usuario_id')->constrained('usuarios');
            $table->foreignId('nivel_id')->constrained('nivels');
            $table->foreignId('sub_nivel_id')->constrained('sub_nivels');
            $table->string('url_documento');
            $table->integer('version');
            $table->foreignId('aprobar_id')->constrained('usuarios');
            $table->foreignId('localidad_id')->constrained('localidads');
            $table->foreignId('area_id')->constrained('areas');
            $table->foreignId('tipo_solicitud_id')->constrained('tipo_solicituds');
            $table->foreignId('lugar_retencion_id')->constrained('lugar_retencions');
            $table->foreignId('periodo_retencion_id')->constrained('periodo_retencions');
            $table->foreignId('disposicion_final_id')->constrained('disposicion_finals');
            $table->string('comentario')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cambio_documentos');
    }
};
