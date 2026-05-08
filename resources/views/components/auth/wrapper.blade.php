@props([
    'title' => 'Unitimes',
    'subtitle' => 'Bem-vindo ao sistema academico.',
])

<x-layouts.app :title="$title . ' | Unitimes'">
    <main class="flex min-h-screen w-screen items-center justify-center bg-gray-50 px-4 py-10 font-sans text-slate-950 sm:px-6">
        <section class="w-full max-w-md">
            <div class="mb-7 text-center">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-[#0B1F3A] text-white shadow-sm">
                    <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M3 8.5 12 4l9 4.5-9 4.5L3 8.5Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                        <path d="M7 11v4.2c0 1.1 2.2 2.8 5 2.8s5-1.7 5-2.8V11" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        <path d="M20 9v5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                    </svg>
                </div>
                <h1 class="mt-4 text-3xl font-bold tracking-tight text-[#0B1F3A]">Unitimes</h1>
                <p class="mt-2 text-sm text-slate-500">{{ $subtitle }}</p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/70 sm:p-8">
                {{ $slot }}
            </div>
        </section>
    </main>
</x-layouts.app>
