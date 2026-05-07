<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin - Unitimes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-slate-100">

    <header class="bg-white border-b border-slate-200 shadow-sm">
        <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Unitimes</h1>
                <p class="text-sm text-slate-500">Painel administrativo</p>
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
                    Gerenciamento de aulas
                </h2>

                <p class="text-slate-500 mt-2">
                    Aqui o administrador poderá cadastrar, editar e excluir aulas e horários das turmas.
                </p>

                <div class="mt-6">
                    <a href="#"
                        class="inline-block bg-blue-600 text-white px-5 py-2 rounded-lg font-medium hover:bg-blue-700 transition">
                        Nova aula
                    </a>
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-sm text-slate-500">Total de aulas</p>
                <h3 class="text-3xl font-bold text-slate-800 mt-2">--</h3>
            </div>

            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-sm text-slate-500">Turmas cadastradas</p>
                <h3 class="text-3xl font-bold text-slate-800 mt-2">--</h3>
            </div>

            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-sm text-slate-500">Salas utilizadas</p>
                <h3 class="text-3xl font-bold text-slate-800 mt-2">--</h3>
            </div>
        </section>

        <section class="bg-white rounded-2xl shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200">
                <h2 class="text-lg font-semibold text-slate-800">
                    Aulas cadastradas
                </h2>
                <p class="text-sm text-slate-500">
                    Lista temporária. Depois será alimentada pelo banco de dados.
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 text-slate-600">
                        <tr>
                            <th class="text-left px-6 py-3 font-medium">Disciplina</th>
                            <th class="text-left px-6 py-3 font-medium">Professor</th>
                            <th class="text-left px-6 py-3 font-medium">Dia</th>
                            <th class="text-left px-6 py-3 font-medium">Horário</th>
                            <th class="text-left px-6 py-3 font-medium">Sala</th>
                            <th class="text-left px-6 py-3 font-medium">Ações</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-200">
                        <tr>
                            <td class="px-6 py-4 text-slate-800">Engenharia de Software</td>
                            <td class="px-6 py-4 text-slate-600">Prof. Renato</td>
                            <td class="px-6 py-4 text-slate-600">Segunda-feira</td>
                            <td class="px-6 py-4 text-slate-600">19:00 - 22:30</td>
                            <td class="px-6 py-4 text-slate-600">Bloco B - Sala 203</td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="#"
                                        class="px-3 py-1 rounded-lg bg-yellow-100 text-yellow-700 font-medium hover:bg-yellow-200 transition">
                                        Editar
                                    </a>

                                    <button type="button"
                                        class="px-3 py-1 rounded-lg bg-red-100 text-red-700 font-medium hover:bg-red-200 transition">
                                        Excluir
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="px-6 py-4 text-slate-800">Banco de Dados</td>
                            <td class="px-6 py-4 text-slate-600">Prof. Carlos</td>
                            <td class="px-6 py-4 text-slate-600">Quarta-feira</td>
                            <td class="px-6 py-4 text-slate-600">20:50 - 22:30</td>
                            <td class="px-6 py-4 text-slate-600">Laboratório 2</td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="#"
                                        class="px-3 py-1 rounded-lg bg-yellow-100 text-yellow-700 font-medium hover:bg-yellow-200 transition">
                                        Editar
                                    </a>

                                    <button type="button"
                                        class="px-3 py-1 rounded-lg bg-red-100 text-red-700 font-medium hover:bg-red-200 transition">
                                        Excluir
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

    </main>

</body>

</html>