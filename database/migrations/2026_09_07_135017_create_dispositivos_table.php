<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('dispositivos', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('numero_serie', 50)->unique();
            $table->string('nombre', 120);
            $table->string('ubicacion', 120);
            $table->unsignedInteger('sede_id')->nullable();
            $table->string('direccion_ip', 45);
            $table->unsignedInteger('puerto')->default(4370);
            $table->string('protocolo', 50)->default('Autónomo');
            $table->boolean('soporta_huella')->default(true);
            $table->boolean('soporta_tarjeta_rfid')->default(true);
            $table->boolean('soporta_pin')->default(true);
            $table->enum('estado', ['online', 'offline', 'error'])->default('online');
            $table->dateTime('ultimo_pulso')->nullable();
            $table->unsignedInteger('conteo_usuarios')->default(0);
            $table->unsignedInteger('conteo_registros')->default(0);
            $table->string('version_firmware', 80)->default('BioFirm v4.2.0');
            $table->timestamp('creado_en')->useCurrent();
            $table->timestamp('actualizado_en')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('sede_id')->references('id')->on('sedes')->onDelete('set null')->onUpdate('cascade');
            $table->index('numero_serie');
            $table->index('estado');
        });
    }
    public function down(): void {
        Schema::dropIfExists('dispositivos');
    }
};