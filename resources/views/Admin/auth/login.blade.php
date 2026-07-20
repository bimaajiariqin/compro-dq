<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk · Admin Dompet Al-Qur'an Indonesia</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        emerald: { 950: '#0B2B1F', 900: '#0F3D2B', 800: '#155238', 700: '#1B6B49' },
                        gold: { 500: '#C9A227', 400: '#D6B94D' },
                        paper: '#FAF9F4',
                        ink: '#1C2620',
                    },
                    fontFamily: {
                        display: ['Fraunces', 'serif'],
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-display { font-family: 'Fraunces', serif; font-variation-settings: 'opsz' 40; }
    </style>
</head>
<body class="bg-paper text-ink antialiased">

    <div class="min-h-screen grid lg:grid-cols-2">

        {{-- Branding panel --}}
        <div class="hidden lg:flex flex-col justify-between relative overflow-hidden bg-emerald-950 text-emerald-50 px-14 py-12">
            <div class="pointer-events-none absolute -top-24 -right-24 h-72 w-72 rounded-full border border-gold-500/20"></div>
            <div class="pointer-events-none absolute top-44 -right-12 h-40 w-40 rounded-full border border-gold-500/10"></div>

            <div class="relative">
                <p class="font-display text-2xl leading-tight">Dompet Al-Qur'an</p>
                <p class="font-display text-2xl text-gold-400 leading-tight">Indonesia</p>
            </div>

            <blockquote class="relative max-w-sm">
                <p class="font-display text-2xl leading-snug text-white/90">
                    &ldquo;Sebaik-baik manusia adalah yang paling bermanfaat bagi sesamanya.&rdquo;
                </p>
                <footer class="mt-4 text-sm text-emerald-100/50">Panel administrasi internal — khusus tim pengelola.</footer>
            </blockquote>

            <p class="relative text-xs text-emerald-100/30">&copy; {{ date('Y') }} Dompet Al-Qur'an Indonesia</p>
        </div>

        {{-- Login form panel --}}
        <div class="flex items-center justify-center px-6 py-12">
            <div class="w-full max-w-sm">

                <div class="lg:hidden mb-10 text-center">
                    <p class="font-display text-xl">Dompet Al-Qur'an Indonesia</p>
                    <p class="text-xs uppercase tracking-[0.2em] text-ink/40 mt-1">Panel Admin</p>
                </div>

                <h1 class="font-display text-2xl mb-1">Masuk ke Admin</h1>
                <p class="text-sm text-ink/50 mb-8">Masukkan kredensial administrator untuk melanjutkan.</p>

                @if ($errors->any())
                    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                        {{ $errors->first() }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-700">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-6 rounded-xl border border-emerald-700/20 bg-emerald-700/5 px-4 py-3 text-sm text-emerald-800">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-ink/70 mb-1.5">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                               placeholder="admin@dompetalquran.id"
                               class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm placeholder:text-ink/30
                                      focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-ink/70 mb-1.5">Password</label>
                        <input id="password" name="password" type="password" required
                               placeholder="••••••••"
                               class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm placeholder:text-ink/30
                                      focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                    </div>

                    <button type="submit"
                            class="w-full rounded-xl bg-emerald-800 hover:bg-emerald-900 transition text-white text-sm font-medium py-3">
                        Masuk
                    </button>
                </form>

                <p class="mt-6 text-center text-sm">
                    <a href="{{ route('home') }}" class="text-emerald-700 hover:text-emerald-800 font-medium">
                        Kembali ke Halaman Utama
                    </a>
                </p>

                <p class="mt-4 text-center text-xs text-ink/30">Akses hanya untuk administrator yang terdaftar.</p>
            </div>
        </div>
    </div>

</body>
</html>