<x-auth.wrapper title="Login" subtitle="Bem-vindo de volta ao Unitimes.">
    <h2 class="mb-2 text-2xl font-bold text-[#0B1F3A]">Acessar conta</h2>
    <p class="mb-6 text-sm text-slate-500">
        Insira suas credenciais para entrar no sistema.
    </p>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="label">E-mail institucional</label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
                autocomplete="email"
                autofocus
                class="input"
            >

            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="label">Senha</label>
            <input
                id="password"
                name="password"
                type="password"
                autocomplete="current-password"
                class="input"
            >

            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <button
            type="submit"
            class="w-full rounded-xl bg-[#0B1F3A] px-4 py-3 text-sm font-bold text-white transition hover:bg-[#173D6D]"
        >
            Entrar
        </button>
    </form>

    <div class="mt-6 space-y-2 text-center text-sm text-slate-500">
        <p>
            Nao tem conta?
            <a href="{{ route('register') }}" class="font-bold text-[#0B1F3A] hover:text-[#173D6D]">
                Criar conta
            </a>
        </p>

        <a href="{{ route('admin.login') }}" class="font-medium text-slate-500 hover:text-[#0B1F3A]">
            Acesso admin
        </a>
    </div>
</x-auth.wrapper>
