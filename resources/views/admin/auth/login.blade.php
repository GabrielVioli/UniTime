<x-auth.wrapper title="Login admin" subtitle="Acesso administrativo do Unitimes.">
    <h2 class="mb-2 text-2xl font-bold text-[#0B1F3A]">Acessar admin</h2>
    <p class="mb-6 text-sm text-slate-500">
        Insira suas credenciais administrativas.
    </p>

    <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="label">E-mail</label>
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

        <div>
            <label for="admin_code" class="label">Codigo de admin</label>
            <input
                id="admin_code"
                name="admin_code"
                type="text"
                value="{{ old('admin_code') }}"
                autocomplete="off"
                class="input"
            >

            @error('admin_code')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <button
            type="submit"
            class="w-full rounded-xl bg-[#0B1F3A] px-4 py-3 text-sm font-bold text-white transition hover:bg-[#173D6D]"
        >
            Entrar como admin
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-500">
        Acesso de aluno?
        <a href="{{ route('login') }}" class="font-bold text-[#0B1F3A] hover:text-[#173D6D]">
            Fazer login
        </a>
    </p>
</x-auth.wrapper>
