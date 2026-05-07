<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Unitimes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-slate-100 flex items-center justify-center px-4">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-slate-800">Unitimes</h1>
            <p class="text-slate-500 mt-2">Crie sua conta para acessar seus horários</p>
        </div>

        @if ($errors->any())
        <div class="mb-4 rounded-lg bg-red-100 border border-red-300 text-red-700 px-4 py-3">
            <ul class="text-sm list-disc list-inside">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-slate-700 mb-1">
                    Nome
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Digite seu nome"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1">
                    E-mail
                </label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Digite seu e-mail"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 mb-1">
                    Senha
                </label>
                <input type="password" id="password" name="password" placeholder="Digite sua senha"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="turma_id" class="block text-sm font-medium text-slate-700 mb-1">
                    Turma
                </label>
                <select id="turma_id" name="turma_id"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Selecione sua turma</option>

                    @foreach ($turmas as $turma)
                    <option value="{{ $turma->id }}" @selected(old('turma_id')==$turma->id)>
                        {{ $turma->nome }}
                    </option>
                    @endforeach
                </select>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700 transition">
                Criar conta
            </button>
        </form>

        <p class="text-center text-sm text-slate-600 mt-6">
            Já tem conta?
            <a href="{{ route('login') }}" class="text-blue-600 font-medium hover:underline">
                Entrar
            </a>
        </p>
    </div>

</body>

</html>