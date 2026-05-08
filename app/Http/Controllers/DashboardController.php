<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user()->load(['turma.aulas', 'faltas']);
        $aulas = $user->turma?->aulas?->sortBy('dia_semana') ?? collect();
        $faltasPorAula = $user->faltas->keyBy('aula_id');

        return view('authenticated.dashboard', [
            'user' => $user,
            'aulas' => $aulas,
            'faltasPorAula' => $faltasPorAula,
            'totalFaltas' => $user->faltas->sum('quantidade'),
        ]);
    }
}
