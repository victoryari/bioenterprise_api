<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('sedes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 100)->unique()->comment('Nombre de la sede');
            $table->string('ciudad', 80)->comment('Ciudad');
            $table->string('direccion', 255)->nullable()->comment('Dirección física');
            $table->boolean('activo')->default(true);
            $table->timestamp('creado_en')->useCurrent();
            $table->timestamp('actualizado_en')->useCurrent()->useCurrentOnUpdate();
        });
    }
    public function down(): void {
        Schema::dropIfExists('sedes');
    }
};