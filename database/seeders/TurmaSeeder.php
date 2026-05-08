<?php

namespace Database\Seeders;

use App\Models\Curso;
use App\Models\Turma;
use Illuminate\Database\Seeder;

class TurmaSeeder extends Seeder
{
    public function run(): void
    {
        $cursos = [
            'Análise e Desenvolvimento de Sistemas' => 6,
            'Engenharia de Software' => 8,
            'Big Data no Agronegócio' => 5,
            'Administração' => 8,
            'Agronomia' => 10,
            'Direito' => 10,
            'Engenharia Civil' => 10,
            'Medicina' => 12,
            'Psicologia' => 10,
        ];

        foreach ($cursos as $nome => $periodos) {
            $curso = Curso::updateOrCreate(
                ['nome' => $nome],
                Curso::factory()->make(['nome' => $nome])->toArray()
            );

            for ($periodo = 1; $periodo <= $periodos; $periodo++) {
                $turma = [
                    'curso_id' => $curso->id,
                    'nome' => "{$periodo}º Período",
                ];

                Turma::updateOrCreate($turma, Turma::factory()->make($turma)->toArray());
            }
        }
    }
}
