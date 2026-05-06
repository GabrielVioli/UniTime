<?php

namespace Database\Seeders;

use App\Models\Turma;
use Illuminate\Database\Seeder;

class TurmaSeeder extends Seeder
{
    public function run(): void
    {
        $turmas = [
            'ADS — 1º Semestre',
            'ADS — 2º Semestre',
            'SI — 3º Semestre',
        ];

        foreach ($turmas as $turma) {
            Turma::updateOrCreate(
                ['nome' => $turma],
                ['nome' => $turma]
            );
        }
    }
}