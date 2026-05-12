<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AulaValidateRequest;
use App\Models\Aula;
use App\Models\Curso;

class AulaController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()->is_admin, 403);

        return view('admin.aulas.index', [
            'aulas' => Aula::with('turma.curso')
                ->orderBy('turma_id')
                ->orderBy('dia_semana')
                ->get(),
            'cursos' => Curso::with('turmas')->orderBy('nome')->get(),
        ]);
    }

    public function store(AulaValidateRequest $request)
    {
        Aula::create($request->validated());

        return redirect()
            ->route('admin.aulas.index')
            ->with('success', 'Aula criada com sucesso.');
    }

    public function destroy(Aula $aula)
    {
        abort_unless(auth()->user()->is_admin, 403);

        $aula->delete();

        return redirect()
            ->route('admin.aulas.index')
            ->with('success', 'Aula excluída com sucesso.');
    }
}
