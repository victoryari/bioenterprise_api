<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('historial_desactivaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('empleado_id', 36);
            $table->enum('accion', ['BAJA', 'REACTIVACION']);
            $table->string('motivo', 255)->nullable();
            $table->unsignedInteger('realizado_por')->nullable();
            $table->timestamp('creado_en')->useCurrent();

            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('realizado_por')->references('id')->on('usuarios')->onDelete('set null')->onUpdate('cascade');
        });
    }
    public function down(): void {
        Schema::dropIfExists('historial_desactivaciones');
    }
};