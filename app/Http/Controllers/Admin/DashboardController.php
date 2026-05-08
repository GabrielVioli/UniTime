<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aula;
use App\Models\Curso;
use App\Models\Turma;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()->is_admin, 403);

        return view('admin.dashboard', [
            'totalCursos' => Curso::count(),
            'totalTurmas' => Turma::count(),
            'totalAulas' => Aula::count(),
            'totalAlunos' => User::where('is_admin', false)->count(),
            'aulas' => Aula::with('turma.curso')->latest()->take(6)->get(),
        ]);
    }
}
