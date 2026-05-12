<x-layouts.app title="Dashboard — Unitimes">

{{-- Estilos customizados --}}
<style>
    @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500&display=swap');

    :root {
        --bg:        #0d1117;
        --surface:   #161b22;
        --border:    #21262d;
        --muted:     #8b949e;
        --text:      #e6edf3;
        --accent:    #58a6ff;
        --green:     #3fb950;
        --yellow:    #d29922;
        --red:       #f85149;
        --purple:    #bc8cff;
    }


    h1, h2, h3, .font-display { font-family: 'Syne', sans-serif; }

    .card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 12px;
        transition: border-color .2s, box-shadow .2s;
    }
    .card:hover { border-color: #30363d; box-shadow: 0 4px 24px rgba(0,0,0,.4); }

    .progress-track {
        background: var(--border);
        border-radius: 99px;
        height: 6px;
        overflow: hidden;
    }
    .progress-fill {
        height: 100%;
        border-radius: 99px;
        transition: width .6s cubic-bezier(.4,0,.2,1);
    }

    .badge {
        font-family: 'Syne', sans-serif;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .06em;
        text-transform: uppercase;
        padding: 3px 10px;
        border-radius: 99px;
    }
    .badge-ok     { background: rgba(63,185,80,.15); color: var(--green); }
    .badge-warn   { background: rgba(210,153,34,.15); color: var(--yellow); }
    .badge-danger { background: rgba(248,81,73,.15);  color: var(--red); }

    .stat-number { font-family: 'Syne', sans-serif; font-weight: 800; font-size: 2rem; line-height: 1; }

    .aula-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; margin-top: 4px; }

    /* grade horária */
    .grade-slot {
        border-radius: 8px;
        padding: 8px 10px;
        font-size: 12px;
        line-height: 1.4;
        border-left: 3px solid transparent;
    }
    .grade-slot.has-aula { background: rgba(88,166,255,.08); border-left-color: var(--accent); }
    .grade-slot.empty    { background: transparent; }

    /* animações de entrada */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .fade-up { animation: fadeUp .4s ease both; }
    .delay-1 { animation-delay: .05s; }
    .delay-2 { animation-delay: .10s; }
    .delay-3 { animation-delay: .15s; }
    .delay-4 { animation-delay: .20s; }
    .delay-5 { animation-delay: .25s; }
</style>

<div class="min-h-screen" style="background:var(--bg); padding: 24px 20px 60px;">

    {{-- ─── Header ─── --}}
    <div class="fade-up max-w-6xl mx-auto mb-8 flex items-center justify-between gap-4 flex-wrap">
        <div>
            <p class="font-display text-xs tracking-widest uppercase mb-1" style="color:var(--muted)">Bem-vindo de volta</p>
            <h1 class="font-display text-2xl font-bold" style="color:var(--text)">
                {{ Auth::user()->name }}
            </h1>
            <p class="text-sm mt-1" style="color:var(--muted)">
                Turma: <span style="color:var(--accent)">{{ Auth::user()->turma->nome ?? '—' }}</span>
            </p>
        </div>
        <div>
            <a href="{{route('authenticated.logout')}}"> logout</a>
            
        </div>
        <div class="flex gap-3">
            <a href="{{ route('authenticated.dashboard') }}"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition-all"
               style="background:var(--surface); border:1px solid var(--border); color:var(--text);">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Grade Completa
            </a>
        </div>
    </div>

    <div class="max-w-6xl mx-auto grid gap-5">

        {{-- ─── Cards de resumo ─── --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 fade-up delay-1">

            {{-- Total de disciplinas --}}
            <div class="card p-5">
                <p class="text-xs font-medium mb-3" style="color:var(--muted)">DISCIPLINAS</p>
                <p class="stat-number" style="color:var(--accent)">{{ $aulas->count() }}</p>
                <p class="text-xs mt-1" style="color:var(--muted)">neste semestre</p>
            </div>

            {{-- Faltas totais --}}
            <div class="card p-5">
                <p class="text-xs font-medium mb-3" style="color:var(--muted)">FALTAS TOTAIS</p>
                <p class="stat-number" style="color:var(--text)">{{ $faltasPorAula->sum('quantidade') }}</p>
                <p class="text-xs mt-1" style="color:var(--muted)">registradas</p>
            </div>

            {{-- Em alerta --}}
            @php
                $emAlerta  = 0;
                $emPerigo  = 0;
                foreach ($aulas as $aula) {
                    $qtd = $faltasPorAula->get($aula->id)?->quantidade?? 0;
                    $pct = $aula->limite_faltas > 0 ? ($qtd / $aula->limite_faltas) * 100 : 0;
                    if ($pct >= 100) $emPerigo++;
                    elseif ($pct >= 75) $emAlerta++;
                }
            @endphp
            <div class="card p-5">
                <p class="text-xs font-medium mb-3" style="color:var(--muted)">EM ALERTA</p>
                <p class="stat-number" style="color:var(--yellow)">{{ $emAlerta }}</p>
                <p class="text-xs mt-1" style="color:var(--muted)">≥ 75% do limite</p>
            </div>

            {{-- Em risco --}}
            <div class="card p-5">
                <p class="text-xs font-medium mb-3" style="color:var(--muted)">RISCO REPROVAÇÃO</p>
                <p class="stat-number" style="color:var(--red)">{{ $emPerigo }}</p>
                <p class="text-xs mt-1" style="color:var(--muted)">limite atingido</p>
            </div>

        </div>

        {{-- ─── Lista de disciplinas + frequência ─── --}}
        <div class="card fade-up delay-2" style="overflow:hidden;">
            <div class="px-6 py-4 flex items-center justify-between" style="border-bottom:1px solid var(--border)">
                <h2 class="font-display font-bold text-base">Frequência por Disciplina</h2>
            </div>

            <div class="divide-y" style="border-color:var(--border)">
                @forelse ($aulas as $aula)
                    @php
                        $faltaReg = $faltas->where('aula_id', $aula->id)->first();
                        $qtdFalta = $faltaReg?->quantidade ?? 0;
                        $limite   = $aula->limite_faltas ?? 1;
                        $pct      = min(100, ($qtdFalta / $limite) * 100);

                        if ($pct >= 100)     { $status = 'danger'; $cor = 'var(--red)';    $label = 'Reprovado'; }
                        elseif ($pct >= 75)  { $status = 'warn';   $cor = 'var(--yellow)'; $label = 'Atenção'; }
                        else                 { $status = 'ok';     $cor = 'var(--green)';  $label = 'OK'; }
                    @endphp

                    <div class="px-6 py-4">
                        <div class="flex items-start justify-between gap-4 mb-3">
                            <div class="flex items-start gap-3 min-w-0">
                                <div class="aula-dot mt-1.5" style="background:{{ $cor }}"></div>
                                <div class="min-w-0">
                                    <p class="font-medium text-sm truncate" style="color:var(--text)">{{ $aula->nome }}</p>
                                    <p class="text-xs mt-0.5" style="color:var(--muted)">
                                        {{ $aula->professor ?? 'Professor não informado' }}
                                        @if($aula->sala) · Sala {{ $aula->sala }} @endif
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 flex-shrink-0">
                                <span class="text-sm tabular-nums" style="color:var(--muted)">
                                    <span style="color:var(--text); font-weight:600">{{ $qtdFalta }}</span>/{{ $limite }}
                                </span>
                                <span class="badge badge-{{ $status }}">{{ $label }}</span>
                            </div>
                        </div>

                        <div class="progress-track">
                            <div class="progress-fill" style="width:{{ $pct }}%; background:{{ $cor }};"></div>
                        </div>

                        <div class="flex items-center gap-3 mt-3">
                            {{-- Adicionar falta --}}
                            <form method="POST" action="{{ route('faltas.adicionar', $aula->id) }}">
                                @csrf
                                <button type="submit"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium transition-all"
                                    style="background:rgba(248,81,73,.12); color:var(--red); border:1px solid rgba(248,81,73,.25);"
                                    onclick="return confirm('Registrar falta em {{ $aula->nome }}?')">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Registrar Falta
                                </button>
                            </form>

                            {{-- Remover falta --}}
                            @if($qtdFalta > 0)
                            <form method="POST" action="{{ route('faltas.remover', $aula->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium transition-all"
                                    style="background:rgba(88,166,255,.08); color:var(--accent); border:1px solid rgba(88,166,255,.2);">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                    </svg>
                                    Remover Falta
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-12 text-center" style="color:var(--muted)">
                        <svg class="w-10 h-10 mx-auto mb-3 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <p class="text-sm">Nenhuma disciplina encontrada para sua turma.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- ─── Próximas aulas hoje ─── --}}
        @php
            $diasPt = ['domingo','segunda','terca','quarta','quinta','sexta','sabado'];
            $hoje   = $diasPt[date('w')];
            $aulasHoje = $aulas->where('dia_semana', $hoje)->sortBy('horario_inicio');
        @endphp

        @if($aulasHoje->count() > 0)
        <div class="card fade-up delay-3 p-6">
            <h2 class="font-display font-bold text-base mb-4">
                Aulas de Hoje
                <span class="text-xs font-normal ml-2" style="color:var(--muted)">{{ ucfirst($hoje) }}-feira</span>
            </h2>
            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-3">
                @foreach ($aulasHoje as $aula)
                <div class="grade-slot has-aula">
                    <p class="font-medium text-sm mb-0.5" style="color:var(--text)">{{ $aula->nome }}</p>
                    <p class="text-xs" style="color:var(--accent)">
                        {{ \Carbon\Carbon::parse($aula->horario_inicio)->format('H:i') }} –
                        {{ \Carbon\Carbon::parse($aula->horario_fim)->format('H:i') }}
                    </p>
                    @if($aula->sala)
                    <p class="text-xs mt-1" style="color:var(--muted)">Sala {{ $aula->sala }}</p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- ─── Alertas ativos ─── --}}
        @if($emAlerta > 0 || $emPerigo > 0)
        <div class="fade-up delay-4 grid sm:grid-cols-2 gap-4">
            @if($emPerigo > 0)
            <div class="card p-5 flex gap-4 items-start" style="border-color:rgba(248,81,73,.3); background:rgba(248,81,73,.05);">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background:rgba(248,81,73,.15);">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" style="color:var(--red)" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-display font-bold text-sm" style="color:var(--red)">Risco de Reprovação</p>
                    <p class="text-xs mt-1" style="color:var(--muted)">
                        Você atingiu o limite de faltas em <strong style="color:var(--text)">{{ $emPerigo }}</strong>
                        {{ $emPerigo === 1 ? 'disciplina' : 'disciplinas' }}.
                        Entre em contato com a coordenação.
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-3">
    <a href="{{ route('authenticated.dashboard') }}"
       class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium"
       style="background:var(--surface); border:1px solid var(--border); color:var(--text);">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        Grade Completa
    </a>
    <form method="POST" action="{{ route('authenticated.logout') }}">
            @endif

            @if($emAlerta > 0)
            <div class="card p-5 flex gap-4 items-start" style="border-color:rgba(210,153,34,.3); background:rgba(210,153,34,.05);">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background:rgba(210,153,34,.15);">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" style="color:var(--yellow)" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </div>
                <div>
                    <p class="font-display font-bold text-sm" style="color:var(--yellow)">Atenção às Faltas</p>
                    <p class="text-xs mt-1" style="color:var(--muted)">
                        <strong style="color:var(--text)">{{ $emAlerta }}</strong>
                        {{ $emAlerta === 1 ? 'disciplina está' : 'disciplinas estão' }} acima de 75% do limite.
                        Reduza as faltas para evitar reprovação.
                    </p>
                </div>
            </div>
            @endif
        </div>
        @endif

    </div>
</div>

</x-layouts.app>
