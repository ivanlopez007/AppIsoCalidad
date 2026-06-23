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
        Schema::create('periodo_retencions', function (Blueprint $table) {
            $table->id();
            $table->integer('tiempo'); //ejemplo 1, 2, 3, 4, 5
            $table->string('unidad_tiempo'); //ejemplo: dias, meses, años
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periodo_retencions');
    }
};
