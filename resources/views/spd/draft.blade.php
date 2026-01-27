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
            <a href="{{ route('spd.form') }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                + Buat SPD Baru
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow border border-slate-200 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="p-4 font-semibold text-slate-700">Maksud / Tujuan</th>
                        <th class="p-4 font-semibold text-slate-700">Tanggal Surat</th>
                        <th class="p-4 font-semibold text-slate-700 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($drafts as $draft)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="p-4 text-slate-900">
                                {{ $draft->maksud ?? '(Belum diisi)' }}
                            </td>
                            <td class="p-4 text-slate-600">
                                {{ $draft->tanggal_surat ? \Carbon\Carbon::parse($draft->tanggal_surat)->isoFormat('D MMMM Y') : '-' }}
                            </td>
                            <td class="p-4 text-right">
                                <a href="{{ route('spd.form', ['id' => $draft->id]) }}"
                                    class="inline-block px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 font-medium text-sm transition">
                                    Lanjutkan
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-8 text-center text-slate-500">
                                Belum ada draft tersimpan.
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
</body>

</html>