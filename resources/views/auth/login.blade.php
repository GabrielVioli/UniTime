<x-auth.wrapper title="Login" subtitle="Bem-vindo de volta ao Unitimes.">
    <div class="mb-6">
        <h2 class="text-2xl font-bold tracking-tight text-[#0B1F3A]">Acessar conta</h2>
        <p class="mt-2 text-sm text-slate-500">Insira suas credenciais para entrar no sistema.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="text-sm font-semibold text-slate-700">E-mail institucional</label>
            <div class="relative mt-2">
                <svg class="pointer-events-none absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M4 6.5h16v11H4v-11Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                    <path d="m5 8 7 5 7-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" autofocus data-model="email"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-11 pr-3 text-sm outline-none transition focus:border-[#0B1F3A] focus:bg-white focus:ring-4 focus:ring-[#0B1F3A]/10">
            </div>
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="text-sm font-semibold text-slate-700">Senha</label>
            <div class="relative mt-2">
                <svg class="pointer-events-none absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M7 10V8a5 5 0 0 1 10 0v2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                    <path d="M6 10h12v9H6v-9Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                </svg>
                <input id="password" name="password" type="password" autocomplete="current-password" data-model="password"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-11 pr-12 text-sm outline-none transition focus:border-[#0B1F3A] focus:bg-white focus:ring-4 focus:ring-[#0B1F3A]/10">
                <button type="button" data-password-toggle="password" class="absolute right-3 top-1/2 -translate-y-1/2 rounded-md p-1 text-slate-400 transition hover:bg-slate-100 hover:text-[#0B1F3A]" aria-label="Mostrar senha">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z" stroke="currentColor" stroke-width="1.8"/>
                        <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" stroke="currentColor" stroke-width="1.8"/>
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
            <div class="mt-2 text-right">
                <a href="#" class="text-sm font-medium text-[#0B1F3A] transition hover:text-[#173D6D]">Esqueceu a senha?</a>
            </div>
        </div>

        <button type="submit" class="w-full rounded-xl bg-[#0B1F3A] px-4 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#173D6D] focus:outline-none focus:ring-4 focus:ring-[#0B1F3A]/20">
            Entrar
        </button>
    </form>

    <div class="mt-6 flex flex-col items-center gap-2 text-sm text-slate-500">
        <p>
            Nao tem conta?
            <a href="{{ route('register') }}" class="font-bold text-[#0B1F3A] transition hover:text-[#173D6D]">Criar conta</a>
        </p>
        <a href="{{ route('admin.login') }}" class="font-medium text-slate-500 transition hover:text-[#0B1F3A]">Acesso admin</a>
    </div>
</x-auth.wrapper>
