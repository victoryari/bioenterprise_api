<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('dias_festivos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 150);
            $table->date('fecha_festivo')->unique();
            $table->boolean('es_recurrente')->default(true);
            $table->timestamp('creado_en')->useCurrent();
        });
    }
    public function down(): void {
        Schema::dropIfExists('dias_festivos');
    }
};