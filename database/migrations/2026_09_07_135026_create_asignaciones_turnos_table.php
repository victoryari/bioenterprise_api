<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('asignaciones_turnos', function (Blueprint $table) {
            $table->string('id', 30)->primary();
            $table->string('empleado_id', 36);
            $table->string('turno_id', 30);
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->timestamp('creado_en')->useCurrent();

            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade');
            $table->foreign('turno_id')->references('id')->on('turnos')->onDelete('cascade');
        });
    }
    public function down(): void {
        Schema::dropIfExists('asignaciones_turnos');
    }
};