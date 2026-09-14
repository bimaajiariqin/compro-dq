<header class="h-16 flex items-center justify-between gap-4 px-6 bg-white/80 backdrop-blur border-b border-black/5 sticky top-0 z-20">
    <div class="flex items-center gap-3 min-w-0">
        <button id="sidebarToggle" type="button" class="lg:hidden p-2 -ml-2 rounded-lg hover:bg-black/5 shrink-0">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                <path d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
        <div class="min-w-0">
            <p class="text-xs text-ink/50">@yield('breadcrumb', 'Admin')</p>
            <h1 class="font-display text-lg text-ink truncate">@yield('page-title', 'Dashboard')</h1>
        </div>
    </div>

    <div class="flex items-center gap-3 shrink-0">
        <div class="hidden sm:flex flex-col items-end leading-tight">
            <span class="text-sm font-medium text-ink">{{ Str::before(auth()->user()->email, '@') }}</span>
            <span class="text-xs text-ink/40">Administrator</span>
        </div>
        <div class="h-9 w-9 rounded-full bg-emerald-800 text-white flex items-center justify-center font-display text-sm">
            {{ strtoupper(substr(auth()->user()->email, 0, 1)) }}
        </div>
    </div>
</header>