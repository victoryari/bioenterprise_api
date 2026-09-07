<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('comandos_dispositivos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dispositivo_id', 36);
            $table->enum('tipo_comando', ['ENVIAR_USUARIO', 'ENVIAR_TARJETA', 'ELIMINAR_USUARIO', 'REINICIAR', 'SINCRONIZAR_HORA', 'LIMPIAR_LOGS']);
            $table->text('carga_util')->nullable();
            $table->enum('estado', ['Pendiente', 'Transmitido', 'Ejecutado', 'Error'])->default('Pendiente');
            $table->timestamp('creado_en')->useCurrent();
            $table->dateTime('ejecutado_en')->nullable();

            $table->foreign('dispositivo_id')->references('id')->on('dispositivos')->onDelete('cascade')->onUpdate('cascade');
            $table->index('estado');
        });
    }
    public function down(): void {
        Schema::dropIfExists('comandos_dispositivos');
    }
};