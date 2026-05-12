<?php

namespace Tests\Feature;

use App\Models\Aula;
use App\Models\Curso;
use App\Models\Turma;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AulaSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_database_seeder_creates_ads_subjects_with_correct_teachers(): void
    {
        $this->seed(DatabaseSeeder::class);

        $curso = Curso::where('nome', 'Análise e Desenvolvimento de Sistemas')->firstOrFail();
        $segundoPeriodo = Turma::where('curso_id', $curso->id)->where('nome', '2º Período')->firstOrFail();
        $terceiroPeriodo = Turma::where('curso_id', $curso->id)->where('nome', '3º Período')->firstOrFail();

        $disciplinas = [
            $segundoPeriodo->id => [
                'Arquitetura de Computadores' => 'AMANDA CAROLYNE DE LIMA',
                'Banco de Dados' => 'ANTONIO MARCOS ZAMPIER',
                'Cultura e Sociedade' => 'PAULINO FRANCISCO LORENZO JUNIOR',
                'Linguagem de Programação para a Web' => 'AMANDA CAROLYNE DE LIMA',
                'Redes de Computadores' => 'ANTONIO MARCOS ZAMPIER',
                'Sistemas Operacionais' => 'AMANDA CAROLYNE DE LIMA',
            ],
            $terceiroPeriodo->id => [
                'Engenharia de Software' => 'ANTONIO MARCOS ZAMPIER',
                'Estatística' => 'JEFFERSON AMARAL MUNHOZ',
                'Estrutura de Dados' => 'CLAUDINEI JOSÉ MACHADO',
                'Ética e Cidadania' => 'PAULINO FRANCISCO LORENZO JUNIOR',
                'Interação Humano-Computador' => 'AMANDA CAROLYNE DE LIMA',
                'Linguagem de Programação Orientada a Objetos' => 'MATHEUS HENRIQUE SOUTO',
            ],
        ];

        foreach ($disciplinas as $turmaId => $aulas) {
            $totalEsperado = $turmaId === $terceiroPeriodo->id ? 10 : 6;

            $this->assertSame($totalEsperado, Aula::where('turma_id', $turmaId)->count());

            foreach ($aulas as $nome => $professor) {
                $this->assertDatabaseHas('aulas', [
                    'nome' => $nome,
                    'professor' => $professor,
                    'turma_id' => $turmaId,
                ]);
            }
        }

        $this->assertDatabaseHas('aulas', [
            'nome' => 'Engenharia de Software',
            'dia_semana' => 'quarta',
            'horario_inicio' => '21:00',
            'horario_fim' => '22:40',
            'sala' => 'SALA 04 - VESTIBULAR',
            'turma_id' => $terceiroPeriodo->id,
        ]);
    }
}
