<?php

namespace Database\Seeders;

use App\Models\Aula;
use App\Models\Turma;
use Database\Factories\AulaFactory;
use Illuminate\Database\Seeder;

class AulaSeeder extends Seeder
{
    public function run(): void
    {
        $dias = ['segunda', 'terca', 'quarta', 'quinta', 'sexta', 'sabado'];
        $horarios = [
            ['19:00', '20:40'],
            ['21:00', '22:40'],
        ];

        $gradeTerceiroPeriodo = [
            ['nome' => 'Estrutura de Dados', 'professor' => 'CLAUDINEI JOSÉ MACHADO', 'dia_semana' => 'segunda', 'horario_inicio' => '19:00', 'horario_fim' => '20:40'],
            ['nome' => 'Linguagem de Programação Orientada a Objetos', 'professor' => 'MATHEUS HENRIQUE SOUTO', 'dia_semana' => 'segunda', 'horario_inicio' => '21:00', 'horario_fim' => '22:40'],
            ['nome' => 'Engenharia de Software', 'professor' => 'ANTONIO MARCOS ZAMPIER', 'dia_semana' => 'terca', 'horario_inicio' => '19:00', 'horario_fim' => '20:40'],
            ['nome' => 'Linguagem de Programação Orientada a Objetos', 'professor' => 'MATHEUS HENRIQUE SOUTO', 'dia_semana' => 'terca', 'horario_inicio' => '21:00', 'horario_fim' => '22:40'],
            ['nome' => 'Estrutura de Dados', 'professor' => 'CLAUDINEI JOSÉ MACHADO', 'dia_semana' => 'quarta', 'horario_inicio' => '19:00', 'horario_fim' => '20:40'],
            ['nome' => 'Engenharia de Software', 'professor' => 'ANTONIO MARCOS ZAMPIER', 'dia_semana' => 'quarta', 'horario_inicio' => '21:00', 'horario_fim' => '22:40'],
            ['nome' => 'Ética e Cidadania', 'professor' => 'PAULINO FRANCISCO LORENZO JUNIOR', 'dia_semana' => 'quinta', 'horario_inicio' => '19:00', 'horario_fim' => '20:40'],
            ['nome' => 'Interação Humano-Computador', 'professor' => 'AMANDA CAROLYNE DE LIMA', 'dia_semana' => 'quinta', 'horario_inicio' => '21:00', 'horario_fim' => '22:40'],
            ['nome' => 'Estatística', 'professor' => 'JEFFERSON AMARAL MUNHOZ', 'dia_semana' => 'sexta', 'horario_inicio' => '19:00', 'horario_fim' => '20:40'],
            ['nome' => 'Estatística', 'professor' => 'JEFFERSON AMARAL MUNHOZ', 'dia_semana' => 'sexta', 'horario_inicio' => '21:00', 'horario_fim' => '22:40'],
        ];

        foreach (AulaFactory::ADS_DISCIPLINAS as $periodo => $disciplinas) {
            if ($periodo === '3º Período') {
                $disciplinas = $gradeTerceiroPeriodo;
            }

            $turma = Turma::where('nome', $periodo)
                ->whereHas('curso', fn ($query) => $query->where('nome', 'Análise e Desenvolvimento de Sistemas'))
                ->first();

            if (! $turma) {
                continue;
            }

            Aula::where('turma_id', $turma->id)
                ->whereIn('nome', collect($disciplinas)->pluck('nome')->unique()->all())
                ->delete();

            foreach ($disciplinas as $index => $disciplina) {
                [$horarioInicio, $horarioFim] = [
                    $disciplina['horario_inicio'] ?? $horarios[$index % count($horarios)][0],
                    $disciplina['horario_fim'] ?? $horarios[$index % count($horarios)][1],
                ];

                $dados = [
                    'nome' => $disciplina['nome'],
                    'professor' => $disciplina['professor'],
                    'dia_semana' => $disciplina['dia_semana'] ?? $dias[$index],
                    'horario_inicio' => $horarioInicio,
                    'horario_fim' => $horarioFim,
                    'sala' => $disciplina['sala'] ?? 'SALA 04 - VESTIBULAR',
                    'carga_horaria' => 80,
                    'limite_faltas' => 20,
                    'turma_id' => $turma->id,
                ];

                Aula::factory()->create($dados);
            }
        }
    }
}
