<?php

namespace Database\Factories;

use App\Models\Aula;
use App\Models\Turma;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Aula>
 */
class AulaFactory extends Factory
{
    protected $model = Aula::class;

    public const ADS_DISCIPLINAS = [
        '2º Período' => [
            ['nome' => 'Arquitetura de Computadores', 'professor' => 'AMANDA CAROLYNE DE LIMA'],
            ['nome' => 'Banco de Dados', 'professor' => 'ANTONIO MARCOS ZAMPIER'],
            ['nome' => 'Cultura e Sociedade', 'professor' => 'PAULINO FRANCISCO LORENZO JUNIOR'],
            ['nome' => 'Linguagem de Programação para a Web', 'professor' => 'AMANDA CAROLYNE DE LIMA'],
            ['nome' => 'Redes de Computadores', 'professor' => 'ANTONIO MARCOS ZAMPIER'],
            ['nome' => 'Sistemas Operacionais', 'professor' => 'AMANDA CAROLYNE DE LIMA'],
        ],
        '3º Período' => [
            ['nome' => 'Engenharia de Software', 'professor' => 'ANTONIO MARCOS ZAMPIER'],
            ['nome' => 'Estatística', 'professor' => 'JEFFERSON AMARAL MUNHOZ'],
            ['nome' => 'Estrutura de Dados', 'professor' => 'CLAUDINEI JOSÉ MACHADO'],
            ['nome' => 'Ética e Cidadania', 'professor' => 'PAULINO FRANCISCO LORENZO JUNIOR'],
            ['nome' => 'Interação Humano-Computador', 'professor' => 'AMANDA CAROLYNE DE LIMA'],
            ['nome' => 'Linguagem de Programação Orientada a Objetos', 'professor' => 'MATHEUS HENRIQUE SOUTO'],
        ],
    ];

    public function definition(): array
    {
        return [
            'nome' => fake()->words(3, true),
            'professor' => 'Prof. '.fake()->firstName(),
            'dia_semana' => fake()->randomElement(['segunda', 'terca', 'quarta', 'quinta', 'sexta']),
            'horario_inicio' => fake()->randomElement(['19:00', '20:50']),
            'horario_fim' => fake()->randomElement(['20:40', '22:30']),
            'sala' => 'A definir',
            'carga_horaria' => 80,
            'limite_faltas' => 20,
            'turma_id' => Turma::factory(),
        ];
    }
}
