<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Unitimes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-slate-100">

    <header class="bg-white shadow-sm border-b border-slate-200">
        <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Unitimes</h1>
                <p class="text-sm text-slate-500">Painel do aluno</p>
            </div>

            <form action="{{ route('authenticated.logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="bg-red-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-red-700 transition">
                    Sair
                </button>
            </form>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 py-8">

        <section class="mb-8">
            <div class="bg-white rounded-2xl shadow p-6">
                <h2 class="text-xl font-semibold text-slate-800">
                    Olá, {{ auth()->user()->name }}
                </h2>

                <p class="text-slate-600 mt-2">
                    Bem-vindo ao seu painel do Unitimes.
                </p>

                <div
                    class="mt-4 inline-flex items-center px-4 py-2 rounded-lg bg-blue-100 text-blue-700 text-sm font-medium">
                    Turma:
                    <span class="ml-1">
                        {{ auth()->user()->turma?->nome ?? 'Não informada' }}
                    </span>
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-sm text-slate-500">Total de disciplinas</p>
                <h3 class="text-3xl font-bold text-slate-800 mt-2">--</h3>
                <p class="text-sm text-slate-400 mt-2">Será carregado na próxima etapa</p>
            </div>

            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-sm text-slate-500">Faltas registradas</p>
                <h3 class="text-3xl font-bold text-slate-800 mt-2">--</h3>
                <p class="text-sm text-slate-400 mt-2">Será carregado na próxima etapa</p>
            </div>

            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-sm text-slate-500">Disciplinas em alerta</p>
                <h3 class="text-3xl font-bold text-slate-800 mt-2">--</h3>
                <p class="text-sm text-slate-400 mt-2">Será carregado na próxima etapa</p>
            </div>
        </section>

        <section class="bg-white rounded-2xl shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-lg font-semibold text-slate-800">
                        Resumo das faltas
                    </h2>
                    <p class="text-sm text-slate-500">
                        Aqui aparecerá o controle de faltas por disciplina.
                    </p>
                </div>
            </div>

            <div class="border border-dashed border-slate-300 rounded-xl p-8 text-center">
                <p class="text-slate-500">
                    O dashboard ainda está temporário.
                </p>
                <p class="text-sm text-slate-400 mt-2">
                    Depois serão exibidas as disciplinas, quantidade de faltas, limite e status.
                </p>
            </div>
        </section>

    </main>

</body>

</html>