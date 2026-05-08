<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->unique();
            $table->timestamps();
        });

        Schema::table('turmas', function (Blueprint $table) {
            $table->foreignId('curso_id')
                ->nullable()
                ->after('id')
                ->constrained('cursos')
                ->nullOnDelete();
        });

        $cursoId = DB::table('cursos')->insertGetId([
            'nome' => 'Curso não informado',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('turmas')
            ->whereNull('curso_id')
            ->update(['curso_id' => $cursoId]);
    }

    public function down(): void
    {
        Schema::table('turmas', function (Blueprint $table) {
            $table->dropConstrainedForeignId('curso_id');
        });

        Schema::dropIfExists('cursos');
    }
};
