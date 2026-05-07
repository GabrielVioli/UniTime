<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página não encontrada - Unitimes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-slate-100 flex items-center justify-center px-4">

    <main class="w-full max-w-lg bg-white rounded-2xl shadow-lg p-8 text-center">
        <div class="mb-6">
            <h1 class="text-7xl font-bold text-blue-600">404</h1>
            <h2 class="text-2xl font-semibold text-slate-800 mt-4">
                Página não encontrada
            </h2>
            <p class="text-slate-500 mt-3">
                A página que você tentou acessar não existe ou foi removida.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3 justify-center mt-8">
            @auth
            <a href="{{ route('authenticated.dashboard') }}"
                class="bg-blue-600 text-white px-5 py-2 rounded-lg font-medium hover:bg-blue-700 transition">
                Voltar para o dashboard
            </a>
            @else
            <a href="{{ route('login') }}"
                class="bg-blue-600 text-white px-5 py-2 rounded-lg font-medium hover:bg-blue-700 transition">
                Ir para login
            </a>
            @endauth

            <a href="javascript:history.back()"
                class="border border-slate-300 text-slate-700 px-5 py-2 rounded-lg font-medium hover:bg-slate-100 transition">
                Voltar
            </a>
        </div>
    </main>

</body>

</html>