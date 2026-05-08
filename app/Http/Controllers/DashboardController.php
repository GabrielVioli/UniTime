<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use App\Models\Falta;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user()->load(['turma.curso', 'faltas']);
        $aulas = $user->turma
            ? Aula::where('turma_id', $user->turma_id)->orderBy('horario_inicio')->get()
            : collect();
        $faltasPorAula = $user->faltas->keyBy('aula_id');
        $diasSemana = ['segunda', 'terca', 'quarta', 'quinta', 'sexta', 'sabado'];

        return view('authenticated.dashboard', [
            'user' => $user,
            'aulas' => $aulas,
            'aulasPorDia' => collect($diasSemana)->mapWithKeys(fn ($dia) => [$dia => $aulas->where('dia_semana', $dia)]),
            'diasSemana' => $diasSemana,
            'faltasPorAula' => $faltasPorAula,
            'totalFaltas' => $user->faltas->sum('quantidade'),
            'totalPresencas' => $user->faltas->sum('presencas'),
        ]);
    }

    public function marcarPresenca(Aula $aula)
    {
        return $this->registrar($aula, 'presencas');
    }

    public function marcarFalta(Aula $aula)
    {
        return $this->registrar($aula, 'quantidade');
    }

    private function registrar(Aula $aula, string $campo)
    {
        $user = auth()->user();

        abort_unless($user->turma_id === $aula->turma_id, 403);

        Falta::firstOrCreate(
            ['user_id' => $user->id, 'aula_id' => $aula->id],
            ['quantidade' => 0, 'presencas' => 0]
        )->increment($campo);

        return back();
    }
}
