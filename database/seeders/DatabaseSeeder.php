<?php

namespace Database\Seeders;

use App\Models\Aula;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::where('email', 'admin@unitimes.com')->delete();

        $this->call([
            TurmaSeeder::class,
        ]);

        $turmaPadrao = Turma::where('nome', '1º Período')
            ->whereHas('curso', fn ($query) => $query->where('nome', 'Análise e Desenvolvimento de Sistemas'))
            ->first();

        User::where('is_admin', false)
            ->whereNull('turma_id')
            ->update(['turma_id' => $turmaPadrao?->id]);

        User::factory()->admin()->create();
    }
}
