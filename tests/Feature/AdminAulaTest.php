<?php

namespace Tests\Feature;

use App\Models\Turma;
use App\Models\User;
use App\Models\Aula;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAulaTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_class_for_selected_turma(): void
    {
        $admin = User::factory()->admin()->create();
        $turma = Turma::factory()->create(['nome' => '3 Periodo']);

        $this->actingAs($admin)
            ->post(route('admin.aulas.store'), [
                'nome' => 'Engenharia de Software',
                'professor' => 'Professor Teste',
                'curso_id' => $turma->curso_id,
                'turma_id' => $turma->id,
                'dia_semana' => 'segunda',
                'horario_inicio' => '19:00',
                'horario_fim' => '20:40',
                'sala' => 'Lab 3',
                'limite_faltas' => 15,
            ])
            ->assertRedirect(route('admin.aulas.index'));

        $this->assertDatabaseHas('aulas', [
            'nome' => 'Engenharia de Software',
            'turma_id' => $turma->id,
            'sala' => 'Lab 3',
            'limite_faltas' => 15,
            'carga_horaria' => 80,
        ]);
    }

    public function test_admin_can_delete_class(): void
    {
        $admin = User::factory()->admin()->create();
        $aula = Aula::factory()->create();

        $this->actingAs($admin)
            ->delete(route('admin.aulas.destroy', $aula))
            ->assertRedirect(route('admin.aulas.index'));

        $this->assertDatabaseMissing('aulas', [
            'id' => $aula->id,
        ]);
    }

    public function test_non_admin_user_cannot_access_admin_class_routes(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('admin.aulas.index'))
            ->assertForbidden();
    }
}
