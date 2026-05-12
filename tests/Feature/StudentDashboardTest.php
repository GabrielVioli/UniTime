<?php

namespace Tests\Feature;

use App\Models\Aula;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_only_sees_classes_from_their_turma(): void
    {
        $studentTurma = Turma::factory()->create(['nome' => '3 Periodo']);
        $otherTurma = Turma::factory()->create(['nome' => '4 Periodo']);
        $student = User::factory()->create(['turma_id' => $studentTurma->id]);

        Aula::factory()->create([
            'nome' => 'Aula da turma do aluno',
            'turma_id' => $studentTurma->id,
        ]);

        Aula::factory()->create([
            'nome' => 'Aula de outra turma',
            'turma_id' => $otherTurma->id,
        ]);

        $response = $this->actingAs($student)->get(route('authenticated.dashboard'));

        $response->assertOk();
        $response->assertSee('Aula da turma do aluno');
        $response->assertDontSee('Aula de outra turma');
        $response->assertSee('Adicionar falta');
    }

    public function test_student_can_add_absence_only_to_class_from_their_turma(): void
    {
        $studentTurma = Turma::factory()->create();
        $otherTurma = Turma::factory()->create();
        $student = User::factory()->create(['turma_id' => $studentTurma->id]);
        $allowedAula = Aula::factory()->create(['turma_id' => $studentTurma->id]);
        $blockedAula = Aula::factory()->create(['turma_id' => $otherTurma->id]);

        $this->actingAs($student)
            ->post(route('aulas.falta', $allowedAula))
            ->assertRedirect();

        $this->assertDatabaseHas('faltas', [
            'user_id' => $student->id,
            'aula_id' => $allowedAula->id,
            'quantidade' => 1,
        ]);

        $this->actingAs($student)
            ->post(route('aulas.falta', $blockedAula))
            ->assertForbidden();

        $this->assertDatabaseMissing('faltas', [
            'user_id' => $student->id,
            'aula_id' => $blockedAula->id,
        ]);
    }
}
