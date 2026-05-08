<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aula;

class AulaController extends Controller
{
    public function index()
    {
        if (! auth()->user()->is_admin) {
            abort(403);
        }

        return view('admin.aulas.index', [
            'aulas' => Aula::with('turma')
                ->orderBy('turma_id')
                ->orderBy('dia_semana')
                ->get(),
        ]);
    }
}
