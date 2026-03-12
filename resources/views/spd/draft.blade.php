<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Draft SPD Saya</title>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
        }
    </style>
</head>

<body
    class="bg-[#FFF8F3] font-sans antialiased selection:bg-[#1C6DD0] selection:text-white relative min-h-screen flex flex-col">
    <!-- Background Gradients -->
    <div class="absolute -top-40 -right-40 -z-10 h-[500px] w-[500px] rounded-full bg-[#A3E4DB]/60 blur-3xl filter">
    </div>
    <div class="absolute top-20 -left-20 -z-10 h-[300px] w-[300px] rounded-full bg-[#FED1EF]/60 blur-3xl filter">
    </div>
    <div
        class="absolute bottom-0 right-0 -z-10 h-[600px] w-[600px] translate-y-1/2 rounded-full bg-[#1C6DD0]/20 blur-3xl filter">
    </div>

    <div class="w-full mx-auto flex max-w-7xl flex-col px-6 lg:px-8 relative z-50">
        <nav class="w-full flex h-24 items-center justify-between">
            <a href="{{ url('/') }}" class="flex items-center gap-3 hover:opacity-80 transition">
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
            </a>
            <div>
                @if(session('name'))
                    <div class="relative" id="user-menu-container">
                        <button onclick="toggleUserMenu()"
                            class="flex items-center gap-2 text-sm font-semibold text-slate-900 border border-slate-200 rounded-full px-3 py-1 hover:bg-slate-50 transition focus:outline-none bg-white/50 backdrop-blur-sm">
                            Halo, <span class="text-[#1C6DD0]">{{ session('name') ?? ($user->name ?? 'User') }}</span>
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
                                <p class="text-sm font-semibold text-slate-900 truncate">
                                    {{ session('name') ?? ($user->name ?? 'User') }}
                                </p>
                            </div>
                            @if(!request()->routeIs('landing') && !request()->is('/'))
                                <a href="{{ route('landing') }}"
                                    class="flex items-center gap-2 rounded-lg px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                    </svg>
                                    Halaman Utama
                                </a>
                            @endif
                            @if(session('role') === 'admin' && !request()->routeIs('admin.dashboard'))
                                <a href="{{ route('admin.dashboard') }}"
                                    class="flex items-center gap-2 rounded-lg px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                                    </svg>
                                    Admin Dashboard
                                </a>
                            @endif
                            @if(!request()->routeIs('spd.draft') && !request()->routeIs('spd.index'))
                                <a href="{{ route('spd.draft') }}"
                                    class="flex items-center gap-2 rounded-lg px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                    Dokumen Saya
                                </a>
                            @endif
                            <a href="{{ route('logout') }}"
                                class="flex items-center gap-2 rounded-lg px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition"
                                onclick="event.preventDefault(); document.getElementById('logout-form-spd').submit();">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                                </svg>
                                Logout
                            </a>
                            <form id="logout-form-spd" action="{{ route('logout') }}" method="GET" class="hidden">
                                @csrf
                            </form>
                        </div>
                    </div>
                    <script>
                        function toggleUserMenu() {
                            const menu = document.getElementById('user-menu');
                            if (menu.style.display === 'none' || menu.classList.contains('hidden')) {
                                menu.classList.remove('hidden');
                                menu.style.display = 'block';
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
                                }, 200);
                            }
                        }
                        document.addEventListener('click', function (event) {
                            const container = document.getElementById('user-menu-container');
                            const menu = document.getElementById('user-menu');
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
    </div>

    <div class="mx-auto max-w-7xl px-6 lg:px-8 relative z-10">
        <div class="mb-4">
            <a href="{{ url('/') }}"
                class="inline-flex items-center gap-2 text-slate-500 hover:text-slate-700 text-sm font-medium transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 12H5"></path>
                    <path d="M12 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Beranda
            </a>
        </div>
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-slate-900">Manajemen Surat Perjalanan Dinas</h1>
        </div>

        <div class="max-w-5xl">
            {{-- Notification Container --}}
            <div
                class="fixed top-24 left-1/2 transform -translate-x-1/2 z-[100] w-full max-w-lg px-4 pointer-events-none">
                @if(session('success'))
                    <div
                        class="flash-message mb-4 p-4 bg-green-100 text-green-700 rounded-xl shadow-lg border border-green-200 pointer-events-auto flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div
                        class="flash-message mb-4 p-4 bg-red-100 text-red-700 rounded-xl shadow-lg border border-red-200 pointer-events-auto flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    setTimeout(function () {
                        const flashMessages = document.querySelectorAll('.flash-message');
                        flashMessages.forEach(function (message) {
                            message.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                            message.style.opacity = '0';
                            message.style.transform = 'translateY(-20px)';
                            setTimeout(function () {
                                message.remove();
                            }, 500);
                        });
                    }, 3000);
                });
            </script>

            <form action="{{ route('spd.bulk_destroy') }}" method="POST" id="bulk-delete-form">
                @csrf



                <!-- Default Header -->
                <div id="default-header" class="mb-6 flex justify-between items-end transition-all duration-300">
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Draft SPD Saya</h2>
                        <p class="text-slate-500 text-sm">Dokumen yang masih bisa diedit.</p>
                    </div>
                    <a href="{{ route('spd.create') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-[#1C6DD0] text-white rounded-lg hover:bg-[#1653a1] transition font-medium text-sm shadow-sm hover:shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Buat SPD Baru
                    </a>
                </div>

                <!-- Bulk Selection Toolbar for Draft (Hidden by default) -->
                <div id="draft-bulk-toolbar"
                    class="hidden mb-6 bg-[#FFF8F3] border border-[#1C6DD0]/20 rounded-xl p-4 flex items-center justify-between shadow-sm transition-all duration-300">
                    <div class="flex items-center gap-4">
                        <span class="bg-blue-100 text-blue-700 font-bold px-3 py-1 rounded-lg text-sm">
                            <span id="draft-selected-count">0</span> Dipilih
                        </span>
                        <div class="h-6 w-px bg-slate-300"></div>
                        <div class="text-sm text-slate-600" id="draft-selection-hint">
                            Pilih dokumen untuk aksi massal
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <!-- Actions -->
                        <button type="submit" id="draft-btn-delete-bulk" disabled
                            onclick="return confirm('Apakah Anda yakin ingin menghapus draft yang dipilih?')"
                            class="flex items-center gap-2 px-3 py-2 bg-white text-red-600 border border-red-200 rounded-lg hover:bg-red-50 disabled:opacity-50 disabled:cursor-not-allowed transition text-sm font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path
                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                </path>
                            </svg>
                            Hapus
                        </button>
                        <button type="button" onclick="cancelSelectMode('draft')"
                            class="px-4 py-2 bg-slate-100 text-slate-600 rounded-lg hover:bg-slate-200 transition text-sm font-medium">
                            Batal
                        </button>
                    </div>
                </div>



                <!-- Bulk Selection Toolbar (Hidden by default) -->
                <!-- Removed Floating Toolbar -->

                <div class="bg-white rounded-xl shadow border border-slate-200">
                    <table class="w-full text-left border-collapse" id="draft-table">
                        <thead class="bg-slate-50 border-b border-slate-200">
                            <tr>
                                <th class="p-4 w-14 text-center draft-select-column hidden transition-all duration-300">
                                    <input type="checkbox" onclick="toggleAllCheckboxes(this, 'draft')"
                                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 w-5 h-5 cursor-pointer">
                                </th>
                                <th class="p-4 font-semibold text-slate-700 w-24 text-center relative z-20 group">
                                    <div id="draft-select-trigger-menu"
                                        class="absolute left-2 top-1/2 -translate-y-1/2 transition-opacity duration-200">
                                        <button type="button" onclick="toggleSelectMenu('draft')"
                                            class="p-1 rounded-full hover:bg-slate-200 text-slate-400 hover:text-slate-600 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="1.5"></circle>
                                                <circle cx="12" cy="5" r="1.5"></circle>
                                                <circle cx="12" cy="19" r="1.5"></circle>
                                            </svg>
                                        </button>
                                        <!-- Dropdown -->
                                        <div id="draft-select-dropdown"
                                            class="hidden absolute top-0 left-full ml-1 w-36 bg-white rounded-lg shadow-lg border border-slate-100 py-1 z-50 text-left">
                                            <button type="button" onclick="activateSelectMode('draft')"
                                                class="w-full text-left px-3 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition whitespace-nowrap">
                                                Pilih Dokumen
                                            </button>
                                        </div>
                                    </div>
                                    <span>No</span>
                                </th>
                                <th class="p-4 font-semibold text-slate-700 text-left">Maksud / Tujuan</th>
                                @if(session('role') === 'admin')
                                    <th class="p-4 font-semibold text-slate-700 w-40 text-left">Oleh</th>
                                @endif
                                <th class="p-4 font-semibold text-slate-700 w-40 text-left">Tanggal Surat</th>
                                <th class="p-4 font-semibold text-slate-700 text-center w-32">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($drafts as $draft)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="p-4 text-center draft-select-column hidden transition-all duration-300">
                                        <div class="flex justify-center items-center h-full">
                                            <input type="checkbox" name="ids[]" value="{{ $draft->id }}"
                                                class="draft-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500 w-5 h-5 cursor-pointer">
                                        </div>
                                    </td>
                                    <td class="p-4 text-center text-slate-500">{{ $loop->iteration }}</td>
                                    <td class="p-4 text-slate-900 text-left">
                                        {{ $draft->maksud ?? '(Belum diisi)' }}
                                    </td>
                                    @if(session('role') === 'admin')
                                        <td class="p-4 text-slate-500 text-sm text-left">
                                            {{ $draft->creator->name ?? 'Unknown' }}
                                        </td>
                                    @endif
                                    <td class="p-4 text-slate-600 text-left">
                                        {{ $draft->tanggal_surat ? \Carbon\Carbon::parse($draft->tanggal_surat)->locale('id')->isoFormat('D MMMM Y') : '-' }}
                                    </td>
                                    <td class="p-4 text-center">
                                        <a href="{{ route('spd.edit', ['id' => $draft->id]) }}"
                                            class="inline-block px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 font-medium text-sm transition">
                                            Lanjutkan
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ session('role') === 'admin' ? 5 : 4 }}"
                                        class="p-8 text-center text-slate-500 py-12">
                                        <div class="flex flex-row items-center justify-center gap-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-slate-300"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                                <polyline points="14 2 14 8 20 8"></polyline>
                                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                                <polyline points="10 9 9 9 8 9"></polyline>
                                            </svg>
                                            <div class="text-left">
                                                <span class="font-medium block text-slate-600">Belum ada draft
                                                    tersimpan.</span>
                                                <p class="text-xs text-slate-400">Mulai buat dokumen perjalanan dinas baru.
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Divider -->
                <div class="py-8">
                    <div class="w-full border-t border-slate-200"></div>
                </div>

                <!-- FINAL SPD / ARSIP SECTION -->
                <!-- FINAL SPD HEADER -->
                <!-- FINAL SPD HEADER -->
                <div id="final-header" class="mb-6 items-end transition-all duration-300">
                    <h2 class="text-xl font-bold text-slate-900">SPD Final / Arsip</h2>
                    <p class="text-slate-500 text-sm">Dokumen resmi yang siap dicetak atau diekspor.</p>
                </div>

                <!-- Bulk Selection Toolbar for Final (Hidden by default) -->
                <div id="final-bulk-toolbar"
                    class="hidden mb-6 bg-[#FFF8F3] border border-[#1C6DD0]/20 rounded-xl p-4 flex items-center justify-between shadow-sm transition-all duration-300">
                    <div class="flex items-center gap-4">
                        <span class="bg-blue-100 text-blue-700 font-bold px-3 py-1 rounded-lg text-sm">
                            <span id="final-selected-count">0</span> Dipilih
                        </span>
                        <div class="h-6 w-px bg-slate-300"></div>
                        <div class="text-sm text-slate-600" id="final-selection-hint">
                            Pilih dokumen untuk aksi massal
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <!-- Actions -->
                        <!-- Print Bulk -->
                        <button type="submit" id="final-btn-print-bulk" disabled
                            formaction="{{ route('spd.bulk_print') }}" formtarget="_blank"
                            class="flex items-center gap-2 px-3 py-2 bg-white text-slate-700 border border-slate-200 rounded-lg hover:bg-slate-50 disabled:opacity-50 disabled:cursor-not-allowed transition text-sm font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2">
                                </path>
                                <rect x="6" y="14" width="12" height="8"></rect>
                            </svg>
                            Cetak
                        </button>
                        <!-- Word Bulk -->
                        <button type="button" id="final-btn-word-bulk" disabled onclick="downloadSelectedWord()"
                            class="flex items-center gap-2 px-3 py-2 bg-white text-blue-700 border border-blue-200 rounded-lg hover:bg-blue-50 disabled:opacity-50 disabled:cursor-not-allowed transition text-sm font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <path d="M16 13H8"></path>
                                <path d="M16 17H8"></path>
                                <path d="M10 9H8"></path>
                            </svg>
                            Word
                        </button>

                        <button type="submit" id="final-btn-delete-bulk" disabled
                            onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen yang dipilih?')"
                            class="flex items-center gap-2 px-3 py-2 bg-white text-red-600 border border-red-200 rounded-lg hover:bg-red-50 disabled:opacity-50 disabled:cursor-not-allowed transition text-sm font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path
                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                </path>
                            </svg>
                            Hapus
                        </button>
                        <button type="button" onclick="cancelSelectMode('final')"
                            class="px-4 py-2 bg-slate-100 text-slate-600 rounded-lg hover:bg-slate-200 transition text-sm font-medium">
                            Batal
                        </button>
                    </div>
                </div>



                <div class="bg-white rounded-xl shadow border border-slate-200">
                    <table class="w-full text-left border-collapse" id="final-table">
                        <thead class="bg-slate-50 border-b border-slate-200">
                            <tr>
                                <th class="p-4 w-14 text-center final-select-column hidden transition-all duration-300">
                                    <input type="checkbox" onclick="toggleAllCheckboxes(this, 'final')"
                                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 w-5 h-5 cursor-pointer">
                                </th>
                                <th class="p-4 font-semibold text-slate-700 w-24 text-center relative z-20 group">
                                    <div id="final-select-trigger-menu"
                                        class="absolute left-2 top-1/2 -translate-y-1/2 transition-opacity duration-200">
                                        <button type="button" onclick="toggleSelectMenu('final')"
                                            class="p-1 rounded-full hover:bg-slate-200 text-slate-400 hover:text-slate-600 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="1.5"></circle>
                                                <circle cx="12" cy="5" r="1.5"></circle>
                                                <circle cx="12" cy="19" r="1.5"></circle>
                                            </svg>
                                        </button>
                                        <!-- Dropdown -->
                                        <div id="final-select-dropdown"
                                            class="hidden absolute top-0 left-full ml-1 w-36 bg-white rounded-lg shadow-lg border border-slate-100 py-1 z-50 text-left">
                                            <button type="button" onclick="activateSelectMode('final')"
                                                class="w-full text-left px-3 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition whitespace-nowrap">
                                                Pilih Dokumen
                                            </button>
                                        </div>
                                    </div>
                                    <span>No</span>
                                </th>
                                <th class="p-4 font-semibold text-slate-700 w-32 text-left">Nomor Surat</th>
                                <th class="p-4 font-semibold text-slate-700 text-left">Maksud / Tujuan</th>
                                @if(session('role') === 'admin')
                                    <th class="p-4 font-semibold text-slate-700 w-40 text-left">Oleh</th>
                                @endif
                                <th class="p-4 font-semibold text-slate-700 w-40 text-left">Tanggal Surat</th>
                                <th class="p-4 font-semibold text-slate-700 text-center w-56">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($finals as $final)
                                <tr class="hover:bg-slate-50 transition border-b border-slate-100/50">
                                    <td class="p-4 text-center final-select-column hidden transition-all duration-300">
                                        <div class="flex justify-center items-center h-full">
                                            <input type="checkbox" name="ids[]" value="{{ $final->id }}"
                                                class="final-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500 w-5 h-5 cursor-pointer">
                                        </div>
                                    </td>
                                    <td class="p-4 text-center text-slate-500">{{ $loop->iteration }}</td>
                                    <td class="p-4 text-slate-900 font-medium text-left">
                                        {{ $final->nomor_surat ?? '-' }}
                                    </td>
                                    <td class="p-4 text-slate-600 text-left">
                                        {{ $final->maksud ?? '(Belum diisi)' }}
                                    </td>
                                    @if(session('role') === 'admin')
                                        <td class="p-4 text-slate-500 text-sm text-left">
                                            {{ $final->creator->name ?? 'Unknown' }}
                                        </td>
                                    @endif
                                    <td class="p-4 text-slate-600 text-left">
                                        {{ $final->tanggal_surat ? \Carbon\Carbon::parse($final->tanggal_surat)->locale('id')->isoFormat('D MMMM Y') : '-' }}
                                    </td>
                                    <td class="p-4 text-center">
                                        <div class="flex justify-center gap-2 items-center">
                                            <button type="button" onclick="toggleDetail('detail-{{ $final->id }}', this)"
                                                class="inline-flex items-center justify-center w-8 h-8 bg-slate-100 text-slate-500 rounded-lg hover:bg-slate-200 hover:text-slate-700 transition"
                                                title="Lihat Detail">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="transform transition-transform duration-200">
                                                    <polyline points="6 9 12 15 18 9"></polyline>
                                                </svg>
                                            </button>
                                            <a href="{{ route('spd.print.final', ['id' => $final->id]) }}" target="_blank"
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 font-medium text-sm transition border border-slate-300">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                                    <path
                                                        d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2">
                                                    </path>
                                                    <rect x="6" y="14" width="12" height="8"></rect>
                                                </svg>
                                                Cetak
                                            </a>
                                            <a href="{{ route('spd.export_word.final', ['id' => $final->id]) }}"
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 font-medium text-sm transition border border-blue-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path
                                                        d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z">
                                                    </path>
                                                    <polyline points="14 2 14 8 20 8"></polyline>
                                                    <path d="M16 13H8"></path>
                                                    <path d="M16 17H8"></path>
                                                    <path d="M10 9H8"></path>
                                                </svg>
                                                Word
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Expandable Detail Row -->
                                <tr id="detail-{{ $final->id }}" class="hidden bg-slate-50/50 border-t border-b border-slate-200">
                                    <td colspan="{{ session('role') === 'admin' ? 7 : 6 }}" class="p-4">
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-2">
                                            <!-- Pegawai Ditugaskan -->
                                            <div class="flex flex-col space-y-2">
                                                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">
                                                    Pegawai Ditugaskan</h4>
                                                @php
                                                    $pegawaiUtama = $final->pegawais->where('pivot.peran', 'utama')->first();
                                                    $pengikuts = $final->pegawais->where('pivot.peran', 'pengikut');
                                                @endphp
                                                <ul class="text-sm text-slate-700 space-y-2">
                                                    @if($pegawaiUtama)
                                                        <li class="flex flex-col">
                                                            <span
                                                                class="font-semibold text-slate-900">{{ $pegawaiUtama->nama }}</span>
                                                            <span class="text-xs text-slate-500">NIP. {{ $pegawaiUtama->nip }}
                                                                (Pegawai Utama)</span>
                                                        </li>
                                                    @endif
                                                    @foreach($pengikuts as $pengikut)
                                                        <li class="flex flex-col">
                                                            <span
                                                                class="font-medium text-slate-800">{{ $pengikut->nama }}</span>
                                                            <span class="text-xs text-slate-500">NIP. {{ $pengikut->nip }}
                                                                (Pengikut)</span>
                                                        </li>
                                                    @endforeach
                                                    @if(!$pegawaiUtama && $pengikuts->isEmpty())
                                                        <li class="text-slate-500 italic">Tidak ada data pegawai.</li>
                                                    @endif
                                                </ul>
                                            </div>

                                            <!-- Tempat Tujuan -->
                                            <div class="flex flex-col space-y-2">
                                                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Tempat
                                                    Tujuan</h4>
                                                <p class="text-sm text-slate-700 whitespace-pre-line">
                                                    {{ trim($final->tempat ?? '-') }}</p>
                                            </div>

                                            <!-- Tanggal Pelaksanaan -->
                                            <div class="flex flex-col space-y-2">
                                                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">
                                                    Tanggal Pelaksanaan</h4>
                                                <div class="text-sm text-slate-700">
                                                    <div class="grid grid-cols-[100px_auto] gap-1">
                                                        <span class="text-slate-500">Berangkat:</span>
                                                        <span>{{ $final->tgl_berangkat ? \Carbon\Carbon::parse($final->tgl_berangkat)->locale('id')->isoFormat('D MMMM Y') : '-' }}</span>
                                                        <span class="text-slate-500">Kembali:</span>
                                                        <span>{{ $final->tgl_kembali ? \Carbon\Carbon::parse($final->tgl_kembali)->locale('id')->isoFormat('D MMMM Y') : '-' }}</span>
                                                        <span class="text-slate-500">Lama (Hari):</span>
                                                        <span>{{ $final->lama_perjalanan ?? '-' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ session('role') === 'admin' ? 6 : 5 }}"
                                        class="p-8 text-center text-slate-500 py-12">
                                        <div class="flex flex-row items-center justify-center gap-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-slate-300"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                                <polyline points="14 2 14 8 20 8"></polyline>
                                                <path d="M12 18v-4"></path>
                                                <path d="M12 10h.01"></path>
                                            </svg>
                                            <div class="text-left">
                                                <span class="font-medium block text-slate-600">Belum ada dokumen
                                                    final.</span>
                                                <p class="text-xs text-slate-400">Dokumen yang sudah selesai akan muncul di
                                                    sini.</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

        </div>

        {{-- Script for handling checkboxes and Selection Mode --}}
        <script>
            function toggleSelectMenu(type) {
                const dropdown = document.getElementById(type + '-select-dropdown');
                if (dropdown.classList.contains('hidden')) {
                    // Close others first
                    document.querySelectorAll('[id$="-select-dropdown"]').forEach(el => el.classList.add('hidden'));
                    dropdown.classList.remove('hidden');
                } else {
                    dropdown.classList.add('hidden');
                }
            }

            // Close dropdowns when clicking outside
            document.addEventListener('click', function (e) {
                if (!e.target.closest('[id$="-select-trigger-menu"]')) {
                    document.querySelectorAll('[id$="-select-dropdown"]').forEach(el => el.classList.add('hidden'));
                }
            });

            function activateSelectMode(type) {
                // Ensure other mode is off
                const other = type === 'draft' ? 'final' : 'draft';
                toggleSelectMode(false, other);

                // Close dropdowns
                document.querySelectorAll('[id$="-select-dropdown"]').forEach(el => el.classList.add('hidden'));
                toggleSelectMode(true, type);
            }

            function cancelSelectMode(type) {
                toggleSelectMode(false, type);
            }

            function toggleSelectMode(forceOn = false, type = 'draft') {
                const header = document.getElementById(type === 'draft' ? 'default-header' : 'final-header');
                const toolbar = document.getElementById(type + '-bulk-toolbar');
                const selectColumns = document.querySelectorAll('.' + type + '-select-column');
                const checkboxes = document.querySelectorAll('.' + type + '-checkbox');
                const triggers = document.querySelectorAll('[id$="-select-trigger-menu"]'); // Common triggers

                // If forceOn is true, we want to ensure we enter mode
                if (forceOn) {
                    // Enter Select Mode
                    if (header) header.classList.add('hidden');
                    if (toolbar) toolbar.classList.remove('hidden');

                    selectColumns.forEach(el => {
                        el.classList.remove('hidden');
                    });

                    // Hide ALL triggers to avoid clutter/confusion
                    triggers.forEach(el => el.classList.add('hidden'));

                } else {
                    // Exit Select Mode
                    if (header) header.classList.remove('hidden');
                    if (toolbar) toolbar.classList.add('hidden');

                    selectColumns.forEach(el => {
                        el.classList.add('hidden');
                    });

                    // Show triggers again
                    triggers.forEach(el => el.classList.remove('hidden'));

                    // Untick all in this group
                    checkboxes.forEach(cb => cb.checked = false);

                    // Uncheck select all header logic if needed (simple way)
                    // document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false); // Global reset might be too aggressive if both active? But only one active at a time usually.

                    updateSelectionState(type);
                }
            }

            function toggleAllCheckboxes(source, type) {
                const table = source.closest('table');
                if (table) {
                    const checkboxes = table.querySelectorAll('.' + type + '-checkbox');
                    checkboxes.forEach(cb => cb.checked = source.checked);
                }
                updateSelectionState(type);
            }

            function updateSelectionState(type) {
                if (!type) return;

                const checkedBoxes = document.querySelectorAll('.' + type + '-checkbox:checked');
                const count = checkedBoxes.length;

                // Update counter
                const countEl = document.getElementById(type + '-selected-count');
                if (countEl) countEl.innerText = count;

                // Update Hint / Buttons
                const hintEl = document.getElementById(type + '-selection-hint');
                const btnDelete = document.getElementById(type + '-btn-delete-bulk');
                const btnPrint = document.getElementById(type + '-btn-print-bulk');
                const btnWord = document.getElementById(type + '-btn-word-bulk');

                if (count > 0) {
                    if (hintEl) hintEl.innerText = count + " dokumen siap diproses.";
                    if (btnDelete) btnDelete.disabled = false;
                    if (btnPrint) btnPrint.disabled = false;
                    if (btnWord) btnWord.disabled = false;
                } else {
                    if (hintEl) hintEl.innerText = "Pilih dokumen untuk aksi massal";
                    if (btnDelete) btnDelete.disabled = true;
                    if (btnPrint) btnPrint.disabled = true;
                    if (btnWord) btnWord.disabled = true;
                }
            }

            // Attach listeners to all row checkboxes
            document.addEventListener('DOMContentLoaded', () => {
                ['draft', 'final'].forEach(type => {
                    document.querySelectorAll('.' + type + '-checkbox').forEach(cb => {
                        cb.addEventListener('change', () => updateSelectionState(type));
                    });
                });
            });

            function downloadSelectedWord() {
                const checkedBoxes = document.querySelectorAll('.final-checkbox:checked');
                if (checkedBoxes.length === 0) {
                    alert('Pilih minimal satu dokumen.');
                    return;
                }

                // Show instruction if more than 1
                if (checkedBoxes.length > 1) {
                    // alert('Browser Anda mungkin akan meminta izin untuk mendownload beberapa file. Silakan klik "Allow" jika muncul.');
                }

                let delay = 0;
                checkedBoxes.forEach((cb, index) => {
                    const id = cb.value;
                    // Use timeout to stagger downloads
                    setTimeout(() => {
                        // Create a hidden iframe to trigger download without navigation
                        const iframe = document.createElement('iframe');
                        iframe.style.display = 'none';
                        iframe.src = "{{ url('/spd/export-word') }}/" + id;
                        document.body.appendChild(iframe);

                        // Clean up iframe after a while
                        setTimeout(() => {
                            document.body.removeChild(iframe);
                        }, 60000); // 1 minute cleanup
                    }, delay);

                    delay += 1000; // 1 second delay between each
                });
            }

            function toggleDetail(detailId, btn) {
                const detailRow = document.getElementById(detailId);
                const icon = btn.querySelector('svg');

                if (detailRow.classList.contains('hidden')) {
                    detailRow.classList.remove('hidden');
                    // Rotate icon up
                    icon.classList.add('rotate-180');
                    btn.classList.add('bg-slate-200', 'text-slate-700');
                    btn.classList.remove('bg-slate-100', 'text-slate-500');
                } else {
                    detailRow.classList.add('hidden');
                    // Reset icon rotation
                    icon.classList.remove('rotate-180');
                    btn.classList.remove('bg-slate-200', 'text-slate-700');
                    btn.classList.add('bg-slate-100', 'text-slate-500');
                }
            }
        </script>
        </form>

        <footer class="mt-auto py-6 text-center text-sm text-slate-500 relative z-50">
            &copy; 2026 Badan Keuangan Daerah. All rights reserved.
        </footer>
</body>

</html>