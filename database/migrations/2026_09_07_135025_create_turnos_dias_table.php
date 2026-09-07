<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('turnos_dias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('turno_id', 30);
            $table->tinyInteger('dia_semana');
            $table->string('nombre_dia', 20);
            $table->string('horario_id', 30)->nullable();
            $table->boolean('es_laborable')->default(true);

            $table->foreign('turno_id')->references('id')->on('turnos')->onDelete('cascade');
            $table->foreign('horario_id')->references('id')->on('horarios')->onDelete('set null');
        });
    }
    public function down(): void {
        Schema::dropIfExists('turnos_dias');
    }
};