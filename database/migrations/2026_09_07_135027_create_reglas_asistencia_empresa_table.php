<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('reglas_asistencia_empresa', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('minutos_gracia_ingreso')->default(10);
            $table->integer('tolerancia_maxima_minutos')->default(45);
            $table->decimal('sobretasa_he_primeras_dos', 5, 2)->default(25.00);
            $table->decimal('sobretasa_he_restantes', 5, 2)->default(35.00);
            $table->decimal('sobretasa_feriado_domingo', 5, 2)->default(100.00);
            $table->integer('dias_vacaciones_anuales')->default(30);
            $table->integer('minimo_dias_bloque_vacaciones')->default(7);
            $table->integer('minimo_dias_fraccionados')->default(1);
            $table->time('inicio_jornada_nocturna')->default('22:00:00');
            $table->time('fin_jornada_nocturna')->default('06:00:00');
            $table->decimal('sobretasa_nocturna', 5, 2)->default(35.00);
            $table->decimal('remuneracion_minima_vital', 10, 2)->default(1130.00);
            $table->decimal('piso_minimo_nocturno', 10, 2)->default(1525.50);
            $table->timestamp('actualizado_en')->useCurrent()->useCurrentOnUpdate();
        });
    }
    public function down(): void {
        Schema::dropIfExists('reglas_asistencia_empresa');
    }
};