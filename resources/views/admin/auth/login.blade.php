<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Unitimes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-slate-100 flex items-center justify-center px-4">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-slate-800">Unitimes</h1>
            <p class="text-slate-500 mt-2">Acesso administrativo</p>
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

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1">
                    E-mail administrativo
                </label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="admin@unitimes.com"
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
                <label for="admin_code" class="block text-sm font-medium text-slate-700 mb-1">
                    Código de administrador
                </label>
                <input type="text" id="admin_code" name="admin_code" value="{{ old('admin_code') }}"
                    placeholder="Digite o código de acesso"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700 transition">
                Entrar como administrador
            </button>
        </form>

        <div class="mt-6 text-center space-y-2">
            <p class="text-sm text-slate-600">
                É aluno?
                <a href="{{ route('login') }}" class="text-blue-600 font-medium hover:underline">
                    Ir para login do aluno
                </a>
            </p>

            <p class="text-sm text-slate-600">
                Ainda não tem conta?
                <a href="{{ route('register') }}" class="text-blue-600 font-medium hover:underline">
                    Criar conta de aluno
                </a>
            </p>
        </div>
    </div>

</body>

</html>