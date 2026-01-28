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
            background-color: #FFF8F3;
        }
    </style>
</head>

<body class="p-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-slate-900">Draft SPD Saya</h1>
            <a href="{{ route('spd.create') }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                + Buat SPD Baru
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

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
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    </svg>
                    Hapus Terpilih
                </button>
            </div>

            <div class="bg-white rounded-xl shadow border border-slate-200 overflow-hidden">
                <table class="w-full text-left border-collapse" id="draft-table">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="p-4 w-10 text-center">
                                <input type="checkbox" onclick="toggleCheckboxes(this, 'draft-table')"
                                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            </th>
                            <th class="p-4 font-semibold text-slate-700 w-12 text-center">No</th>
                            <th class="p-4 font-semibold text-slate-700">Maksud / Tujuan</th>
                            <th class="p-4 font-semibold text-slate-700">Tanggal Surat</th>
                            <th class="p-4 font-semibold text-slate-700 text-right">Aksi</th>
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

                                <td colspan="5" class="p-8 text-center text-slate-500">
                                    Belum ada draft tersimpan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- FINAL SPD / ARSIP SECTION -->
            <div class="mt-12 mb-6">
                <h2 class="text-xl font-bold text-slate-900">SPD Final / Arsip</h2>
                <p class="text-slate-500 text-sm">Dokumen resmi yang siap dicetak atau diekspor.</p>
            </div>

            <div class="bg-white rounded-xl shadow border border-slate-200 overflow-hidden">
                <table class="w-full text-left border-collapse" id="final-table">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="p-4 w-10 text-center">
                                <input type="checkbox" onclick="toggleCheckboxes(this, 'final-table')"
                                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            </th>
                            <th class="p-4 font-semibold text-slate-700 w-12 text-center">No</th>
                            <th class="p-4 font-semibold text-slate-700">Nomor Surat</th>
                            <th class="p-4 font-semibold text-slate-700">Maksud / Tujuan</th>
                            <th class="p-4 font-semibold text-slate-700">Tanggal Surat</th>
                            <th class="p-4 font-semibold text-slate-700 text-right">Aksi</th>
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
                                <td class="p-4 text-slate-600">
                                    {{ $final->tanggal_surat ? \Carbon\Carbon::parse($final->tanggal_surat)->isoFormat('D MMMM Y') : '-' }}
                                </td>
                                <td class="p-4 text-right flex justify-end gap-2">
                                    <a href="{{ route('spd.print.final', ['id' => $final->id]) }}" target="_blank"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 font-medium text-sm transition border border-slate-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z">
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
                                <td colspan="6" class="p-8 text-center text-slate-500">
                                    Belum ada dokumen final.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6 text-center">
                <a href="{{ url('/') }}" class="text-slate-500 hover:text-slate-700 text-sm font-medium">
                    &larr; Kembali ke Beranda
                </a>
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
</body>

</html>