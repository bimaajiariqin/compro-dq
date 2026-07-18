<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') · Admin Dompet Al-Qur'an Indonesia</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Tailwind via CDN — no build step required. Swap for the Vite pipeline whenever the project sets one up. --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        emerald: {
                            950: '#0B2B1F',
                            900: '#0F3D2B',
                            800: '#155238',
                            700: '#1B6B49',
                            600: '#22815A',
                        },
                        gold: {
                            500: '#C9A227',
                            400: '#D6B94D',
                            100: '#F5ECC9',
                        },
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
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-thumb { background: #DDD8C6; border-radius: 999px; }
    </style>
    @stack('styles')
</head>
<body class="bg-paper text-ink antialiased">

    <div class="min-h-screen">
        @include('Admin.layouts.sidebar')

        <div class="flex flex-col min-w-0 min-h-screen lg:ml-72">
            @include('Admin.layouts.navbar')

            <main class="flex-1 p-6 lg:p-8">
                @if (session('success'))
                    <div class="mb-6 rounded-xl border border-emerald-700/20 bg-emerald-700/5 px-4 py-3 text-sm text-emerald-800">
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </main>

            @include('Admin.layouts.footer')
        </div>
    </div>

    {{-- Mobile sidebar toggle --}}
    <script>
        const sidebarEl = document.getElementById('sidebar');
        const overlayEl = document.getElementById('sidebarOverlay');
        const toggleBtn = document.getElementById('sidebarToggle');

        function closeSidebar() {
            sidebarEl?.classList.add('-translate-x-full');
            overlayEl?.classList.add('hidden');
        }
        function openSidebar() {
            sidebarEl?.classList.remove('-translate-x-full');
            overlayEl?.classList.remove('hidden');
        }

        toggleBtn?.addEventListener('click', () => {
            sidebarEl?.classList.contains('-translate-x-full') ? openSidebar() : closeSidebar();
        });
        overlayEl?.addEventListener('click', closeSidebar);
    </script>
    @stack('scripts')
</body>
</html>