<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aulas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('professor')->nullable();
            $table->string('dia_semana');
            $table->time('horario_inicio');
            $table->time('horario_fim');
            $table->string('sala');
            $table->integer('carga_horaria');
            $table->integer('limite_faltas');

            $table->foreignId('turma_id')
                ->constrained('turmas')
                ->cascadeOnDelete();

            $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aulas');
    }
};