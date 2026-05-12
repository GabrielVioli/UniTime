<x-layouts.app title="Dashboard - Unitimes">

<link rel="stylesheet" href="{{ asset('css/student-dashboard.css') }}">

@php
    $user = Auth::user();
    $emAlerta = 0;
    $emPerigo = 0;
    $diasLabels = [
        'segunda' => 'Segunda-feira',
        'terca' => 'Terça-feira',
        'quarta' => 'Quarta-feira',
        'quinta' => 'Quinta-feira',
        'sexta' => 'Sexta-feira',
        'sabado' => 'Sábado',
    ];

    foreach ($aulas as $aula) {
        $qtd = $faltasPorAula->get($aula->id)?->quantidade ?? 0;
        $limite = max(1, $aula->limite_faltas ?? 1);
        $pct = ($qtd / $limite) * 100;

        if ($pct >= 100) {
            $emPerigo++;
        } elseif ($pct >= 75) {
            $emAlerta++;
        }
    }
@endphp

<main class="student-dashboard">
    <div class="page-shell grid gap-5">
        <section class="hero-panel fade-up">
            <div class="flex flex-col gap-5 md:flex-row md:items-center md:justify-between">
                <div>
                    <p class="eyebrow">Bem-vindo de volta</p>
                    <h1 class="font-display mt-2 text-3xl font-bold text-app">
                        {{ $user->name }}
                    </h1>
                    <p class="mt-2 text-sm text-muted-app">
                        Turma:
                        <span class="font-semibold text-accent-app">
                            {{ $user->turma->nome ?? 'Sem turma vinculada' }}
                        </span>
                    </p>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="#grade" class="action-button">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Grade completa
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
                <p class="eyebrow">Disciplinas</p>
                <p class="stat-number mt-5 text-accent-app">{{ $aulas->count() }}</p>
                <p class="mt-2 text-xs text-muted-app">neste semestre</p>
            </div>

            <div class="card summary-card">
                <p class="eyebrow">Faltas totais</p>
                <p class="stat-number mt-5 text-app">{{ $faltasPorAula->sum('quantidade') }}</p>
                <p class="mt-2 text-xs text-muted-app">registradas</p>
            </div>

            <div class="card summary-card">
                <p class="eyebrow">Em alerta</p>
                <p class="stat-number mt-5 text-yellow-app">{{ $emAlerta }}</p>
                <p class="mt-2 text-xs text-muted-app">75% ou mais do limite</p>
            </div>

            <div class="card summary-card">
                <p class="eyebrow">Risco</p>
                <p class="stat-number mt-5 text-red-app">{{ $emPerigo }}</p>
                <p class="mt-2 text-xs text-muted-app">limite atingido</p>
            </div>
        </section>

        <section class="card fade-up delay-2 card-clip">
            <div class="flex items-center justify-between px-6 py-5 border-bottom-app">
                <div>
                    <p class="eyebrow">Acompanhamento</p>
                    <h2 class="font-display mt-1 text-lg font-bold text-app">Frequência por disciplina</h2>
                </div>
            </div>

            <div class="divide-y divide-border-app">
                @forelse ($aulas as $aula)
                    @php
                        $faltaReg = $faltasPorAula->get($aula->id);
                        $qtdFalta = $faltaReg?->quantidade ?? 0;
                        $presencas = $faltaReg?->presencas ?? 0;
                        $limite = max(1, $aula->limite_faltas ?? 1);
                        $pct = min(100, ($qtdFalta / $limite) * 100);

                        if ($pct >= 100) {
                            $status = 'danger';
                            $cor = 'var(--red)';
                            $label = 'Risco';
                        } elseif ($pct >= 75) {
                            $status = 'warn';
                            $cor = 'var(--yellow)';
                            $label = 'Alerta';
                        } else {
                            $status = 'ok';
                            $cor = 'var(--green)';
                            $label = 'OK';
                        }
                    @endphp

                    <article class="px-6 py-5">
                        <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                            <div class="flex min-w-0 gap-3">
                                <div class="aula-dot aula-dot-{{ $status }}"></div>
                                <div class="min-w-0">
                                    <h3 class="truncate text-sm font-bold text-app">{{ $aula->nome }}</h3>
                                    <p class="mt-1 text-xs text-muted-app">
                                        {{ $aula->professor ?? 'Professor não informado' }}
                                        @if ($aula->sala)
                                            · Sala {{ $aula->sala }}
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="flex flex-wrap items-center gap-3">
                                <span class="text-sm tabular-nums text-muted-app">
                                    <strong class="text-app">{{ $qtdFalta }}</strong>/{{ $limite }} faltas
                                </span>
                                <span class="badge badge-{{ $status }}">{{ $label }}</span>
                            </div>
                        </div>

                        <progress class="mt-4 absence-progress progress-{{ $status }}" value="{{ $qtdFalta }}" max="{{ $limite }}"></progress>

                        <div class="mt-4 flex flex-wrap items-center gap-3">
                            <form method="POST" action="{{ route('aulas.falta', $aula->id) }}">
                                @csrf
                                <button
                                    type="submit"
                                    class="action-button danger"
                                    onclick="return confirm('Adicionar falta em {{ $aula->nome }}?')"
                                >
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Adicionar falta
                                </button>
                            </form>

                            <span class="text-xs text-muted-app">
                                {{ $presencas }} presenças registradas
                            </span>
                        </div>
                    </article>
                @empty
                    <div class="empty-state px-6 py-12">
                        <div>
                            <div class="empty-icon">
                                <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <h3 class="font-display text-base font-bold text-app">Nenhuma disciplina encontrada</h3>
                            <p class="mx-auto mt-2 max-w-md text-sm text-muted-app">
                                Ainda não existem aulas cadastradas para a sua turma.
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>
        </section>

        @if ($aulas->count() > 0)
            <section id="grade" class="card fade-up delay-3 p-6">
                <div class="mb-5">
                    <p class="eyebrow">Semana</p>
                    <h2 class="font-display mt-1 text-lg font-bold text-app">Grade completa</h2>
                </div>

                <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($diasLabels as $dia => $label)
                        <div>
                            <h3 class="mb-3 text-sm font-bold text-app">{{ $label }}</h3>
                            <div class="grid gap-3">
                                @forelse (($aulasPorDia[$dia] ?? collect()) as $aula)
                                    <div class="grade-slot">
                                        <p class="text-sm font-bold text-app">{{ $aula->nome }}</p>
                                        <p class="mt-1 text-xs text-accent-app">
                                            {{ \Carbon\Carbon::parse($aula->horario_inicio)->format('H:i') }} -
                                            {{ \Carbon\Carbon::parse($aula->horario_fim)->format('H:i') }}
                                        </p>
                                        @if ($aula->sala)
                                            <p class="mt-1 text-xs text-muted-app">Sala {{ $aula->sala }}</p>
                                        @endif
                                    </div>
                                @empty
                                    <p class="rounded-lg border border-dashed px-3 py-3 text-xs empty-day">
                                        Sem aulas neste dia.
                                    </p>
                                @endforelse
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        @if ($emAlerta > 0 || $emPerigo > 0)
            <section class="grid gap-4 sm:grid-cols-2 fade-up delay-3">
                @if ($emPerigo > 0)
                    <div class="card p-5 alert-danger-card">
                        <p class="font-display text-sm font-bold text-red-app">Risco de reprovação</p>
                        <p class="mt-2 text-sm text-muted-app">
                            Você atingiu o limite de faltas em <strong class="text-app">{{ $emPerigo }}</strong>
                            {{ $emPerigo === 1 ? 'disciplina' : 'disciplinas' }}.
                        </p>
                    </div>
                @endif

                @if ($emAlerta > 0)
                    <div class="card p-5 alert-warn-card">
                        <p class="font-display text-sm font-bold text-yellow-app">Atenção às faltas</p>
                        <p class="mt-2 text-sm text-muted-app">
                            <strong class="text-app">{{ $emAlerta }}</strong>
                            {{ $emAlerta === 1 ? 'disciplina está' : 'disciplinas estão' }} acima de 75% do limite.
                        </p>
                    </div>
                @endif
            </section>
        @endif
    </div>
</main>

</x-layouts.app>
