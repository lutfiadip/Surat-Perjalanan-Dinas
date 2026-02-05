<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($penandatangan) ? 'Edit Penandatangan' : 'Tambah Penandatangan' }} - Admin SPD</title>
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
                            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                            <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                            <path d="M12 11h4"></path>
                            <path d="M12 16h4"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-slate-900 tracking-tight">
                            {{ isset($penandatangan) ? 'Edit Penandatangan' : 'Tambah Penandatangan' }}
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
                <a href="{{ route('admin.penandatangan.index') }}"
                    class="inline-flex items-center gap-2 text-slate-500 hover:text-[#1C6DD0] text-sm font-medium transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Daftar
                </a>
            </div>

            @if(isset($penandatangan))
                <div class="mb-6 bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-xl flex items-start gap-3"
                    role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mt-0.5 flex-shrink-0" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                    <div>
                        <p class="font-bold text-sm">Perhatian</p>
                        <p class="text-xs mt-1 leading-relaxed">Fitur edit ini sebaiknya hanya digunakan untuk
                            <strong>memperbaiki kesalahan penulisan (typo)</strong>.
                        </p>
                        <p class="text-xs mt-1 leading-relaxed">Jika ada <strong>pergantian pejabat</strong>, harap
                            <strong>Nonaktifkan</strong> data lama dan <strong>Buat Baru</strong> untuk data pejabat
                            pengganti agar riwayat data tetap terjaga.
                        </p>
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <form
                    action="{{ isset($penandatangan) ? route('admin.penandatangan.update', $penandatangan->id) : route('admin.penandatangan.store') }}"
                    method="POST" class="p-8">
                    @csrf
                    @if(isset($penandatangan))
                        @method('PUT')
                    @endif

                    <div class="space-y-6">
                        <!-- Nama -->
                        <div>
                            <label for="nama" class="block text-sm font-semibold text-slate-900 mb-2">Nama
                                Pejabat</label>
                            <input type="text" name="nama" id="nama"
                                value="{{ old('nama', $penandatangan->nama ?? '') }}" required
                                class="w-full rounded-xl border-slate-200 focus:border-[#1C6DD0] focus:ring-[#1C6DD0] shadow-sm text-sm placeholder-slate-400 py-3 px-4"
                                placeholder="Contoh: Nama Lengkap, Gelar">
                            @error('nama')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- NIP -->
                        <div>
                            <label for="nip" class="block text-sm font-semibold text-slate-900 mb-2">NIP</label>
                            <input type="text" name="nip" id="nip" value="{{ old('nip', $penandatangan->nip ?? '') }}"
                                class="w-full rounded-xl border-slate-200 focus:border-[#1C6DD0] focus:ring-[#1C6DD0] shadow-sm text-sm placeholder-slate-400 py-3 px-4"
                                placeholder="Contoh: xxxxxxxx xxxxxx x xxx">
                            @error('nip')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Pangkat -->
                        <div>
                            <label for="pangkat" class="block text-sm font-semibold text-slate-900 mb-2">Pangkat</label>
                            <input type="text" name="pangkat" id="pangkat"
                                value="{{ old('pangkat', $penandatangan->pangkat ?? '') }}"
                                class="w-full rounded-xl border-slate-200 focus:border-[#1C6DD0] focus:ring-[#1C6DD0] shadow-sm text-sm placeholder-slate-400 py-3 px-4"
                                placeholder="Contoh: Pangkat (Golongan)">
                            @error('pangkat')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jabatan -->
                        <div>
                            <label for="jabatan" class="block text-sm font-semibold text-slate-900 mb-2">Jabatan</label>
                            <input type="text" name="jabatan" id="jabatan"
                                value="{{ old('jabatan', $penandatangan->jabatan ?? '') }}" required
                                class="w-full rounded-xl border-slate-200 focus:border-[#1C6DD0] focus:ring-[#1C6DD0] shadow-sm text-sm placeholder-slate-400 py-3 px-4"
                                placeholder="Contoh: Kepala Badan Keuangan Daerah">
                            @error('jabatan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jenis -->
                        <div>
                            <label for="jenis" class="block text-sm font-semibold text-slate-900 mb-2">Jenis
                                Penandatangan</label>
                            <div class="relative">
                                <select name="jenis" id="jenis" required
                                    class="w-full rounded-xl border-slate-200 focus:border-[#1C6DD0] focus:ring-[#1C6DD0] shadow-sm text-sm py-3 px-4 appearance-none">
                                    <option value="" disabled {{ !isset($penandatangan) ? 'selected' : '' }}>Pilih
                                        jenis...</option>
                                    <option value="kepala" {{ (old('jenis', $penandatangan->jenis ?? '') == 'kepala') ? 'selected' : '' }}>Kepala (Tanda Tangan Utama)</option>
                                    <option value="pptk" {{ (old('jenis', $penandatangan->jenis ?? '') == 'pptk') ? 'selected' : '' }}>PPTK (Pejabat Pelaksana Teknis Kegiatan)</option>
                                    <option value="sekretaris" {{ (old('jenis', $penandatangan->jenis ?? '') == 'sekretaris') ? 'selected' : '' }}>Sekretaris</option>

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
                            @error('jenis')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                        <a href="{{ route('admin.penandatangan.index') }}"
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

</body>

</html>