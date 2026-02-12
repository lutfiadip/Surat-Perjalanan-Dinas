<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User - Admin SPD</title>
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
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-slate-900 tracking-tight">Data User</h1>
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
                    <h2 class="text-lg font-bold text-slate-900">Daftar Pengguna Aplikasi</h2>
                    <a href="{{ route('admin.users.create') }}"
                        class="inline-flex items-center justify-center gap-2 bg-[#1C6DD0] hover:bg-[#155AB6] text-white text-sm font-semibold py-2 px-4 rounded-xl transition-colors shadow-lg shadow-blue-500/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Tambah User
                    </a>
                </div>

                <form action="{{ route('admin.users.bulk_destroy') }}" method="POST" id="bulk-delete-form">
                    @csrf

                    <!-- Bulk Toolbar -->
                    <div id="bulk-toolbar"
                        class="hidden px-6 py-4 bg-red-50 border-b border-red-100 flex items-center justify-between transition-all duration-300">
                        <div class="flex items-center gap-4">
                            <span class="bg-red-100 text-red-700 font-bold px-3 py-1 rounded-lg text-sm">
                                <span id="selected-count">0</span> Dipilih
                            </span>
                            <div class="text-sm text-red-600">
                                Pilih user untuk dihapus massal.
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <button type="submit" id="btn-delete-bulk" disabled
                                onclick="return confirm('Apakah Anda yakin ingin menghapus ' + document.getElementById('selected-count').innerText + ' user yang dipilih? Tindakan ini tidak dapat dibatalkan.')"
                                class="flex items-center gap-2 px-3 py-2 bg-white text-red-600 border border-red-200 rounded-lg hover:bg-red-50 disabled:opacity-50 disabled:cursor-not-allowed transition text-sm font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path
                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                    </path>
                                </svg>
                                Hapus Dipilih
                            </button>
                            <button type="button" onclick="toggleSelectMode()"
                                class="px-4 py-2 bg-white text-slate-600 border border-slate-200 rounded-lg hover:bg-slate-50 transition text-sm font-medium">
                                Batal
                            </button>
                        </div>
                    </div>



                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/50 border-b border-slate-100">
                                    <th
                                        class="px-4 py-5 text-center select-column hidden w-16 transition-all duration-300">
                                        <input type="checkbox" id="select-all" onclick="toggleAllCheckboxes(this)"
                                            class="rounded border-gray-300 text-red-600 focus:ring-red-500 w-5 h-5 cursor-pointer">
                                    </th>
                                    <th
                                        class="px-8 py-5 text-xs font-semibold text-slate-500 uppercase tracking-wider w-24">
                                        <div class="flex items-center gap-2 group relative">
                                            <div id="select-trigger-menu"
                                                class="opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                                <button type="button" onclick="toggleSelectMenu()"
                                                    class="p-1 rounded-full hover:bg-slate-200 text-slate-400 hover:text-slate-600 transition">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <circle cx="12" cy="12" r="1.5"></circle>
                                                        <circle cx="12" cy="5" r="1.5"></circle>
                                                        <circle cx="12" cy="19" r="1.5"></circle>
                                                    </svg>
                                                </button>
                                                <!-- Dropdown -->
                                                <div id="select-dropdown"
                                                    class="hidden absolute top-6 left-0 bg-white rounded-lg shadow-lg border border-slate-100 py-1 z-50 text-left w-32">
                                                    <button type="button" onclick="toggleSelectMode()"
                                                        class="w-full text-left px-3 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-red-600 transition whitespace-nowrap">
                                                        Pilih User
                                                    </button>
                                                </div>
                                            </div>
                                            <span>No</span>
                                        </div>
                                    </th>
                                    <th class="px-8 py-5 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                        Username
                                    </th>
                                    <th class="px-8 py-5 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                        Nama
                                        Lengkap</th>
                                    <th
                                        class="px-8 py-5 text-xs font-semibold text-slate-500 uppercase tracking-wider w-32">
                                        <button type="button" id="roleDropdownBtn"
                                            onclick="toggleDropdown(event, 'roleDropdown')"
                                            class="flex items-center gap-1 hover:text-[#1C6DD0] transition-colors focus:outline-none font-semibold uppercase">
                                            Role
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M6 9l6 6 6-6" />
                                            </svg>
                                        </button>
                                    </th>
                                    <th
                                        class="px-8 py-5 text-xs font-semibold text-slate-500 uppercase tracking-wider w-32">
                                        <button type="button" id="statusDropdownBtn"
                                            onclick="toggleDropdown(event, 'statusDropdown')"
                                            class="flex items-center gap-1 hover:text-[#1C6DD0] transition-colors focus:outline-none font-semibold uppercase">
                                            Status
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
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
                                @forelse($users as $index => $item)
                                    <tr class="hover:bg-slate-50/50 transition-colors">
                                        <td class="px-4 py-5 text-center select-column hidden transition-all duration-300">
                                            @if(session('user_id') != $item->id)
                                                <input type="checkbox" name="ids[]" value="{{ $item->id }}"
                                                    class="row-checkbox rounded border-gray-300 text-red-600 focus:ring-red-500 w-5 h-5 cursor-pointer"
                                                    onchange="updateSelectionState()">
                                            @endif
                                        </td>
                                        <td class="px-8 py-5 text-sm text-slate-500">
                                            {{ $users->firstItem() + $index }}
                                        </td>
                                        <td class="px-8 py-5">
                                            <span
                                                class="font-mono text-sm text-slate-700 bg-slate-100 px-2 py-1 rounded">{{ $item->username }}</span>
                                        </td>
                                        <td class="px-8 py-5">
                                            <div class="font-semibold text-slate-900">{{ $item->name }}</div>

                                        </td>
                                        <td class="px-8 py-5">
                                            @if($item->role === 'admin')
                                                <span
                                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-purple-50 text-purple-700 border border-purple-100">
                                                    ADMIN
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-600 border border-slate-200">
                                                    USER
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-8 py-5">
                                            @if($item->status === 'aktif')
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
                                        <td class="px-8 py-5 text-center flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.users.edit', $item->id) }}"
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
                                            @if(session('user_id') != $item->id)
                                                <form action="{{ route('admin.users.toggle_status', $item->id) }}" method="POST"
                                                    class="inline-block"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin mengubah status user ini?')">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="p-2 {{ $item->status === 'aktif' ? 'text-red-400 hover:text-red-600 hover:bg-red-50' : 'text-green-400 hover:text-green-600 hover:bg-green-50' }} rounded-lg transition-all"
                                                        title="{{ $item->status === 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}">
                                                        @if($item->status === 'aktif')
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

                                                <form action="{{ route('admin.users.destroy', $item->id) }}" method="POST"
                                                    class="inline-block"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini? Tindakan ini tidak dapat dibatalkan.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="p-2 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all"
                                                        title="Hapus Permanen">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                            <path
                                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                            <div class="flex flex-col items-center justify-center">
                                                <div class="bg-slate-50 p-4 rounded-full mb-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-slate-300"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                        <circle cx="12" cy="7" r="4"></circle>
                                                    </svg>
                                                </div>
                                                <p class="font-medium">Belum ada data user</p>
                                                <p class="text-xs mt-1">Klik tombol tambah untuk mulai membuat akun.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </form>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-slate-100">
                    {{ $users->links() }}
                </div>
            </div>
        </main>

        <!-- Role Dropdown Menu (Fixed Position) -->
        <div id="roleDropdown"
            class="fixed bg-white rounded-lg shadow-xl border border-slate-100 py-1 hidden z-[100] w-32 transform transition-all duration-200 origin-top-left">
            <a href="{{ route('admin.users.index', array_merge(request()->except('role'), ['role' => null])) }}"
                class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 {{ request('role') === null ? 'font-semibold bg-slate-50 text-[#1C6DD0]' : '' }}">
                Semua
            </a>
            <a href="{{ route('admin.users.index', array_merge(request()->except('role'), ['role' => 'admin'])) }}"
                class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 {{ request('role') == 'admin' ? 'font-semibold bg-slate-50 text-[#1C6DD0]' : '' }}">
                Admin
            </a>
            <a href="{{ route('admin.users.index', array_merge(request()->except('role'), ['role' => 'user'])) }}"
                class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 {{ request('role') == 'user' ? 'font-semibold bg-slate-50 text-[#1C6DD0]' : '' }}">
                User
            </a>
        </div>

        <!-- Status Dropdown Menu (Fixed Position) -->
        <div id="statusDropdown"
            class="fixed bg-white rounded-lg shadow-xl border border-slate-100 py-1 hidden z-[100] w-32 transform transition-all duration-200 origin-top-left">
            <a href="{{ route('admin.users.index', array_merge(request()->except('status'), ['status' => null])) }}"
                class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 {{ request('status') === null ? 'font-semibold bg-slate-50 text-[#1C6DD0]' : '' }}">
                Semua
            </a>
            <a href="{{ route('admin.users.index', array_merge(request()->except('status'), ['status' => 'aktif'])) }}"
                class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 {{ request('status') == 'aktif' ? 'font-semibold bg-slate-50 text-[#1C6DD0]' : '' }}">
                Aktif
            </a>
            <a href="{{ route('admin.users.index', array_merge(request()->except('status'), ['status' => 'nonaktif'])) }}"
                class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 {{ request('status') == 'nonaktif' ? 'font-semibold bg-slate-50 text-[#1C6DD0]' : '' }}">
                Nonaktif
            </a>
        </div>

        <script>
            function toggleDropdown(event, dropdownId) {
                event.preventDefault();
                event.stopPropagation();

                // Close all other dropdowns
                const allDropdowns = ['roleDropdown', 'statusDropdown'];
                allDropdowns.forEach(id => {
                    if (id !== dropdownId) {
                        const d = document.getElementById(id);
                        if (d) d.classList.add('hidden');
                    }
                });

                const dropdown = document.getElementById(dropdownId);
                const btn = event.currentTarget; // Get button that triggered event

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
                const allDropdowns = ['roleDropdown', 'statusDropdown'];
                allDropdowns.forEach(id => {
                    const dropdown = document.getElementById(id);
                    // We need to check if click is on ANY button that opens a dropdown, but simpler is just to close if not clicked inside dropdown
                    // and relying on stopPropagation in toggle function to handle button clicks
                    if (dropdown && !dropdown.classList.contains('hidden') && !dropdown.contains(event.target)) {
                        dropdown.classList.add('hidden');
                    }
                });
            });

            // Handling sticky header issues - close on scroll
            window.addEventListener('scroll', function () {
                const allDropdowns = ['roleDropdown', 'statusDropdown'];
                allDropdowns.forEach(id => {
                    const dropdown = document.getElementById(id);
                    if (dropdown && !dropdown.classList.contains('hidden')) {
                        dropdown.classList.add('hidden');
                    }
                });
            }, true);

            function toggleSelectMenu() {
                const dropdown = document.getElementById('select-dropdown');
                if (dropdown) dropdown.classList.toggle('hidden');
            }

            // Close select menu when clicking outside
            document.addEventListener('click', function (e) {
                const menu = document.getElementById('select-dropdown');
                const trigger = document.getElementById('select-trigger-menu');
                if (menu && !menu.classList.contains('hidden')) {
                    if (!trigger.contains(e.target)) {
                        menu.classList.add('hidden');
                    }
                }
            });

            // Bulk Selection Logic
            function toggleSelectMode() {
                const selectColumns = document.querySelectorAll('.select-column');
                const toolbar = document.getElementById('bulk-toolbar');
                const menu = document.getElementById('select-dropdown');

                // Hide menu if open
                if (menu) menu.classList.add('hidden');

                let isHidden = true;
                if (selectColumns.length > 0) {
                    isHidden = selectColumns[0].classList.contains('hidden');
                }

                if (isHidden) {
                    // Show checkboxes
                    selectColumns.forEach(el => el.classList.remove('hidden'));
                    toolbar.classList.remove('hidden');
                } else {
                    // Hide checkboxes
                    selectColumns.forEach(el => el.classList.add('hidden'));
                    toolbar.classList.add('hidden');

                    // Uncheck all
                    document.querySelectorAll('.row-checkbox').forEach(cb => cb.checked = false);
                    const selectAll = document.getElementById('select-all');
                    if (selectAll) selectAll.checked = false;

                    updateSelectionState();
                }
            }

            function toggleAllCheckboxes(source) {
                const checkboxes = document.querySelectorAll('.row-checkbox');
                checkboxes.forEach(cb => cb.checked = source.checked);
                updateSelectionState();
            }

            function updateSelectionState() {
                const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
                const count = checkedBoxes.length;
                const countEl = document.getElementById('selected-count');
                const btnDelete = document.getElementById('btn-delete-bulk');

                if (countEl) countEl.innerText = count;

                if (count > 0) {
                    btnDelete.disabled = false;
                } else {
                    btnDelete.disabled = true;
                }
            }
        </script>
    </div>
</body>

</html>