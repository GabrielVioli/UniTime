<x-layouts.app title="Pagina nao encontrada | UniTime">
    <main class="flex min-h-screen items-center justify-center px-6 py-10">
        <section class="max-w-lg text-center">
            <p class="text-sm font-semibold uppercase tracking-[0.18em] text-emerald-700">Erro 404</p>
            <h1 class="mt-4 text-4xl font-semibold tracking-tight sm:text-5xl">Pagina nao encontrada</h1>
            <p class="mt-4 text-sm leading-6 text-zinc-600">O endereco acessado nao existe ou foi removido.</p>

            <div class="mt-8 flex flex-col justify-center gap-3 sm:flex-row">
                @auth
                    <a href="{{ route('authenticated.dashboard') }}" class="rounded-md bg-emerald-700 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-800">Ir ao dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="rounded-md bg-emerald-700 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-800">Ir ao login</a>
                @endauth
                <a href="javascript:history.back()" class="rounded-md border border-zinc-300 px-4 py-2.5 text-sm font-medium text-zinc-700 transition hover:bg-zinc-100">Voltar</a>
            </div>
        </section>
    </main>
</x-layouts.app>
