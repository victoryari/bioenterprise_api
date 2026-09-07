<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('marcaciones_asistencia', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->date('fecha');
            $table->time('hora');
            $table->dateTime('fecha_hora');
            $table->string('empleado_id', 36)->nullable();
            $table->string('nombre_empleado', 200)->default('Desconocido');
            $table->string('pin', 20)->default('----');
            $table->string('numero_tarjeta', 30)->nullable();
            $table->string('dispositivo_id', 36)->nullable();
            $table->string('nombre_dispositivo', 120);
            $table->enum('tipo', ['Entrada', 'Salida', 'Refrigerio Inicio', 'Refrigerio Fin'])->default('Entrada');
            $table->enum('estado', ['Escaneo exitoso', 'Tiempo de espera agotado', 'Sincronización', 'No reconocido'])->default('Escaneo exitoso');
            $table->enum('metodo_verificacion', ['Huella', 'Tarjeta RFID', 'PIN', 'Rostro', 'Sistema'])->default('Huella');
            $table->boolean('es_error')->default(false);
            $table->text('trama_cruda')->nullable();
            $table->timestamp('creado_en')->useCurrent();

            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('dispositivo_id')->references('id')->on('dispositivos')->onDelete('set null')->onUpdate('cascade');

            $table->index('fecha_hora');
            $table->index('fecha');
            $table->index('empleado_id');
            $table->index('pin');
            $table->index('numero_tarjeta');
            $table->index('metodo_verificacion');
        });
    }
    public function down(): void {
        Schema::dropIfExists('marcaciones_asistencia');
    }
};