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
        Schema::create('certificados', function (Blueprint $table) {
            $table->id();
            $table->string('rut');
            $table->unsignedBigInteger('matricula_id');
            $table->foreign('matricula_id')->references('id')->on('matriculas');

            $table->string('nombre');
            $table->string('apellido');

            $table->string('codigo_curso');
            $table->foreignId('curso_id')->constrained('cursos');

            
            $table->date('fecha_start');
            $table->date('fecha_end');
            $table->string('certificado');
            $table->date('fecha_otorgado');

            $table->foreignId('venta_id')->constrained('ventas')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificados');
    }
};
