<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($user) ? 'Edit User' : 'Tambah User' }} - Admin SPD</title>
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
                    <div class="bg-[#1C6DD0]/10 p-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#1C6DD0]" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-slate-900 tracking-tight">
                            {{ isset($user) ? 'Edit User' : 'Tambah User' }}
                        </h1>
                        <p class="text-xs text-slate-500 font-medium">Master Data</p>
                    </div>
                </div>


            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-2xl mx-auto">
            <div class="mb-6">
                <a href="{{ route('admin.users.index') }}"
                    class="inline-flex items-center gap-2 text-slate-500 hover:text-[#1C6DD0] text-sm font-medium transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Daftar
                </a>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <form action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}"
                    method="POST" class="p-8">
                    @csrf
                    @if(isset($user))
                        @method('PUT')
                    @endif

                    <div class="space-y-6">
                        <!-- Nama -->
                        <div>
                            <label for="name" class="block text-sm font-semibold text-slate-900 mb-2">Nama</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name ?? '') }}"
                                required
                                class="w-full rounded-xl border-slate-200 focus:border-[#1C6DD0] focus:ring-[#1C6DD0] shadow-sm text-sm placeholder-slate-400 py-3 px-4"
                                placeholder="Contoh: Admin Utama">
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Username -->
                            <div>
                                <label for="username"
                                    class="block text-sm font-semibold text-slate-900 mb-2">Username</label>
                                <input type="text" name="username" id="username"
                                    value="{{ old('username', $user->username ?? '') }}" required
                                    class="w-full rounded-xl border-slate-200 focus:border-[#1C6DD0] focus:ring-[#1C6DD0] shadow-sm text-sm placeholder-slate-400 py-3 px-4"
                                    placeholder="Contoh: admin123">
                                @error('username')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Role -->
                            <div>
                                <label for="role" class="block text-sm font-semibold text-slate-900 mb-2">Role</label>
                                <div class="relative">
                                    <select name="role" id="role" required
                                        class="w-full rounded-xl border-slate-200 focus:border-[#1C6DD0] focus:ring-[#1C6DD0] shadow-sm text-sm py-3 px-4 appearance-none">
                                        <option value="" disabled {{ !isset($user) ? 'selected' : '' }}>Pilih role...
                                        </option>
                                        <option value="admin" {{ (old('role', $user->role ?? '') == 'admin') ? 'selected' : '' }}>Admin</option>
                                        <option value="user" {{ (old('role', $user->role ?? '') == 'user') ? 'selected' : '' }}>User</option>
                                    </select>
                                    <div
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M6 9l6 6 6-6" />
                                        </svg>
                                    </div>
                                </div>
                                @error('role')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>



                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-semibold text-slate-900 mb-2">
                                Password
                                @if(isset($user))
                                    <span class="text-slate-400 font-normal">(Kosongkan jika tidak ingin mengubah)</span>
                                @endif
                            </label>
                            <div class="relative">
                                <input type="password" name="password" id="password" {{ !isset($user) ? 'required' : '' }}
                                    class="w-full rounded-xl border-slate-200 focus:border-[#1C6DD0] focus:ring-[#1C6DD0] shadow-sm text-sm placeholder-slate-400 py-3 px-4 pr-10"
                                    placeholder="Masukkan password">
                                <button type="button" onclick="togglePassword()"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600 focus:outline-none">
                                    <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                                        <path
                                            d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68">
                                        </path>
                                        <path
                                            d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61">
                                        </path>
                                        <line x1="2" y1="2" x2="22" y2="22"></line>
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                        <a href="{{ route('admin.users.index') }}"
                            class="px-5 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-50 transition-colors">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-5 py-2.5 rounded-xl text-sm font-medium text-white bg-[#1C6DD0] hover:bg-[#155AB6] shadow-lg shadow-blue-500/20 transition-all flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                <polyline points="7 3 7 8 15 8"></polyline>
                            </svg>
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                // Switch to Open Eye
                eyeIcon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
            } else {
                passwordInput.type = 'password';
                // Switch back to Closed Eye (Slash)
                eyeIcon.innerHTML = '<path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path><path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path><line x1="2" y1="2" x2="22" y2="22"></line>';
            }
        }
    </script>
</body>

</html>