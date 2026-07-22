{{-- Overlay for mobile --}}
<div id="sidebarOverlay" class="hidden fixed inset-0 bg-black/30 z-30 lg:hidden"></div>

<aside id="sidebar"
       class="fixed inset-y-0 left-0 z-40 w-72 -translate-x-full transition-transform duration-200 ease-out
              lg:translate-x-0
              flex flex-col bg-emerald-950 text-emerald-100/80">

    {{-- Brand / signature arch motif --}}
    <div class="relative px-6 pt-8 pb-6 border-b border-white/10 overflow-hidden">
        <div class="pointer-events-none absolute inset-x-6 -top-16 h-32 rounded-full border-b-2 border-gold-500/30"></div>
        <div class="relative">
            <p class="font-display text-lg text-white leading-tight">Dompet Al-Qur'an</p>
            <p class="font-display text-lg text-gold-400 leading-tight">Indonesia</p>
            <p class="mt-3 text-[11px] uppercase tracking-[0.2em] text-emerald-100/40">Panel Admin</p>
        </div>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
        <p class="px-3 text-[11px] uppercase tracking-[0.15em] text-emerald-100/30 mb-2">Menu Utama</p>

        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition
                  {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
            <svg class="w-4.5 h-4.5 shrink-0" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 10.5 12 3l9 7.5"/><path d="M5 9.5V21h14V9.5"/><path d="M9 21v-6h6v6"/>
            </svg>
            Dashboard
        </a>

        <p class="px-3 pt-5 text-[11px] uppercase tracking-[0.15em] text-emerald-100/30 mb-2">Konten</p>

        <a href="{{ route('admin.berita.index') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition
                  {{ request()->routeIs('admin.berita.*') ? 'bg-white/10 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 4h13a2 2 0 0 1 2 2v13a1 1 0 0 1-1 1H6a2 2 0 0 1-2-2V4Z"/><path d="M4 4v14a2 2 0 0 0 2 2"/><path d="M8 8h8M8 12h8M8 16h4"/>
            </svg>
            Berita
        </a>

        <a href="{{ route('admin.testimoni.index') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition
                  {{ request()->routeIs('admin.testimoni.*') ? 'bg-white/10 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15a2 2 0 0 1-2 2H8l-5 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2Z"/>
            </svg>
            Testimoni
        </a>

        <a href="{{ route('admin.penghargaan.index') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition
                  {{ request()->routeIs('admin.penghargaan.*') ? 'bg-white/10 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="8" r="5"/><path d="M8.5 12.5 7 21l5-3 5 3-1.5-8.5"/>
            </svg>
            Penghargaan
        </a>

        <a href="{{ route('admin.laporan-keuangan.index') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition
                  {{ request()->routeIs('admin.laporan-keuangan.*') ? 'bg-white/10 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 3v5h5"/><path d="M6 3h8l5 5v13a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Z"/><path d="M9 13h6M9 17h6"/>
            </svg>
            Laporan Keuangan
        </a>

        <a href="{{ route('admin.rekening-donasi.index') }}"
        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition
                {{ request()->routeIs('admin.rekening-donasi.*') ? 'bg-white/10 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/>
            </svg>
            Rekening Donasi
        </a>

        <a href="{{ route('admin.iklan.index') }}"
        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition
                {{ request()->routeIs('admin.iklan.*') ? 'bg-white/10 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="m21 15-5-5L5 21"/>
            </svg>
            Iklan
        </a>

        <a href="{{ route('admin.videokebaikan.index') }}"
        class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition
                {{ request()->routeIs('admin.videokebaikan.*') ? 'bg-white/10 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="4" width="15" height="16" rx="2"/><path d="m17 9 5-3v12l-5-3"/>
            </svg>
            Video Kebaikan
        </a>    

        <p class="px-3 pt-5 text-[11px] uppercase tracking-[0.15em] text-emerald-100/30 mb-2">Sistem</p>

        <a href="{{ route('admin.users.index') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition
                  {{ request()->routeIs('admin.users.*') ? 'bg-white/10 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="8" r="4"/><path d="M4 20c0-3.5 3.5-6 8-6s8 2.5 8 6"/>
            </svg>
            Akun Admin
        </a>

            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="flex w-full items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-emerald-100/70 hover:bg-white/5 hover:text-white transition">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="M16 17l5-5-5-5"/><path d="M21 12H9"/>
                    </svg>
                    Keluar
                </button>
            </form>
    </nav>
</aside>