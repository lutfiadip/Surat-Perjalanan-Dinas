<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($pegawai) ? 'Edit Pegawai' : 'Tambah Pegawai' }} - Admin SPD</title>
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
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-slate-900 tracking-tight">
                            {{ isset($pegawai) ? 'Edit Pegawai' : 'Tambah Pegawai' }}
                        </h1>
                        <p class="text-xs text-slate-500 font-medium">Master Data</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.pegawai.index') }}"
                        class="text-sm font-medium text-slate-600 hover:text-[#1C6DD0] transition-colors flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 12H5M12 19l-7-7 7-7" />
                        </svg>
                        Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <form
                    action="{{ isset($pegawai) ? route('admin.pegawai.update', $pegawai->id) : route('admin.pegawai.store') }}"
                    method="POST" class="p-8">
                    @csrf
                    @if(isset($pegawai))
                        @method('PUT')
                    @endif

                    <div class="space-y-6">
                        <!-- Nama -->
                        <div>
                            <label for="nama" class="block text-sm font-semibold text-slate-900 mb-2">Nama
                                Lengkap</label>
                            <input type="text" name="nama" id="nama" value="{{ old('nama', $pegawai->nama ?? '') }}"
                                required
                                class="w-full rounded-xl border-slate-200 focus:border-[#1C6DD0] focus:ring-[#1C6DD0] shadow-sm text-sm placeholder-slate-400 py-3 px-4"
                                placeholder="Contoh: Budi Santoso, S.Kom">
                            @error('nama')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- NIP -->
                        <div>
                            <label for="nip" class="block text-sm font-semibold text-slate-900 mb-2">NIP <span
                                    class="text-slate-400 font-normal">(Opsional)</span></label>
                            <input type="text" name="nip" id="nip" value="{{ old('nip', $pegawai->nip ?? '') }}"
                                class="w-full rounded-xl border-slate-200 focus:border-[#1C6DD0] focus:ring-[#1C6DD0] shadow-sm text-sm placeholder-slate-400 py-3 px-4"
                                placeholder="Contoh: 19800101 200501 1 001">
                            @error('nip')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Pangkat / Golongan -->
                        <div>
                            <label for="pangkat_gol" class="block text-sm font-semibold text-slate-900 mb-2">Pangkat /
                                Golongan <span class="text-slate-400 font-normal">(Opsional)</span></label>
                            <input type="text" name="pangkat_gol" id="pangkat_gol"
                                value="{{ old('pangkat_gol', $pegawai->pangkat_gol ?? '') }}"
                                class="w-full rounded-xl border-slate-200 focus:border-[#1C6DD0] focus:ring-[#1C6DD0] shadow-sm text-sm placeholder-slate-400 py-3 px-4"
                                placeholder="Contoh: Penata Muda (III/a)">
                            @error('pangkat_gol')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jabatan -->
                        <div>
                            <label for="jabatan" class="block text-sm font-semibold text-slate-900 mb-2">Jabatan</label>
                            <input type="text" name="jabatan" id="jabatan"
                                value="{{ old('jabatan', $pegawai->jabatan ?? '') }}" required
                                class="w-full rounded-xl border-slate-200 focus:border-[#1C6DD0] focus:ring-[#1C6DD0] shadow-sm text-sm placeholder-slate-400 py-3 px-4"
                                placeholder="Contoh: Staf Pelaksana / Kepala Seksi ...">
                            @error('jabatan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Unit Kerja -->
                        <div>
                            <label for="unit_kerja" class="block text-sm font-semibold text-slate-900 mb-2">Unit Kerja
                                <span class="text-slate-400 font-normal">(Opsional)</span></label>
                            <input type="text" name="unit_kerja" id="unit_kerja"
                                value="{{ old('unit_kerja', $pegawai->unit_kerja ?? '') }}"
                                class="w-full rounded-xl border-slate-200 focus:border-[#1C6DD0] focus:ring-[#1C6DD0] shadow-sm text-sm placeholder-slate-400 py-3 px-4"
                                placeholder="Contoh: Bidang Anggaran / Sekretariat">
                            @error('unit_kerja')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                        <a href="{{ route('admin.pegawai.index') }}"
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