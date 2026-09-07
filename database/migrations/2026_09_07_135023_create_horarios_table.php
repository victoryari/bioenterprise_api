<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('horarios', function (Blueprint $table) {
            $table->string('id', 30)->primary();
            $table->string('nombre', 100);
            $table->time('hora_entrada');
            $table->time('hora_salida');
            $table->integer('minutos_tolerancia')->default(10);
            $table->time('inicio_refrigerio')->nullable();
            $table->time('fin_refrigerio')->nullable();
            $table->integer('minutos_refrigerio')->default(60);
            $table->boolean('marcado_refrigerio_obligatorio')->default(false);
            $table->string('color_tag', 20)->default('#3B82F6');
            $table->timestamp('creado_en')->useCurrent();
            $table->timestamp('actualizado_en')->useCurrent()->useCurrentOnUpdate();
        });
    }
    public function down(): void {
        Schema::dropIfExists('horarios');
    }
};