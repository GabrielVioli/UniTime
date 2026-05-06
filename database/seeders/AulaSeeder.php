<?php

namespace Database\Seeders;

use App\Models\Aula;
use App\Models\Turma;
use Illuminate\Database\Seeder;

class AulaSeeder extends Seeder
{
    public function run(): void
    {
        $ads1 = Turma::where('nome', 'ADS — 1º Semestre')->first();
        $ads2 = Turma::where('nome', 'ADS — 2º Semestre')->first();
        $si3 = Turma::where('nome', 'SI — 3º Semestre')->first();

        $aulas = [
            [
                'nome' => 'Algoritmos e Programação',
                'professor' => 'Prof. Marcos',
                'dia_semana' => 'segunda',
                'horario_inicio' => '19:00:00',
                'horario_fim' => '20:40:00',
                'sala' => 'Bloco A - Sala 101',
                'carga_horaria' => 80,
                'limite_faltas' => 20,
                'turma_id' => $ads1->id,
            ],
            [
                'nome' => 'Introdução à Computação',
                'professor' => 'Prof. Ana',
                'dia_semana' => 'terça',
                'horario_inicio' => '19:00:00',
                'horario_fim' => '20:40:00',
                'sala' => 'Bloco A - Sala 102',
                'carga_horaria' => 60,
                'limite_faltas' => 15,
                'turma_id' => $ads1->id,
            ],
            [
                'nome' => 'Banco de Dados',
                'professor' => 'Prof. Carlos',
                'dia_semana' => 'quarta',
                'horario_inicio' => '20:50:00',
                'horario_fim' => '22:30:00',
                'sala' => 'Laboratório 2',
                'carga_horaria' => 80,
                'limite_faltas' => 20,
                'turma_id' => $ads2->id,
            ],
            [
                'nome' => 'Programação Web',
                'professor' => 'Prof. Juliana',
                'dia_semana' => 'quinta',
                'horario_inicio' => '19:00:00',
                'horario_fim' => '22:30:00',
                'sala' => 'Laboratório 1',
                'carga_horaria' => 80,
                'limite_faltas' => 20,
                'turma_id' => $ads2->id,
            ],
            [
                'nome' => 'Engenharia de Software',
                'professor' => 'Prof. Renato',
                'dia_semana' => 'segunda',
                'horario_inicio' => '19:00:00',
                'horario_fim' => '22:30:00',
                'sala' => 'Bloco B - Sala 203',
                'carga_horaria' => 80,
                'limite_faltas' => 20,
                'turma_id' => $si3->id,
            ],
            [
                'nome' => 'Estrutura de Dados',
                'professor' => 'Prof. Fernanda',
                'dia_semana' => 'sexta',
                'horario_inicio' => '20:50:00',
                'horario_fim' => '22:30:00',
                'sala' => 'Laboratório 3',
                'carga_horaria' => 80,
                'limite_faltas' => 20,
                'turma_id' => $si3->id,
            ],
        ];

        foreach ($aulas as $aula) {
            Aula::updateOrCreate(
                [
                    'nome' => $aula['nome'],
                    'turma_id' => $aula['turma_id'],
                    'dia_semana' => $aula['dia_semana'],
                ],
                $aula
            );
        }
    }
}