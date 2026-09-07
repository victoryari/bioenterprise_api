<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('solicitudes_permisos', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('empleado_id', 36)->nullable();
            $table->string('nombre_empleado', 200);
            $table->enum('tipo', ['Vacaciones', 'Descanso Médico', 'Permiso', 'Compensación']);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->text('motivo');
            $table->string('nombre_documento', 255)->nullable();
            $table->string('ruta_documento', 255)->nullable();
            $table->enum('estado', ['Aprobado', 'Pendiente', 'Rechazado'])->default('Pendiente');
            $table->unsignedInteger('revisado_por')->nullable();
            $table->text('notas_revision')->nullable();
            $table->date('fecha_solicitud');
            $table->timestamp('creado_en')->useCurrent();
            $table->timestamp('actualizado_en')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('revisado_por')->references('id')->on('usuarios')->onDelete('set null')->onUpdate('cascade');

            $table->index('estado');
            $table->index(['fecha_inicio', 'fecha_fin']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('solicitudes_permisos');
    }
};