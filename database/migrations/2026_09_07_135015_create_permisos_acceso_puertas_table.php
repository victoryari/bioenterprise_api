<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('permisos_acceso_puertas', function (Blueprint $table) {
            $table->string('empleado_id', 36)->primary();
            $table->boolean('entrada_principal')->default(true);
            $table->boolean('centro_datos')->default(false);
            $table->boolean('almacen')->default(false);
            $table->timestamp('actualizado_en')->useCurrent()->useCurrentOnUpdate();
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade')->onUpdate('cascade');
        });
    }
    public function down(): void {
        Schema::dropIfExists('permisos_acceso_puertas');
    }
};