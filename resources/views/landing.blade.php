<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SPD - Sistem Perjalanan Dinas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap"
        rel="stylesheet">
</head>

<body class="bg-[#FFF8F3] font-sans antialiased selection:bg-[#1C6DD0] selection:text-white">
    <div class="relative min-h-screen overflow-hidden">
        <!-- Background Gradients -->
        <div class="absolute -top-40 -right-40 -z-10 h-[500px] w-[500px] rounded-full bg-[#A3E4DB]/60 blur-3xl filter">
        </div>
        <div class="absolute top-20 -left-20 -z-10 h-[300px] w-[300px] rounded-full bg-[#FED1EF]/60 blur-3xl filter">
        </div>
        <div
            class="absolute bottom-0 right-0 -z-10 h-[600px] w-[600px] translate-y-1/2 rounded-full bg-[#1C6DD0]/20 blur-3xl filter">
        </div>

        <div class="mx-auto flex min-h-screen max-w-7xl flex-col px-6 lg:px-8">
            <!-- Navbar -->
            <nav class="flex h-24 items-center justify-between">
                <div class="flex items-center gap-3">
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-[#1C6DD0] to-[#1653a1] text-white shadow-lg shadow-[#1C6DD0]/20">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-slate-900">SPD<span
                            class="text-[#1C6DD0]">.Online</span></span>
                </div>
                <div>
                    @if(isset($user) && $user)
                        <div class="relative" id="user-menu-container">
                            <button onclick="toggleUserMenu()"
                                class="flex items-center gap-2 text-sm font-semibold text-slate-900 border border-slate-200 rounded-full px-3 py-1 hover:bg-slate-50 transition focus:outline-none bg-white/50 backdrop-blur-sm">
                                Halo, <span class="text-[#1C6DD0]">{{ $user->nama }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" class="h-4 w-4 text-slate-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                            <!-- Dropdown Menu -->
                            <div id="user-menu"
                                class="hidden absolute right-0 mt-2 w-48 origin-top-right rounded-xl bg-white p-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none z-50 transition-all duration-200 ease-out transform opacity-0 scale-95"
                                style="transition: opacity 0.2s ease-out, transform 0.2s ease-out; display: none;">
                                <div class="px-4 py-2 border-b border-gray-100 mb-1">
                                    <p class="text-xs text-slate-500">Masuk sebagai</p>
                                    <p class="text-sm font-semibold text-slate-900 truncate">{{ $user->nama }}</p>
                                </div>
                                <a href="{{ route('spd.draft') }}"
                                    class="flex items-center gap-2 rounded-lg px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                    Draft Saya
                                </a>
                                <a href="{{ route('logout') }}"
                                    class="flex items-center gap-2 rounded-lg px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                                    </svg>
                                    Logout
                                </a>
                            </div>
                        </div>

                        <script>
                            function toggleUserMenu() {
                                const menu = document.getElementById('user-menu');
                                if (menu.style.display === 'none' || menu.classList.contains('hidden')) {
                                    menu.classList.remove('hidden');
                                    menu.style.display = 'block';
                                    // Small delay to allow display:block to apply before changing opacity for transition
                                    setTimeout(() => {
                                        menu.classList.remove('opacity-0', 'scale-95');
                                        menu.classList.add('opacity-100', 'scale-100');
                                    }, 10);
                                } else {
                                    menu.classList.remove('opacity-100', 'scale-100');
                                    menu.classList.add('opacity-0', 'scale-95');
                                    setTimeout(() => {
                                        menu.classList.add('hidden');
                                        menu.style.display = 'none';
                                    }, 200); // Match transition duration
                                }
                            }

                            // Close menu when clicking outside
                            document.addEventListener('click', function (event) {
                                const container = document.getElementById('user-menu-container');
                                const menu = document.getElementById('user-menu');
                                // Only close if menu is open (not hidden) and click is outside container
                                if (!container.contains(event.target) && menu.style.display !== 'none') {
                                    menu.classList.remove('opacity-100', 'scale-100');
                                    menu.classList.add('opacity-0', 'scale-95');
                                    setTimeout(() => {
                                        menu.classList.add('hidden');
                                        menu.style.display = 'none';
                                    }, 200);
                                }
                            });
                        </script>
                    @endif
                </div>
            </nav>

            <!-- Hero Section -->
            <div
                class="flex flex-1 flex-col justify-center pb-24 pt-10 sm:pb-32 lg:flex-row lg:items-center lg:gap-x-10 lg:pb-40 lg:pt-20">
                <div class="mx-auto max-w-2xl lg:mx-0 lg:flex-auto">
                    <div class="mb-8 flex">
                        <div
                            class="relative rounded-full px-3 py-1 text-sm leading-6 text-slate-500 ring-1 ring-slate-900/10 hover:ring-slate-900/20 bg-white/50 backdrop-blur-sm">
                            Sistem Pembuatan Surat Perjalanan Dinas (SPD) BKD Karanganyar
                        </div>
                    </div>
                    <h1 class="mt-2 max-w-lg text-4xl font-bold tracking-tight text-slate-900 sm:text-6xl">
                        Pengelolaan Perjalanan Dinas Yang <span
                            class="bg-gradient-to-r from-[#1C6DD0] to-[#1653a1] bg-clip-text text-transparent">Efisien</span>
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-slate-600">
                        Platform terintegrasi untuk pembuatan Surat Perjalanan Dinas (SPD)
                        di lingkungan Badan Keuangan Daerah.
                    </p>
                    <div class="mt-10 flex items-center gap-x-6">
                        @if(isset($user) && $user)
                            <a href="{{ route('spd.form') }}"
                                class="group relative flex items-center gap-2 rounded-xl bg-[#1C6DD0] px-6 py-3.5 text-sm font-semibold text-white shadow-lg transition-all hover:bg-[#1653a1] hover:shadow-[#1C6DD0]/25 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#1C6DD0]">
                                Buka Aplikasi
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" class="h-4 w-4 transition-transform group-hover:translate-x-1">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="group relative flex items-center gap-2 rounded-xl bg-[#1C6DD0] px-6 py-3.5 text-sm font-semibold text-white shadow-lg transition-all hover:bg-[#1653a1] hover:shadow-[#1C6DD0]/25 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#1C6DD0]">
                                Login
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" class="h-4 w-4 transition-transform group-hover:translate-x-1">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Visual Decoration (Right Side) -->
                <div class="mt-16 sm:mt-24 lg:mt-0 lg:flex-shrink-0 lg:flex-grow">
                    <div class="relative mx-auto w-full max-w-lg lg:max-w-none">
                        <!-- Abstract Cards UI -->
                        <div class="relative z-10 flex justify-center items-center w-full lg:w-auto p-10">
                            <img src="{{ asset('img/logo.png') }}" alt="Logo Kabupaten Karanganyar"
                                class="w-48 sm:w-64 lg:w-72 h-auto drop-shadow-2xl hover:scale-105 transition-transform duration-500">
                        </div>
                    </div>



                </div>
            </div>
</body>

</html>