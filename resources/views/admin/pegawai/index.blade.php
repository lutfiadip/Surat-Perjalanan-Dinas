<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pegawai - Admin SPD</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body class="bg-[#FFF8F3] font-['Instrument_Sans'] antialiased selection:bg-[#1C6DD0] selection:text-white">
    <div class="relative min-h-screen overflow-hidden flex flex-col">
        <!-- Background Gradients -->
        <div class="absolute -top-40 -right-40 -z-10 h-[500px] w-[500px] rounded-full bg-[#A3E4DB]/60 blur-3xl filter">
        </div>
        <div class="absolute top-20 -left-20 -z-10 h-[300px] w-[300px] rounded-full bg-[#FED1EF]/60 blur-3xl filter">
        </div>
        <div
            class="absolute bottom-0 right-0 -z-10 h-[600px] w-[600px] translate-y-1/2 rounded-full bg-[#1C6DD0]/20 blur-3xl filter">
        </div>

        <!-- Header -->
        <header class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center gap-3">
                        <div class="bg-[#1C6DD0]/10 p-2 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#1C6DD0]" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-slate-900 tracking-tight">Data Pegawai</h1>
                            <p class="text-xs text-slate-500 font-medium">Master Data</p>
                        </div>
                    </div>


                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <!-- Alerts -->
            <!-- Floating Notification Container -->
            <div
                class="fixed top-24 left-1/2 transform -translate-x-1/2 z-[100] w-full max-w-lg px-4 pointer-events-none">
                @if(session('success'))
                    <div id="flash-message"
                        class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center justify-between gap-2 shadow-lg transition-all duration-500 pointer-events-auto"
                        role="alert">
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                        <button onclick="closeFlashMessage()"
                            class="text-green-500 hover:text-green-700 focus:outline-none rounded-full p-1 hover:bg-green-100 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <script>
                        function closeFlashMessage() {
                            const flash = document.getElementById('flash-message');
                            if (flash) {
                                flash.style.opacity = '0';
                                flash.style.transform = 'translateY(-20px)';
                                setTimeout(() => flash.remove(), 500);
                            }
                        }
                        setTimeout(closeFlashMessage, 3000); // Auto dismiss after 3 seconds
                    </script>
                @endif
            </div>

            <div class="mb-6">
                <a href="{{ route('admin.dashboard') }}"
                    class="inline-flex items-center gap-2 text-slate-500 hover:text-[#1C6DD0] text-sm font-medium transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <!-- Table Header -->
                <div
                    class="px-6 py-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <h2 class="text-lg font-bold text-slate-900">Daftar Pegawai</h2>

                    <div class="flex items-center gap-4 flex-1 justify-end">
                        <form method="GET" action="{{ route('admin.pegawai.index') }}" class="flex items-center gap-2">
                            @if(request('per_page'))
                                <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                            @endif



                            <div class="relative w-64">
                                <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none"
                                    style="padding-left: 0.7rem;">
                                    <svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                </div>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    style="padding-left: 2rem"
                                    class="block w-full pr-3 py-2 border border-slate-200 rounded-xl leading-5 bg-slate-50 text-slate-900 placeholder-slate-400 focus:outline-none focus:bg-white focus:ring-1 focus:ring-[#1C6DD0] focus:border-[#1C6DD0] sm:text-xs transition-colors"
                                    placeholder="Cari nama / NIP...">
                            </div>
                        </form>

                        <a href="{{ route('admin.pegawai.create') }}"
                            class="inline-flex items-center justify-center gap-2 bg-[#1C6DD0] hover:bg-[#155AB6] text-white text-sm font-semibold py-2 px-4 rounded-xl transition-colors shadow-lg shadow-blue-500/20 whitespace-nowrap">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            Tambah Pegawai
                        </a>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100">
                                <th
                                    class="px-8 py-5 text-xs font-semibold text-slate-500 uppercase tracking-wider w-16">
                                    No
                                </th>
                                <th class="px-8 py-5 text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama
                                    /
                                    NIP</th>
                                <th class="px-8 py-5 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                    Jabatan
                                    / Unit Kerja</th>
                                <th
                                    class="px-8 py-5 text-xs font-semibold text-slate-500 uppercase tracking-wider w-32">
                                    <button type="button" id="statusDropdownBtn" onclick="toggleStatusDropdown(event)"
                                        class="flex items-center gap-1 hover:text-[#1C6DD0] transition-colors focus:outline-none font-semibold uppercase">
                                        Status
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M6 9l6 6 6-6" />
                                        </svg>
                                    </button>
                                </th>
                                <th
                                    class="px-8 py-5 text-xs font-semibold text-slate-500 uppercase tracking-wider w-48 text-center">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($pegawai as $index => $item)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-8 py-5 text-sm text-slate-500">
                                        {{ $pegawai->firstItem() + $index }}
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="font-semibold text-slate-900">{{ $item->nama }}</div>
                                        <div class="text-xs text-slate-500 font-mono mt-0.5">{{ $item->nip ?? '-' }}</div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="text-sm text-slate-700">{{ $item->jabatan }}</div>
                                        <div class="text-xs text-slate-500 mt-0.5">{{ $item->pangkat_gol ?? '-' }}</div>
                                        @if($item->unit_kerja)
                                            <div class="text-xs text-slate-500 mt-1 italic">{{ $item->unit_kerja }}</div>
                                        @endif
                                    </td>
                                    <td class="px-8 py-5">
                                        @if($item->status_aktif)
                                            <span
                                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-100">
                                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                                Aktif
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white text-red-600 border border-red-600">
                                                Nonaktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-8 py-5 text-center align-middle">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.pegawai.edit', $item->id) }}"
                                                class="p-2 text-slate-400 hover:text-[#1C6DD0] hover:bg-blue-50 rounded-lg transition-all"
                                                title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                    </path>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.pegawai.toggle_status', $item->id) }}"
                                                method="POST" class="inline-block"
                                                onsubmit="return confirm('Apakah Anda yakin ingin mengubah status pegawai ini?')">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="p-2 {{ $item->status_aktif ? 'text-red-400 hover:text-red-600 hover:bg-red-50' : 'text-green-400 hover:text-green-600 hover:bg-green-50' }} rounded-lg transition-all"
                                                    title="{{ $item->status_aktif ? 'Nonaktifkan' : 'Aktifkan' }}">
                                                    @if($item->status_aktif)
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <circle cx="12" cy="12" r="10"></circle>
                                                            <line x1="15" y1="9" x2="9" y2="15"></line>
                                                            <line x1="9" y1="9" x2="15" y2="15"></line>
                                                        </svg>
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                                        </svg>
                                                    @endif
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="bg-slate-50 p-4 rounded-full mb-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-slate-300"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="9" cy="7" r="4"></circle>
                                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                                </svg>
                                            </div>
                                            <p class="font-medium">Belum ada data pegawai</p>
                                            <p class="text-xs mt-1">Klik tombol tambah untuk mulai memasukkan data.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div
                    class="px-6 py-4 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-4">
                    <div class="flex flex-col sm:flex-row items-center gap-4 text-sm text-slate-500">
                        <span>
                            Showing
                            <span class="font-medium text-slate-900">{{ $pegawai->firstItem() }}</span>
                            to
                            <span class="font-medium text-slate-900">{{ $pegawai->lastItem() }}</span>
                            of
                            <span class="font-medium text-slate-900">{{ $pegawai->total() }}</span>
                            results
                        </span>

                        <form method="GET" action="{{ route('admin.pegawai.index') }}" class="flex items-center gap-2">
                            <span class="hidden sm:inline text-slate-300">|</span>
                            <span>Tampilkan</span>
                            <select name="per_page" onchange="this.form.submit()"
                                class="bg-white border border-slate-200 text-slate-700 text-sm rounded-lg focus:ring-[#1C6DD0] focus:border-[#1C6DD0] block p-2 py-1">
                                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                            </select>
                            <span>data</span>
                        </form>
                    </div>

                    <div class="w-full md:w-auto">
                        {{ $pegawai->appends(['per_page' => request('per_page')])->links('vendor.pagination.admin-links') }}
                    </div>
                </div>
            </div>
        </main>

        <!-- Status Dropdown Menu (Fixed Position) -->
        <div id="statusDropdown"
            class="fixed bg-white rounded-lg shadow-xl border border-slate-100 py-1 hidden z-[100] w-32 transform transition-all duration-200 origin-top-left">
            <a href="{{ route('admin.pegawai.index', array_merge(request()->except('status'), ['status' => null])) }}"
                class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 {{ request('status') === null ? 'font-semibold bg-slate-50 text-[#1C6DD0]' : '' }}">
                Semua
            </a>
            <a href="{{ route('admin.pegawai.index', array_merge(request()->except('status'), ['status' => '1'])) }}"
                class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 {{ request('status') == '1' ? 'font-semibold bg-slate-50 text-[#1C6DD0]' : '' }}">
                Aktif
            </a>
            <a href="{{ route('admin.pegawai.index', array_merge(request()->except('status'), ['status' => '0'])) }}"
                class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 {{ request('status') == '0' ? 'font-semibold bg-slate-50 text-[#1C6DD0]' : '' }}">
                Nonaktif
            </a>
        </div>

        <script>
            function toggleStatusDropdown(event) {
                event.preventDefault();
                event.stopPropagation();
                const dropdown = document.getElementById('statusDropdown');
                const btn = document.getElementById('statusDropdownBtn');

                if (!dropdown || !btn) return;

                const rect = btn.getBoundingClientRect();

                if (dropdown.classList.contains('hidden')) {
                    // Show and position
                    dropdown.classList.remove('hidden');
                    // Position exactly below the button aligned to left
                    dropdown.style.top = (rect.bottom + 5) + 'px';
                    dropdown.style.left = rect.left + 'px';
                } else {
                    dropdown.classList.add('hidden');
                }
            }

            // Close dropdown when clicking outside
            document.addEventListener('click', function (event) {
                const dropdown = document.getElementById('statusDropdown');
                const btn = document.getElementById('statusDropdownBtn');
                if (dropdown && !dropdown.classList.contains('hidden') && !btn.contains(event.target) && !dropdown.contains(event.target)) {
                    dropdown.classList.add('hidden');
                }
            });

            // Handling sticky header issues - close on scroll
            window.addEventListener('scroll', function () {
                const dropdown = document.getElementById('statusDropdown');
                if (dropdown && !dropdown.classList.contains('hidden')) {
                    dropdown.classList.add('hidden');
                }
            }, true);
        </script>
    </div>
</body>

</html>