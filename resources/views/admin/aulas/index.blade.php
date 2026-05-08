<x-layouts.app title="Aulas | Unitimes">
    <main class="min-h-screen bg-gray-50 px-6 py-8">
        <section class="mx-auto max-w-6xl">
            <header class="mb-6 flex flex-col gap-4 rounded-2xl bg-white p-6 shadow-sm sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm font-semibold text-[#0B1F3A]">Unitimes Admin</p>
                    <h1 class="mt-1 text-2xl font-bold text-slate-950">Aulas cadastradas</h1>
                    <p class="mt-1 text-sm text-slate-500">Visao geral das aulas por turma.</p>
                </div>

                <form method="POST" action="{{ route('authenticated.logout') }}">
                    @csrf
                    <button type="submit" class="rounded-xl bg-[#0B1F3A] px-4 py-2.5 text-sm font-bold text-white transition hover:bg-[#173D6D]">
                        Sair
                    </button>
                </form>
            </header>

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm">
                @if ($aulas->isEmpty())
                    <p class="p-5 text-sm text-slate-500">Nenhuma aula cadastrada.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[860px] text-left text-sm">
                            <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                                <tr>
                                    <th class="px-5 py-3">Disciplina</th>
                                    <th class="px-5 py-3">Turma</th>
                                    <th class="px-5 py-3">Professor</th>
                                    <th class="px-5 py-3">Dia</th>
                                    <th class="px-5 py-3">Horario</th>
                                    <th class="px-5 py-3">Sala</th>
                                    <th class="px-5 py-3">Limite</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach ($aulas as $aula)
                                    <tr>
                                        <td class="px-5 py-4 font-semibold text-slate-950">{{ $aula->nome }}</td>
                                        <td class="px-5 py-4">{{ $aula->turma?->nome ?? 'Sem turma' }}</td>
                                        <td class="px-5 py-4">{{ $aula->professor ?? 'Nao informado' }}</td>
                                        <td class="px-5 py-4 capitalize">{{ $aula->dia_semana }}</td>
                                        <td class="px-5 py-4">{{ substr($aula->horario_inicio, 0, 5) }} - {{ substr($aula->horario_fim, 0, 5) }}</td>
                                        <td class="px-5 py-4">{{ $aula->sala }}</td>
                                        <td class="px-5 py-4">{{ $aula->limite_faltas }} faltas</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </section>
    </main>
</x-layouts.app>
