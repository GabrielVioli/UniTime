<x-layouts.app title="Painel Admin - Unitimes">

<link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">

<main class="admin-dashboard">
    <div class="page-shell grid gap-5">
        <section class="hero-panel fade-up">
            <div class="flex flex-col gap-5 md:flex-row md:items-center md:justify-between">
                <div>
                    <div class="admin-badge">
                        <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"/>
                        </svg>
                        Administrador
                    </div>

                    <h1 class="mt-3 text-3xl font-bold text-app">Painel de controle</h1>
                    <p class="mt-2 text-sm text-muted-app">Gestao de cursos, turmas, aulas e alunos.</p>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('admin.aulas.index') }}" class="action-button primary">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                        </svg>
                        Nova aula
                    </a>

                    <form method="POST" action="{{ route('authenticated.logout') }}">
                        @csrf
                        <button type="submit" class="action-button danger">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Sair
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <section class="grid grid-cols-2 gap-4 md:grid-cols-4 fade-up delay-1">
            <div class="card summary-card">
                <p class="eyebrow">Aulas</p>
                <p class="stat-number mt-5 text-accent-app">{{ $totalAulas }}</p>
                <p class="mt-2 text-xs text-muted-app">cadastradas</p>
            </div>

            <div class="card summary-card">
                <p class="eyebrow">Turmas</p>
                <p class="stat-number mt-5 text-purple-app">{{ $totalTurmas }}</p>
                <p class="mt-2 text-xs text-muted-app">ativas</p>
            </div>

            <div class="card summary-card">
                <p class="eyebrow">Alunos</p>
                <p class="stat-number mt-5 text-green-app">{{ $totalAlunos }}</p>
                <p class="mt-2 text-xs text-muted-app">registrados</p>
            </div>

            <div class="card summary-card">
                <p class="eyebrow">Cursos</p>
                <p class="stat-number mt-5 text-yellow-app">{{ $totalCursos }}</p>
                <p class="mt-2 text-xs text-muted-app">no sistema</p>
            </div>
        </section>

        <section class="grid gap-4 lg:grid-cols-3 fade-up delay-2">
            @forelse ($turmas as $turma)
                <article class="card p-5">
                    <div class="mb-4 flex items-start justify-between gap-3">
                        <div>
                            <h2 class="text-sm font-bold text-app">{{ $turma->nome }}</h2>
                            <p class="mt-1 text-xs text-muted-app">{{ $turma->curso->nome ?? 'Curso nao informado' }}</p>
                        </div>
                        <span class="pill">T{{ $turma->id }}</span>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <p class="text-xl font-bold text-accent-app">{{ $turma->aulas_count }}</p>
                            <p class="text-xs text-muted-app">aulas</p>
                        </div>

                        <div>
                            <p class="text-xl font-bold text-green-app">{{ $turma->alunos_count }}</p>
                            <p class="text-xs text-muted-app">alunos</p>
                        </div>
                    </div>
                </article>
            @empty
                <div class="card empty-state lg:col-span-3">
                    Nenhuma turma cadastrada.
                </div>
            @endforelse
        </section>

        <section class="grid gap-5 lg:grid-cols-[1.2fr_.8fr] fade-up delay-3">
            <div class="card card-clip">
                <div class="flex items-center justify-between gap-3 px-6 py-5 border-bottom-app">
                    <div>
                        <p class="eyebrow">Ultimos cadastros</p>
                        <h2 class="mt-1 text-lg font-bold text-app">Aulas recentes</h2>
                    </div>

                    <a href="{{ route('admin.aulas.index') }}" class="action-button">Ver todas</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-row-app">
                                <th class="px-6 py-3 text-left text-xs font-bold text-muted-app">Disciplina</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-muted-app">Turma</th>
                                <th class="hidden px-4 py-3 text-left text-xs font-bold md:table-cell text-muted-app">Horario</th>
                                <th class="hidden px-4 py-3 text-left text-xs font-bold lg:table-cell text-muted-app">Sala</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border-app">
                            @forelse ($aulas as $aula)
                                <tr class="table-row">
                                    <td class="px-6 py-4">
                                        <p class="font-bold text-app">{{ $aula->nome }}</p>
                                        @if ($aula->professor)
                                            <p class="mt-1 text-xs text-muted-app">{{ $aula->professor }}</p>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="pill">{{ $aula->turma->nome ?? '-' }}</span>
                                    </td>
                                    <td class="hidden px-4 py-4 md:table-cell">
                                        <p class="text-xs text-accent-app">{{ ucfirst($aula->dia_semana) }}</p>
                                        <p class="mt-1 text-xs text-muted-app">
                                            {{ \Carbon\Carbon::parse($aula->horario_inicio)->format('H:i') }} -
                                            {{ \Carbon\Carbon::parse($aula->horario_fim)->format('H:i') }}
                                        </p>
                                    </td>
                                    <td class="hidden px-4 py-4 text-sm lg:table-cell text-muted-app">{{ $aula->sala ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="empty-state">Nenhuma aula cadastrada.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card card-clip">
                <div class="px-6 py-5 border-bottom-app">
                    <p class="eyebrow">Matriculas</p>
                    <h2 class="mt-1 text-lg font-bold text-app">Alunos recentes</h2>
                </div>

                <div class="divide-y divide-border-app">
                    @forelse ($alunos as $aluno)
                        <div class="flex items-center gap-3 px-6 py-4">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full text-xs font-bold avatar-accent">
                                {{ strtoupper(substr($aluno->name, 0, 2)) }}
                            </div>
                            <div class="min-w-0">
                                <p class="truncate text-sm font-bold text-app">{{ $aluno->name }}</p>
                                <p class="truncate text-xs text-muted-app">
                                    {{ $aluno->turma->nome ?? 'Sem turma' }}
                                    @if ($aluno->turma?->curso)
                                        · {{ $aluno->turma->curso->nome }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">Nenhum aluno registrado.</div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
</main>

</x-layouts.app>
