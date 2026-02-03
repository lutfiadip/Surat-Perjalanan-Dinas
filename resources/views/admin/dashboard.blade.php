<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - SPD Sistem Perjalanan Dinas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body class="bg-[#FFF8F3] font-['Instrument_Sans'] min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-3">
                    <div
                        class="bg-gradient-to-br from-[#1C6DD0] to-[#155AB6] p-2 rounded-lg shadow-lg shadow-blue-500/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-slate-900 tracking-tight">Admin Dashboard</h1>
                        <p class="text-xs text-slate-500 font-medium">Sistem Perjalanan Dinas</p>
                    </div>
                </div>


            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-10 relative">
        <div class="max-w-4xl mx-auto">
            <div class="mb-6">
                <a href="{{ route('landing') }}"
                    class="inline-flex items-center gap-2 text-slate-500 hover:text-[#1C6DD0] text-sm font-medium transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 12h18M3 12l6-6M3 12l6 6" />
                    </svg>
                    Kembali ke Modul SPD
                </a>
            </div>

            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-slate-900 mb-3">Selamat Datang, Admin</h2>
                <p class="text-lg text-slate-600">Kelola data master aplikasi SPD dari panel ini.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Card 1: Data Pegawai -->
                <a href="{{ route('admin.pegawai.index') }}"
                    class="group bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-xl hover:border-[#1C6DD0]/30 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24 text-[#1C6DD0]" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <div class="relative z-10 flex flex-col items-start h-full">
                        <div
                            class="bg-blue-50 p-3 rounded-xl mb-4 group-hover:bg-[#1C6DD0] group-hover:text-white transition-colors duration-300 text-[#1C6DD0]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 group-hover:text-[#1C6DD0] transition-colors mb-2">
                            Data Pegawai</h3>
                        <p class="text-sm text-slate-500 leading-relaxed mb-4">Kelola daftar pegawai, NIP, pangkat, dan
                            status aktif/nonaktif.</p>
                        <div
                            class="mt-auto flex items-center text-sm font-semibold text-[#1C6DD0] opacity-80 group-hover:opacity-100">
                            Kelola Pegawai
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Card 2: Data Penandatangan -->
                <a href="{{ route('admin.penandatangan.index') }}"
                    class="group bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-xl hover:border-[#1C6DD0]/30 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24 text-[#1C6DD0]" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                            <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                            <path d="M12 11h4"></path>
                            <path d="M12 16h4"></path>
                            <path d="M8 11h.01"></path>
                            <path d="M8 16h.01"></path>
                        </svg>
                    </div>
                    <div class="relative z-10 flex flex-col items-start h-full">
                        <div
                            class="bg-blue-50 p-3 rounded-xl mb-4 group-hover:bg-[#1C6DD0] group-hover:text-white transition-colors duration-300 text-[#1C6DD0]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M15.28 2.32a3 3 0 1 0-4.24 4.24l-8.5 8.5a1 1 0 0 0-.29.7V20h4.24a1 1 0 0 0 .7-.29l8.5-8.5a1 1 0 0 0 0-1.42z">
                                </path>
                                <path d="M11 7l4 4"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 group-hover:text-[#1C6DD0] transition-colors mb-2">
                            Data Penandatangan</h3>
                        <p class="text-sm text-slate-500 leading-relaxed mb-4">Kelola pejabat penandatangan (Kepala
                            Badan, Sekretaris, dll).</p>
                        <div
                            class="mt-auto flex items-center text-sm font-semibold text-[#1C6DD0] opacity-80 group-hover:opacity-100">
                            Kelola Penandatangan
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Card 3: Data User -->
                <a href="{{ route('admin.users.index') }}"
                    class="group bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-xl hover:border-[#1C6DD0]/30 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24 text-[#1C6DD0]" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <div class="relative z-10 flex flex-col items-start h-full">
                        <div
                            class="bg-blue-50 p-3 rounded-xl mb-4 group-hover:bg-[#1C6DD0] group-hover:text-white transition-colors duration-300 text-[#1C6DD0]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 group-hover:text-[#1C6DD0] transition-colors mb-2">
                            Data User</h3>
                        <p class="text-sm text-slate-500 leading-relaxed mb-4">Kelola akun pengguna aplikasi dan hak
                            akses.</p>
                        <div
                            class="mt-auto flex items-center text-sm font-semibold text-[#1C6DD0] opacity-80 group-hover:opacity-100">
                            Kelola User
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </a>

            </div>
        </div>

        <!-- Decorative Blobs -->
        <div
            class="fixed top-20 left-10 w-64 h-64 bg-[#A3E4DB] rounded-full mix-blend-multiply filter blur-3xl opacity-20 -z-10 animate-blob">
        </div>
        <div
            class="fixed bottom-20 right-10 w-64 h-64 bg-[#FED1EF] rounded-full mix-blend-multiply filter blur-3xl opacity-20 -z-10 animate-blob animation-delay-2000">
        </div>
        <div
            class="fixed top-40 right-40 w-64 h-64 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -z-10 animate-blob animation-delay-4000">
        </div>

    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-100 mt-auto py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-slate-400 text-sm">
                &copy; {{ date('Y') }} Badan Keuangan Daerah. All rights reserved.
            </p>
        </div>
    </footer>

</body>

</html>