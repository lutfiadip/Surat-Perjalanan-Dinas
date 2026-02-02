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
                @if(session('nama'))
                    <div class="relative" id="user-menu-container">
                        <button onclick="toggleUserMenu()"
                            class="flex items-center gap-2 text-sm font-semibold text-slate-900 border border-slate-200 rounded-full px-3 py-1 hover:bg-slate-50 transition focus:outline-none bg-white/50 backdrop-blur-sm">
                            Halo, <span class="text-[#1C6DD0]">{{ session('nama') }}</span>
                            @if(session('role') === 'admin')
                                <span
                                    class="ml-2 px-2 py-0.5 rounded-full bg-red-100 text-red-700 text-xs font-bold border border-red-200">ADMIN</span>
                            @endif
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="h-4 w-4 text-slate-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <!-- Dropdown Menu -->
                        <div id="user-menu"
                            class="hidden absolute right-0 mt-2 w-48 origin-top-right rounded-xl bg-white p-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none z-50 transition-all duration-200 ease-out transform opacity-0 scale-95"
                            style="display: none;">
                            <div class="px-4 py-2 border-b border-gray-100 mb-1">
                                <p class="text-xs text-slate-500">Masuk sebagai</p>
                                <p class="text-sm font-semibold text-slate-900 truncate">{{ session('nama') }}</p>
                            </div>
                            <a href="{{ route('spd.draft') }}"
                                class="flex items-center gap-2 rounded-lg px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                                Draft Saya
                            </a>
                            <a href="{{ route('logout') }}"
                                class="flex items-center gap-2 rounded-lg px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-4 h-4">
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

            <form action="{{ route('spd.bulk_destroy') }}" method="POST" id="bulk-delete-form"
                onsubmit="return confirm('Apakah Anda yakin ingin menghapus item yang dipilih?')">
                @csrf

                {{-- Floating Action Button (Top Right) --}}
                <div class="fixed bottom-8 right-8 z-50">
                    <button type="submit" id="btn-delete-batch"
                        class="hidden bg-red-600 text-white rounded-full px-6 py-3 shadow-lg hover:bg-red-700 transition font-medium flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                            </path>
                        </svg>
                        Hapus Terpilih
                    </button>
                </div>

                <div class="mb-6 flex justify-between items-end">
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Draft SPD Saya</h2>
                        <p class="text-slate-500 text-sm">Dokumen yang masih bisa diedit.</p>
                    </div>
                    <a href="{{ route('spd.create') }}"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition shadow-sm hover:shadow-md">
                        + Buat SPD Baru
                    </a>
                </div>

                <div class="bg-white rounded-xl shadow border border-slate-200 overflow-hidden">
                    <table class="w-full text-left border-collapse table-fixed" id="draft-table">
                        <thead class="bg-slate-50 border-b border-slate-200">
                            <tr>
                                <th class="p-4 w-14 text-center">
                                    <input type="checkbox" onclick="toggleCheckboxes(this, 'draft-table')"
                                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                </th>
                                <th class="p-4 font-semibold text-slate-700 w-14 text-center">No</th>
                                <th class="p-4 font-semibold text-slate-700">Maksud / Tujuan</th>
                                @if(session('role') === 'admin')
                                    <th class="p-4 font-semibold text-slate-700 w-48">Oleh</th>
                                @endif
                                <th class="p-4 font-semibold text-slate-700 w-48">Tanggal Surat</th>
                                <th class="p-4 font-semibold text-slate-700 text-right w-32">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($drafts as $draft)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="p-4 text-center">
                                        <input type="checkbox" name="ids[]" value="{{ $draft->id }}"
                                            class="spd-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    </td>
                                    <td class="p-4 text-center text-slate-500">{{ $loop->iteration }}</td>
                                    <td class="p-4 text-slate-900">
                                        {{ $draft->maksud ?? '(Belum diisi)' }}
                                    </td>
                                    @if(session('role') === 'admin')
                                        <td class="p-4 text-slate-500 text-sm">
                                            {{ $draft->creator->nama ?? 'Unknown' }}
                                        </td>
                                    @endif
                                    <td class="p-4 text-slate-600">
                                        {{ $draft->tanggal_surat ? \Carbon\Carbon::parse($draft->tanggal_surat)->isoFormat('D MMMM Y') : '-' }}
                                    </td>
                                    <td class="p-4 text-right">
                                        <a href="{{ route('spd.edit', ['id' => $draft->id]) }}"
                                            class="inline-block px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 font-medium text-sm transition">
                                            Lanjutkan
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-12 text-center text-slate-500 py-20">
                                        <div class="flex flex-col items-center justify-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-slate-300 mb-2"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                                <polyline points="14 2 14 8 20 8"></polyline>
                                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                                <polyline points="10 9 9 9 8 9"></polyline>
                                            </svg>
                                            <span class="font-medium">Belum ada draft tersimpan.</span>
                                            <p class="text-xs text-slate-400">Mulai buat dokumen perjalanan dinas baru.</p>
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
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-slate-900">SPD Final / Arsip</h2>
                    <p class="text-slate-500 text-sm">Dokumen resmi yang siap dicetak atau diekspor.</p>
                </div>

                <div class="bg-white rounded-xl shadow border border-slate-200 overflow-hidden">
                    <table class="w-full text-left border-collapse table-fixed" id="final-table">
                        <thead class="bg-slate-50 border-b border-slate-200">
                            <tr>
                                <th class="p-4 w-14 text-center">
                                    <input type="checkbox" onclick="toggleCheckboxes(this, 'final-table')"
                                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                </th>
                                <th class="p-4 font-semibold text-slate-700 w-14 text-center">No</th>
                                <th class="p-4 font-semibold text-slate-700 w-48">Nomor Surat</th>
                                <th class="p-4 font-semibold text-slate-700">Maksud / Tujuan</th>
                                @if(session('role') === 'admin')
                                    <th class="p-4 font-semibold text-slate-700 w-48">Oleh</th>
                                @endif
                                <th class="p-4 font-semibold text-slate-700 w-48">Tanggal Surat</th>
                                <th class="p-4 font-semibold text-slate-700 text-right w-48">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($finals as $final)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="p-4 text-center">
                                        <input type="checkbox" name="ids[]" value="{{ $final->id }}"
                                            class="spd-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    </td>
                                    <td class="p-4 text-center text-slate-500">{{ $loop->iteration }}</td>
                                    <td class="p-4 text-slate-900 font-medium">
                                        {{ $final->nomor_surat ?? '-' }}
                                    </td>
                                    <td class="p-4 text-slate-600">
                                        {{ $final->maksud ?? '(Belum diisi)' }}
                                    </td>
                                    @if(session('role') === 'admin')
                                        <td class="p-4 text-slate-500 text-sm">
                                            {{ $final->creator->nama ?? 'Unknown' }}
                                        </td>
                                    @endif
                                    <td class="p-4 text-slate-600">
                                        {{ $final->tanggal_surat ? \Carbon\Carbon::parse($final->tanggal_surat)->isoFormat('D MMMM Y') : '-' }}
                                    </td>
                                    <td class="p-4 text-right flex justify-end gap-2">
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
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="p-12 text-center text-slate-500 py-20">
                                        <div class="flex flex-col items-center justify-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-slate-300 mb-2"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                                <polyline points="14 2 14 8 20 8"></polyline>
                                                <path d="M12 18v-4"></path>
                                                <path d="M12 10h.01"></path>
                                            </svg>
                                            <span>Belum ada dokumen final.</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

        </div>

        {{-- Script for handling checkboxes --}}
        <script>
            function toggleCheckboxes(source, tableId) {
                const checkboxes = document.querySelectorAll(`#${tableId} .spd-checkbox`);
                checkboxes.forEach(cb => cb.checked = source.checked);
                updateDeleteButton();
            }

            function updateDeleteButton() {
                const allCheckboxes = document.querySelectorAll('.spd-checkbox:checked');
                const btn = document.getElementById('btn-delete-batch');
                if (allCheckboxes.length > 0) {
                    btn.classList.remove('hidden');
                } else {
                    btn.classList.add('hidden');
                }
            }

            document.querySelectorAll('.spd-checkbox').forEach(cb => {
                cb.addEventListener('change', updateDeleteButton);
            });
        </script>
        </form>

        <footer class="mt-auto py-6 text-center text-sm text-slate-500 relative z-50">
            &copy; 2026 Badan Keuangan Daerah. All rights reserved.
        </footer>
</body>

</html>