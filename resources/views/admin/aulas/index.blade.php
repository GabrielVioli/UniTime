<x-layouts.app title="Gerenciar Aulas — Unitimes">

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
    }


    h1, h2, h3, .font-display { font-family: 'Syne', sans-serif; }

    .card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 12px;
    }

    .btn-primary {
        background: var(--accent);
        color: #0d1117;
        font-family: 'Syne', sans-serif;
        font-weight: 700;
        font-size: 13px;
        padding: 8px 16px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: opacity .15s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
    }
    .btn-primary:hover { opacity: .85; }

    .btn-ghost {
        background: transparent;
        color: var(--muted);
        font-size: 12px;
        padding: 5px 10px;
        border-radius: 6px;
        border: 1px solid var(--border);
        cursor: pointer;
        transition: all .15s;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        text-decoration: none;
    }
    .btn-ghost:hover { color: var(--text); border-color: #444c56; }

    .form-input {
        width: 100%;
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: 8px;
        color: var(--text);
        font-size: 13px;
        padding: 8px 12px;
        outline: none;
        transition: border-color .15s;
        font-family: 'DM Sans', sans-serif;
    }
    .form-input:focus { border-color: var(--accent); }
    .form-input option { background: var(--surface); }

    .form-label { font-size: 12px; font-weight: 600; color: var(--muted); display: block; margin-bottom: 5px; font-family: 'Syne', sans-serif; letter-spacing: .04em; }

    .table-row:hover { background: rgba(255,255,255,.025); }

    .turma-pill {
        font-size: 11px;
        font-weight: 600;
        font-family: 'Syne', sans-serif;
        padding: 3px 10px;
        border-radius: 99px;
        background: rgba(88,166,255,.1);
        color: var(--accent);
        border: 1px solid rgba(88,166,255,.2);
    }

    .dia-pill {
        font-size: 11px;
        font-weight: 600;
        padding: 2px 8px;
        border-radius: 6px;
        background: var(--border);
        color: var(--muted);
        text-transform: capitalize;
    }

    .alert-success {
        background: rgba(63,185,80,.1);
        border: 1px solid rgba(63,185,80,.3);
        color: var(--green);
        border-radius: 8px;
        padding: 10px 16px;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(12px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .fade-up { animation: fadeUp .35s ease both; }
    .delay-1 { animation-delay: .05s; }
    .delay-2 { animation-delay: .10s; }
</style>

<div class="min-h-screen" style="background:var(--bg); padding: 24px 20px 80px;">
    <div class="max-w-6xl mx-auto grid gap-5">

        {{-- Header --}}
        <div class="fade-up flex items-center justify-between gap-4 flex-wrap">
            <div>
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1.5 text-xs mb-3" style="color:var(--muted)">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Voltar ao painel
                </a>
                <h1 class="font-display text-2xl font-bold">Gerenciar Aulas</h1>
                <p class="text-sm mt-1" style="color:var(--muted)">{{ $aulas->count() }} aulas cadastradas</p>
            </div>
        </div>

        {{-- Sucesso --}}
        @if(session('success'))
        <div class="alert-success fade-up">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
        @endif

        <div class="grid lg:grid-cols-3 gap-5">

            {{-- ─── Formulário Nova Aula ─── --}}
            <div class="card fade-up delay-1 p-6 lg:col-span-1 h-fit">
                <h2 class="font-display font-bold text-base mb-5">Nova Aula</h2>

                <form method="POST" action="{{ route('admin.aulas.store') }}" class="grid gap-4">
                    @csrf

                    <div>
                        <label class="form-label">NOME DA DISCIPLINA</label>
                        <input type="text" name="nome" class="form-input"
                            placeholder="ex: Engenharia de Software"
                            value="{{ old('nome') }}" required>
                        @error('nome')
                            <p class="text-xs mt-1" style="color:var(--red)">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="form-label">NOME DO PROFESSOR</label>
                        <input type="text" name="professor" class="form-input"
                            placeholder="Nome do professor (opcional)"
                            value="{{ old('professor') }}">
                    </div>

                    <div>
                        <label class="form-label">CURSO / TURMA</label>
                        <select name="turma_id" class="form-input" required>
                            <option value="">Selecione a turma</option>
                            @foreach ($cursos as $curso)
                                <optgroup label="{{ $curso->nome }}">
                                    @foreach ($curso->turmas as $turma)
                                        <option value="{{ $turma->id }}" {{ old('turma_id') == $turma->id ? 'selected' : '' }}>
                                            {{ $turma->nome }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        @error('turma_id')
                            <p class="text-xs mt-1" style="color:var(--red)">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label>DIA DA SEMANA</label>
                        <select name="dia_semana" class="form-input" required>
                            <option value="">Selecione o dia</option>
                            @foreach (['segunda','terca','quarta','quinta','sexta','sabado'] as $dia)
                                <option value="{{ $dia }}" {{ old('dia_semana') == $dia ? 'selected' : '' }}>
                                    {{ ucfirst($dia) }}-feira
                                </option>
                            @endforeach
                        </select>
                        @error('dia_semana')
                            <p class="text-xs mt-1" style="color:var(--red)">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label>INÍCIO</label>
                            <input type="time" name="horario_inicio" class="form-input"
                                value="{{ old('horario_inicio') }}" required>
                            @error('horario_inicio')
                                <p class="text-xs mt-1" style="color:var(--red)">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label>FIM</label>
                            <input type="time" name="horario_fim" class="form-input"
                                value="{{ old('horario_fim') }}" required>
                            @error('horario_fim')
                                <p class="text-xs mt-1" style="color:var(--red)">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label>SALA</label>
                        <input type="text" name="sala" class="form-input"
                            placeholder="ex: Lab 3, Sala 201"
                            value="{{ old('sala') }}">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label>CARGA HORÁRIA (h)</label>
                            <input type="number" name="carga_horaria" class="form-input"
                                placeholder="ex: 60" min="1"
                                value="{{ old('carga_horaria') }}">
                        </div>
                        <div>
                            <label>LIMITE DE FALTAS</label>
                            <input type="number" name="limite_faltas" class="form-input"
                                placeholder="ex: 15" min="1"
                                value="{{ old('limite_faltas') }}" required>
                            @error('limite_faltas')
                                <p class="text-xs mt-1" style="color:var(--red)">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn-primary w-full justify-center mt-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                        </svg>
                        Cadastrar Aula
                    </button>
                </form>
            </div>

            {{-- ─── Tabela de Aulas ─── --}}
            <div class="card fade-up delay-2 lg:col-span-2" style="overflow:hidden; height:fit-content;">
                <div class="px-6 py-4" style="border-bottom:1px solid var(--border)">
                    <h2 class="font-display font-bold text-base">Aulas Cadastradas</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr style="border-bottom:1px solid var(--border)">
                                <th class="px-5 py-3 text-left text-xs font-semibold tracking-wider" style="color:var(--muted)">DISCIPLINA</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold tracking-wider hidden md:table-cell" style="color:var(--muted)">TURMA</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold tracking-wider hidden lg:table-cell" style="color:var(--muted)">HORÁRIO</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold tracking-wider hidden lg:table-cell" style="color:var(--muted)">SALA</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y" style="border-color:var(--border)">
                            @forelse ($aulas as $aula)
                            <tr class="table-row">
                                <td class="px-5 py-3">
                                    <p class="font-medium text-sm" style="color:var(--text)">{{ $aula->nome }}</p>
                                    @if($aula->professor)
                                    <p class="text-xs mt-0.5" style="color:var(--muted)">{{ $aula->professor }}</p>
                                    @endif
                                </td>
                                <td class="px-4 py-3 hidden md:table-cell">
                                    <span class="turma-pill">{{ $aula->turma->nome ?? '—' }}</span>
                                </td>
                                <td class="px-4 py-3 hidden lg:table-cell">
                                    <span class="dia-pill">{{ ucfirst($aula->dia_semana) }}</span>
                                    <p class="text-xs mt-1" style="color:var(--muted)">
                                        {{ \Carbon\Carbon::parse($aula->horario_inicio)->format('H:i') }} –
                                        {{ \Carbon\Carbon::parse($aula->horario_fim)->format('H:i') }}
                                    </p>
                                </td>
                                <td class="px-4 py-3 hidden lg:table-cell text-sm" style="color:var(--muted)">
                                    {{ $aula->sala ?? '—' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-sm" style="color:var(--muted)">
                                    Nenhuma aula cadastrada ainda.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

</x-layouts.app>
