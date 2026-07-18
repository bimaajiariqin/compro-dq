@extends('Admin.layouts.app')

@section('title', 'Tambah Admin')
@section('breadcrumb', 'Sistem / Akun Admin')
@section('page-title', 'Tambah Admin')

@section('content')
<div class="max-w-lg">
    <div class="rounded-2xl border border-black/5 bg-white p-6">
        <form method="POST" action="{{ route('users.store') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-ink/70 mb-1.5">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                       placeholder="nama@dompetalquran.id"
                       class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm placeholder:text-ink/30
                              focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                @error('email') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-ink/70 mb-1.5">Password</label>
                <input id="password" name="password" type="password" required
                       class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                              focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                @error('password') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                <p class="mt-1.5 text-xs text-ink/40">Minimal 8 karakter.</p>
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-ink/70 mb-1.5">Konfirmasi Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                       class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                              focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="rounded-xl bg-emerald-800 hover:bg-emerald-900 transition text-white text-sm font-medium px-5 py-2.5">
                    Simpan
                </button>
                <a href="{{ route('users.index') }}" class="text-sm text-ink/50 hover:text-ink">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection