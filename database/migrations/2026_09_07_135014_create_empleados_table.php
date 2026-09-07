<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('empleados', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->enum('tipo_documento', ['DNI', 'CE', 'Pasaporte'])->default('DNI');
            $table->string('numero_documento', 15)->unique();
            $table->string('pin', 20)->unique();
            $table->string('numero_tarjeta', 30)->nullable()->unique();
            $table->boolean('tarjeta_rfid')->default(false);
            $table->boolean('biometria_huella')->default(false);
            $table->boolean('biometria_rostro')->default(false);
            $table->enum('tipo_marcado_predilecto', ['Huella', 'Tarjeta RFID', 'PIN', 'Rostro'])->default('Huella');
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->string('nombre_completo', 200);
            $table->string('correo', 150)->unique();
            $table->string('telefono', 30)->nullable();
            $table->string('direccion', 255)->nullable();
            $table->string('cargo', 100);
            $table->unsignedInteger('departamento_id');
            $table->unsignedInteger('sede_id');
            $table->string('empresa', 100)->nullable();
            $table->enum('estado', ['Activo', 'Inactivo'])->default('Activo');
            $table->text('foto_url')->nullable();
            $table->unsignedTinyInteger('conteo_huellas')->default(0);
            $table->string('fecha_actualizacion_rostro', 50)->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->date('fecha_cese')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->decimal('sueldo_base', 10, 2)->default(1025.00);
            $table->boolean('acceso_entrada_principal')->default(true);
            $table->boolean('acceso_centro_datos')->default(false);
            $table->boolean('acceso_almacen')->default(false);
            $table->timestamp('creado_en')->useCurrent();
            $table->timestamp('actualizado_en')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('departamento_id')->references('id')->on('departamentos')->onUpdate('cascade');
            $table->foreign('sede_id')->references('id')->on('sedes')->onUpdate('cascade');

            $table->index('pin');
            $table->index('numero_tarjeta');
            $table->index('numero_documento');
            $table->index('estado');
        });
    }
    public function down(): void {
        Schema::dropIfExists('empleados');
    }
};