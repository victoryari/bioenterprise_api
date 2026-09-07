<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('empleado_id', 36)->nullable();
            $table->string('nombre', 150);
            $table->string('correo', 150)->unique();
            $table->string('clave_hash', 255);
            $table->enum('rol', ['admin', 'empleado', 'gerente_rrhh', 'supervisor'])->default('empleado');
            $table->enum('estado', ['Activo', 'Inactivo'])->default('Activo');
            $table->string('token_recordar', 100)->nullable();
            $table->dateTime('ultimo_login')->nullable();
            $table->timestamp('creado_en')->useCurrent();
            $table->timestamp('actualizado_en')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('set null')->onUpdate('cascade');
        });
    }
    public function down(): void {
        Schema::dropIfExists('usuarios');
    }
};