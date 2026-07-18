@extends('Admin.layouts.app')

@section('title', 'Akun Admin')
@section('breadcrumb', 'Sistem')
@section('page-title', 'Akun Admin')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between flex-wrap gap-3">
        <div>
            <h2 class="font-display text-2xl text-ink">Akun Admin</h2>
            <p class="text-sm text-ink/50 mt-1">Kelola siapa saja yang punya akses ke panel admin ini.</p>
        </div>
        <a href="{{ route('users.create') }}"
           class="inline-flex items-center gap-2 rounded-xl bg-emerald-800 hover:bg-emerald-900 transition text-white text-sm font-medium px-4 py-2.5">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Tambah Admin
        </a>
    </div>

    @if (session('success'))
        <div class="rounded-xl border border-emerald-700/20 bg-emerald-700/5 px-4 py-3 text-sm text-emerald-800">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            {{ session('error') }}
        </div>
    @endif

    <div class="rounded-2xl border border-black/5 bg-white overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[520px] text-sm">
                <thead>
                    <tr class="border-b border-black/5 text-left text-xs uppercase tracking-wide text-ink/40">
                        <th class="px-6 py-3 font-medium">Admin</th>
                        <th class="hidden sm:table-cell px-6 py-3 font-medium">Terdaftar</th>
                        <th class="px-6 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="border-b border-black/5 last:border-0">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-9 w-9 rounded-full bg-emerald-800 text-white flex items-center justify-center font-display text-sm shrink-0">
                                        {{ strtoupper(substr($user->email, 0, 1)) }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="font-medium text-ink truncate">{{ $user->email }}</p>
                                        @if ($user->id === auth()->id())
                                            <span class="text-xs text-emerald-700">Akun Anda</span>
                                        @endif
                                        <p class="sm:hidden text-xs text-ink/40 mt-0.5">
                                            {{ $user->created_at?->translatedFormat('d M Y') }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="hidden sm:table-cell px-6 py-4 text-ink/50">
                                {{ $user->created_at?->translatedFormat('d M Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('users.edit', $user) }}" class="text-xs text-ink/50 hover:text-emerald-700">Edit</a>

                                    @if ($user->id !== auth()->id())
                                        <form method="POST" action="{{ route('users.destroy', $user) }}"
                                              onsubmit="return confirm('Hapus admin {{ $user->email }}? Tindakan ini tidak bisa dibatalkan.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs text-red-500 hover:text-red-700">Hapus</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-10 text-center text-sm text-ink/40">
                                Belum ada akun admin.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($users->hasPages())
        <div>{{ $users->links() }}</div>
    @endif

</div>
@endsection