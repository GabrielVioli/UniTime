<x-layouts.app title="Painel Admin — Unitimes">

<style>
    @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500&display=swap');

    :root {
        --bg:      #0d1117;
        --surface: #161b22;
        --border:  #21262d;
        --muted:   #8b949e;
        --text:    #e6edf3;
        --accent:  #58a6ff;
        --green:   #3fb950;
        --yellow:  #d29922;
        --red:     #f85149;
        --purple:  #bc8cff;
    }

    h1, h2, h3, .font-display { font-family: 'Syne', sans-serif; }

    .card { background: var(--surface); border: 1px solid var(--border); border-radius: 12px; transition: border-color .2s; }
    .card:hover { border-color: #30363d; }

    .stat-number { font-family: 'Syne', sans-serif; font-weight: 800; font-size: 2rem; line-height: 1; }

    .table-row { transition: background .15s; }
    .table-row:hover { background: rgba(255,255,255,.025); }

    .btn-primary {
        background: var(--accent); color: #0d1117;
        font-family: 'Syne', sans-serif; font-weight: 700; font-size: 13px;
        padding: 8px 16px; border-radius: 8px; border: none; cursor: pointer;
        transition: opacity .15s; display: inline-flex; align-items: center; gap: 6px; text-decoration: none;
    }
    .btn-primary:hover { opacity: .9; }

    .btn-ghost {
        background: transparent; color: var(--muted); font-size: 12px;
        padding: 5px 10px; border-radius: 6px; border: 1px solid var(--border);
        cursor: pointer; transition: all .15s; display: inline-flex; align-items: center; gap: 5px; text-decoration: none;
    }
    .btn-ghost:hover { color: var(--text); border-color: #444c56; }

    .turma-pill {
        font-size: 11px; font-weight: 600; font-family: 'Syne', sans-serif;
        padding: 3px 10px; border-radius: 99px;
        background: rgba(88,166,255,.1); color: var(--accent); border: 1px solid rgba(88,166,255,.2);
    }

    .dia-pill {
        font-size: 11px; font-weight: 600; padding: 2px 8px; border-radius: 6px;
        background: var(--border); color: var(--muted); text-transform: capitalize;
    }

    @keyframes fadeUp { from { opacity: 0; transform: translateY(14px); } to { opacity: 1; transform: translateY(0); } }
    .fade-up { animation: fadeUp .4s ease both; }
    .delay-1 { animation-delay: .05s; }
    .delay-2 { animation-delay: .10s; }
    .delay-3 { animation-delay: .15s; }
</style>

<div class="min-h-screen" style="background:var(--bg); padding: 24px 20px 80px;">
    <div class="max-w-6xl mx-auto grid gap-5">

        {{-- Header --}}
        <div class="fade-up flex items-center justify-between gap-4 flex-wrap">
            <div>
                <div class="inline-flex items-center gap-2 mb-2 px-3 py-1 rounded-full text-xs font-bold"
                     style="background:rgba(188,140,255,.12); color:var(--purple); border:1px solid rgba(188,140,255,.25); font-family:'Syne',sans-serif;">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"/></svg>
                    ADMINISTRADOR
                </div>
                <h1 class="font-display text-2xl font-bold" style="color:var(--text)">Painel de Controle</h1>
                <p class="text-sm mt-1" style="color:var(--muted)">Unitimes · Gestão de Turmas e Disciplinas</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.aulas.index') }}" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    Nova Aula
                </a>
                <form method="POST" action="{{ route('authenticated.logout') }}">
                    @csrf
                    <button type="submit" class="btn-ghost">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Sair
                    </button>
                </form>
            </div>
        </div>

        {{-- Stat cards --}}
        <div class="fade-up delay-1 grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="card p-5">
                <p class="text-xs font-medium mb-3" style="color:var(--muted)">TOTAL DE AULAS</p>
                <p class="stat-number" style="color:var(--accent)">{{ $totalAulas }}</p>
                <p class="text-xs mt-1" style="color:var(--muted)">cadastradas</p>
            </div>
            <div class="card p-5">
                <p class="text-xs font-medium mb-3" style="color:var(--muted)">TURMAS</p>
                <p class="stat-number" style="color:var(--purple)">{{ $totalTurmas }}</p>
                <p class="text-xs mt-1" style="color:var(--muted)">ativas</p>
            </div>
            <div class="card p-5">
                <p class="text-xs font-medium mb-3" style="color:var(--muted)">ALUNOS</p>
                <p class="stat-number" style="color:var(--green)">{{ $totalAlunos }}</p>
                <p class="text-xs mt-1" style="color:var(--muted)">registrados</p>
            </div>
            <div class="card p-5">
                <p class="text-xs font-medium mb-3" style="color:var(--muted)">CURSOS</p>
                <p class="stat-number" style="color:var(--yellow)">{{ $totalCursos }}</p>
                <p class="text-xs mt-1" style="color:var(--muted)">no sistema</p>
            </div>
        </div>

        {{-- Distribuição por turma --}}
        <div class="fade-up delay-2 grid md:grid-cols-3 gap-4">
            @foreach (\App\Models\Turma::all() as $turma)
            @php
                $aulasNaTurma  = $aulas->where('turma_id', $turma->id)->count();
                $alunosNaTurma = \App\Models\User::where('turma_id', $turma->id)->where('is_admin', false)->count();
            @endphp
            <div class="card p-5">
                <div class="flex items-start justify-between gap-2 mb-3">
                    <p class="font-display font-bold text-sm" style="color:var(--text)">{{ $turma->nome }}</p>
                    <span class="turma-pill">T{{ $turma->id }}</span>
                </div>
                <div class="flex gap-5">
                    <div>
                        <p class="text-xl font-bold font-display" style="color:var(--accent)">{{ $aulasNaTurma }}</p>
                        <p class="text-xs" style="color:var(--muted)">aulas</p>
                    </div>
                    <div>
                        <p class="text-xl font-bold font-display" style="color:var(--green)">{{ $alunosNaTurma }}</p>
                        <p class="text-xs" style="color:var(--muted)">alunos</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Tabela de Aulas recentes --}}
        <div class="card fade-up delay-3" style="overflow:hidden;">
            <div class="px-6 py-4 flex items-center justify-between" style="border-bottom:1px solid var(--border)">
                <h2 class="font-display font-bold text-base" style="color:var(--text)">Aulas Recentes</h2>
                <a href="{{ route('admin.aulas.index') }}" class="btn-ghost">Ver todas</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr style="border-bottom:1px solid var(--border)">
                            <th class="px-6 py-3 text-left text-xs font-semibold tracking-wider" style="color:var(--muted)">DISCIPLINA</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold tracking-wider" style="color:var(--muted)">TURMA</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold tracking-wider hidden md:table-cell" style="color:var(--muted)">HORÁRIO</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold tracking-wider hidden lg:table-cell" style="color:var(--muted)">SALA</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y" style="border-color:var(--border)">
                        @forelse ($aulas as $aula)
                        <tr class="table-row">
                            <td class="px-6 py-4">
                                <p class="font-medium" style="color:var(--text)">{{ $aula->nome }}</p>
                                @if($aula->professor)<p class="text-xs mt-0.5" style="color:var(--muted)">{{ $aula->professor }}</p>@endif
                            </td>
                            <td class="px-4 py-4"><span class="turma-pill">{{ $aula->turma->nome ?? '—' }}</span></td>
                            <td class="px-4 py-4 hidden md:table-cell">
                                <span class="dia-pill">{{ ucfirst($aula->dia_semana) }}</span>
                                <p class="text-xs mt-1" style="color:var(--muted)">
                                    {{ \Carbon\Carbon::parse($aula->horario_inicio)->format('H:i') }} –
                                    {{ \Carbon\Carbon::parse($aula->horario_fim)->format('H:i') }}
                                </p>
                            </td>
                            <td class="px-4 py-4 hidden lg:table-cell text-sm" style="color:var(--muted)">{{ $aula->sala ?? '—' }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="px-6 py-8 text-center text-sm" style="color:var(--muted)">Nenhuma aula cadastrada.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Tabela de Alunos --}}
        <div class="card" style="overflow:hidden;">
            <div class="px-6 py-4" style="border-bottom:1px solid var(--border)">
                <h2 class="font-display font-bold text-base" style="color:var(--text)">Alunos Registrados</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr style="border-bottom:1px solid var(--border)">
                            <th class="px-6 py-3 text-left text-xs font-semibold tracking-wider" style="color:var(--muted)">NOME</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold tracking-wider" style="color:var(--muted)">E-MAIL</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold tracking-wider" style="color:var(--muted)">TURMA</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y" style="border-color:var(--border)">
                        @forelse (\App\Models\User::with(['turma'])->where('is_admin', false)->get() as $aluno)
                        <tr class="table-row">
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 font-display font-bold text-xs"
                                         style="background:rgba(88,166,255,.15); color:var(--accent)">
                                        {{ strtoupper(substr($aluno->name, 0, 2)) }}
                                    </div>
                                    <span style="color:var(--text)">{{ $aluno->name }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3" style="color:var(--muted)">{{ $aluno->email }}</td>
                            <td class="px-4 py-3"><span class="turma-pill">{{ $aluno->turma->nome ?? '—' }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="px-6 py-8 text-center text-sm" style="color:var(--muted)">Nenhum aluno registrado.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

</x-layouts.app>