<x-layouts.app title="Gerenciar Aulas — Unitimes">

<link rel="stylesheet" href="{{ asset('css/admin-aulas.css') }}">

<div class="admin-aulas-screen">
    <div class="max-w-6xl mx-auto grid gap-5">
        <div class="fade-up flex items-center justify-between gap-4 flex-wrap">
            <div>
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1.5 text-xs mb-3 text-muted-app">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Voltar ao painel
                </a>
                <h1 class="font-display text-2xl font-bold">Gerenciar Aulas</h1>
                <p class="text-sm mt-1 text-muted-app">{{ $aulas->count() }} aulas cadastradas</p>
            </div>
        </div>
        @if(session('success'))
        <div class="alert-success fade-up">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
        @endif

        <div class="grid lg:grid-cols-3 gap-5">
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
                            <p class="text-xs mt-1 text-red-app">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="form-label">NOME DO PROFESSOR</label>
                        <input type="text" name="professor" class="form-input"
                            placeholder="Nome do professor (opcional)"
                            value="{{ old('professor') }}">
                    </div>

                    <div>
                        <label class="form-label">CURSO</label>
                        <select
                            name="curso_id"
                            id="curso_id"
                            class="form-input"
                            data-course-select
                            data-target-turmas="turma_id"
                            required
                        >
                            <option value="">Selecione o curso</option>
                            @foreach ($cursos as $curso)
                                <option value="{{ $curso->id }}" {{ old('curso_id') == $curso->id ? 'selected' : '' }}>
                                    {{ $curso->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('curso_id')
                            <p class="text-xs mt-1 text-red-app">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="form-label">TURMA</label>
                        <select name="turma_id" id="turma_id" class="form-input" required>
                            <option value="">Selecione a turma</option>
                            @foreach ($cursos as $curso)
                                @foreach ($curso->turmas as $turma)
                                    <option
                                        value="{{ $turma->id }}"
                                        data-curso-id="{{ $curso->id }}"
                                        {{ old('turma_id') == $turma->id ? 'selected' : '' }}
                                    >
                                        {{ $turma->nome }}
                                    </option>
                                @endforeach
                            @endforeach
                        </select>
                        @error('turma_id')
                            <p class="text-xs mt-1 text-red-app">{{ $message }}</p>
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
                            <p class="text-xs mt-1 text-red-app">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label>INÍCIO</label>
                            <input type="time" name="horario_inicio" class="form-input"
                                value="{{ old('horario_inicio') }}" required>
                            @error('horario_inicio')
                                <p class="text-xs mt-1 text-red-app">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label>FIM</label>
                            <input type="time" name="horario_fim" class="form-input"
                                value="{{ old('horario_fim') }}" required>
                            @error('horario_fim')
                                <p class="text-xs mt-1 text-red-app">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label>SALA</label>
                        <input type="text" name="sala" class="form-input"
                            placeholder="ex: Lab 3, Sala 201"
                            value="{{ old('sala') }}">
                    </div>

                    <div>
                        <label>LIMITE DE FALTAS</label>
                        <input type="number" name="limite_faltas" class="form-input"
                            placeholder="ex: 15" min="1"
                            value="{{ old('limite_faltas') }}" required>
                        @error('limite_faltas')
                            <p class="text-xs mt-1 text-red-app">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn-primary w-full justify-center mt-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                        </svg>
                        Cadastrar Aula
                    </button>
                </form>
            </div>
            <div class="card fade-up delay-2 lg:col-span-2 table-card">
                <div class="px-6 py-4 border-bottom-app">
                    <h2 class="font-display font-bold text-base">Aulas Cadastradas</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-row-app">
                                <th class="px-5 py-3 text-left text-xs font-semibold tracking-wider text-muted-app">DISCIPLINA</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold tracking-wider hidden md:table-cell text-muted-app">TURMA</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold tracking-wider hidden lg:table-cell text-muted-app">HORÁRIO</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold tracking-wider hidden lg:table-cell text-muted-app">SALA</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border-app">
                            @forelse ($aulas as $aula)
                            <tr class="table-row">
                                <td class="px-5 py-3">
                                    <p class="font-medium text-sm text-app">{{ $aula->nome }}</p>
                                    @if($aula->professor)
                                    <p class="text-xs mt-0.5 text-muted-app">{{ $aula->professor }}</p>
                                    @endif
                                </td>
                                <td class="px-4 py-3 hidden md:table-cell">
                                    <span class="turma-pill">{{ $aula->turma->nome ?? '—' }}</span>
                                </td>
                                <td class="px-4 py-3 hidden lg:table-cell">
                                    <span class="dia-pill">{{ ucfirst($aula->dia_semana) }}</span>
                                    <p class="text-xs mt-1 text-muted-app">
                                        {{ \Carbon\Carbon::parse($aula->horario_inicio)->format('H:i') }} –
                                        {{ \Carbon\Carbon::parse($aula->horario_fim)->format('H:i') }}
                                    </p>
                                </td>
                                <td class="px-4 py-3 hidden lg:table-cell text-sm text-muted-app">
                                    {{ $aula->sala ?? '—' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-sm text-muted-app">
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
