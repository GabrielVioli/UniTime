<x-auth.wrapper title="Cadastro" subtitle="Bem-vindo ao Unitimes.">
    <h2 class="mb-2 text-2xl font-bold text-[#0B1F3A]">Criar conta</h2>
    <p class="mb-6 text-sm text-slate-500">
        Preencha os dados para se cadastrar no sistema.
    </p>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="label">Nome completo</label>
            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name') }}"
                autocomplete="name"
                autofocus
                class="input"
            >

            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="label">E-mail institucional</label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
                autocomplete="email"
                class="input"
            >

            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="turma_id" class="label">Turma</label>
            <select id="turma_id" name="turma_id" class="input">
                <option value="">Selecione sua turma</option>

                @foreach ($turmas as $turma)
                    <option value="{{ $turma->id }}" @selected(old('turma_id') == $turma->id)>
                        {{ $turma->nome }}
                    </option>
                @endforeach
            </select>

            @error('turma_id')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="label">Senha</label>
            <input
                id="password"
                name="password"
                type="password"
                autocomplete="new-password"
                class="input"
            >

            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="label">Confirmar senha</label>
            <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                class="input"
            >
        </div>

        <button
            type="submit"
            class="w-full rounded-xl bg-[#0B1F3A] px-4 py-3 text-sm font-bold text-white transition hover:bg-[#173D6D]"
        >
            Criar conta
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-500">
        Ja tem conta?
        <a href="{{ route('login') }}" class="font-bold text-[#0B1F3A] hover:text-[#173D6D]">
            Fazer login
        </a>
    </p>
</x-auth.wrapper>
