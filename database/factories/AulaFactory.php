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

    public function definition(): array
    {
        return [
            'nome' => fake()->words(3, true),
            'professor' => 'Prof. '.fake()->firstName(),
            'dia_semana' => fake()->randomElement(['segunda', 'terca', 'quarta', 'quinta', 'sexta']),
            'horario_inicio' => fake()->randomElement(['19:00', '20:50']),
            'horario_fim' => fake()->randomElement(['20:40', '22:30']),
            'sala' => 'A definir',
            'carga_horaria' => 60,
            'limite_faltas' => 15,
            'turma_id' => Turma::factory(),
        ];
    }
}
