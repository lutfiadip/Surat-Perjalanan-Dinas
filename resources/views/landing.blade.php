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

<body class="bg-slate-50 font-sans antialiased selection:bg-blue-500 selection:text-white">
    <div class="relative min-h-screen overflow-hidden">
        <!-- Background Gradients -->
        <div class="absolute -top-40 -right-40 -z-10 h-[500px] w-[500px] rounded-full bg-blue-400/20 blur-3xl filter">
        </div>
        <div class="absolute top-20 -left-20 -z-10 h-[300px] w-[300px] rounded-full bg-indigo-500/20 blur-3xl filter">
        </div>
        <div
            class="absolute bottom-0 right-0 -z-10 h-[600px] w-[600px] translate-y-1/2 rounded-full bg-slate-200/50 blur-3xl filter">
        </div>

        <div class="mx-auto flex min-h-screen max-w-7xl flex-col px-6 lg:px-8">
            <!-- Navbar -->
            <nav class="flex h-24 items-center justify-between">
                <div class="flex items-center gap-3">
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-blue-600 to-indigo-700 text-white shadow-lg shadow-blue-500/20">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-slate-900">SPD<span
                            class="text-blue-600">.Online</span></span>
                </div>
                <div>
                    <a href="{{ route('spd.form') }}"
                        class="text-sm font-semibold leading-6 text-slate-900 hover:text-blue-600 transition">Masuk
                        Operator &rarr;</a>
                </div>
            </nav>

            <!-- Hero Section -->
            <div
                class="flex flex-1 flex-col justify-center pb-24 pt-10 sm:pb-32 lg:flex-row lg:items-center lg:gap-x-10 lg:pb-40 lg:pt-20">
                <div class="mx-auto max-w-2xl lg:mx-0 lg:flex-auto">
                    <div class="mb-8 flex">
                        <div
                            class="relative rounded-full px-3 py-1 text-sm leading-6 text-slate-500 ring-1 ring-slate-900/10 hover:ring-slate-900/20 bg-white/50 backdrop-blur-sm">
                            Sistem Pengelolaan BKD Karanganyar <a href="#" class="font-semibold text-blue-600"><span
                                    class="absolute inset-0" aria-hidden="true"></span>versi 2.0</a>
                        </div>
                    </div>
                    <h1 class="mt-2 max-w-lg text-4xl font-bold tracking-tight text-slate-900 sm:text-6xl">
                        Pengelolaan Perjalanan Dinas Yang <span
                            class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Efisien</span>
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-slate-600">
                        Platform terintegrasi untuk pembuatan, pengelolaan, dan pelaporan Surat Perjalanan Dinas (SPD)
                        di lingkungan Badan Keuangan Daerah. Cepat, Tepat, dan Akuntabel.
                    </p>
                    <div class="mt-10 flex items-center gap-x-6">
                        <a href="{{ route('spd.form') }}"
                            class="group relative flex items-center gap-2 rounded-xl bg-slate-900 px-6 py-3.5 text-sm font-semibold text-white shadow-lg transition-all hover:bg-slate-800 hover:shadow-blue-500/25 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Buat SPD Baru
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="h-4 w-4 transition-transform group-hover:translate-x-1">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                        <a href="#prosedur" class="text-sm font-semibold leading-6 text-slate-900">Lihat Prosedur <span
                                aria-hidden="true">→</span></a>
                    </div>
                </div>

                <!-- Visual Decoration (Right Side) -->
                <div class="mt-16 sm:mt-24 lg:mt-0 lg:flex-shrink-0 lg:flex-grow">
                    <div class="relative mx-auto w-full max-w-lg lg:max-w-none">
                        <!-- Abstract Cards UI -->
                        <div
                            class="relative z-10 w-full rounded-2xl bg-white/60 p-2 shadow-2xl shadow-blue-500/20 backdrop-blur-xl ring-1 ring-white/50 lg:w-[480px] hover:scale-[1.01] transition duration-500">
                            <!-- Dashboard UI Container -->
                            <div
                                class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-900/5 min-h-[320px] flex flex-col relative overflow-hidden">
                                <!-- Decorative Header -->
                                <div class="flex items-center justify-between mb-6">
                                    <div>
                                        <div class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                                            Aktivitas Terkini</div>
                                        <div class="text-lg font-bold text-slate-900">Monitoring SPD</div>
                                    </div>
                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-50 text-blue-600 animate-pulse">
                                        <div class="h-2 w-2 rounded-full bg-blue-600"></div>
                                    </div>
                                </div>

                                <!-- List Items -->
                                <div class="space-y-4">
                                    <!-- Item 1 -->
                                    <div
                                        class="flex items-center gap-3 p-3 rounded-lg bg-slate-50 border border-slate-100">
                                        <div
                                            class="h-10 w-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-xs">
                                            BS</div>
                                        <div class="flex-1 min-w-0">
                                            <div class="text-sm font-semibold text-slate-900 truncate">Budi Santoso
                                            </div>
                                            <div class="text-xs text-slate-500 truncate">Ke Semarang (2 Hari)</div>
                                        </div>
                                        <div
                                            class="px-2 py-1 rounded-full bg-green-100 text-green-700 text-[10px] font-bold">
                                            DISETUJUI</div>
                                    </div>

                                    <!-- Item 2 -->
                                    <div
                                        class="flex items-center gap-3 p-3 rounded-lg bg-slate-50 border border-slate-100">
                                        <div
                                            class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center text-white font-bold text-xs">
                                            AD</div>
                                        <div class="flex-1 min-w-0">
                                            <div class="text-sm font-semibold text-slate-900 truncate">Ayu Diah</div>
                                            <div class="text-xs text-slate-500 truncate">Ke Yogyakarta (3 Hari)</div>
                                        </div>
                                        <div
                                            class="px-2 py-1 rounded-full bg-amber-100 text-amber-700 text-[10px] font-bold">
                                            MENUNGGU</div>
                                    </div>

                                    <!-- Item 3 -->
                                    <div
                                        class="flex items-center gap-3 p-3 rounded-lg bg-slate-50 border border-slate-100 opacity-60">
                                        <div
                                            class="h-10 w-10 rounded-full bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center text-white font-bold text-xs">
                                            RT</div>
                                        <div class="flex-1 min-w-0">
                                            <div class="text-sm font-semibold text-slate-900 truncate">Rudi Tri</div>
                                            <div class="text-xs text-slate-500 truncate">Ke Jakarta (1 Hari)</div>
                                        </div>
                                        <div
                                            class="px-2 py-1 rounded-full bg-slate-100 text-slate-600 text-[10px] font-bold">
                                            SELESAI</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Floating Stats Card -->
                            <div class="absolute -bottom-6 -left-6 z-20 w-48 rounded-xl bg-white p-4 shadow-xl ring-1 ring-slate-900/5 animate-bounce"
                                style="animation-duration: 4s;">
                                <div class="text-xs font-medium text-slate-500 mb-1">Total SPD Bulan Ini</div>
                                <div class="flex items-end gap-2">
                                    <div class="text-3xl font-bold text-blue-600">128</div>
                                    <div class="text-xs font-semibold text-green-600 mb-1">▲ 12%</div>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-1.5 mt-2">
                                    <div class="bg-blue-600 h-1.5 rounded-full" style="width: 70%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Features Grid -->
                    <div class="mx-auto max-w-7xl px-6 lg:px-8 pb-20">
                        <dl class="grid grid-cols-1 gap-x-8 gap-y-16 text-center lg:grid-cols-3">
                            <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                                <dt class="text-base leading-7 text-slate-600">Cetak Dokumen</dt>
                                <dd
                                    class="order-first text-3xl font-semibold tracking-tight text-slate-900 sm:text-5xl">
                                    Instan
                                </dd>
                            </div>
                            <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                                <dt class="text-base leading-7 text-slate-600">Format Surat</dt>
                                <dd
                                    class="order-first text-3xl font-semibold tracking-tight text-slate-900 sm:text-5xl">
                                    Standar
                                </dd>
                            </div>
                            <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                                <dt class="text-base leading-7 text-slate-600">Akses Sistem</dt>
                                <dd
                                    class="order-first text-3xl font-semibold tracking-tight text-slate-900 sm:text-5xl">
                                    24/7
                                </dd>
                            </div>
                        </dl>
                    </div>

                </div>
            </div>
</body>

</html>