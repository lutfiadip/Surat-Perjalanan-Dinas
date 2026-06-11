<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penandatangan;

class AdminPenandatanganController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        $query = Penandatangan::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%");
            });
        }

        if ($request->has('status') && in_array($request->status, ['0', '1'])) {
            $query->where('status_aktif', $request->status);
        }

        $penandatangan = $query->withCount('spds')->orderBy('nama')->paginate($perPage)->withQueryString();
        return view('admin.penandatangan.index', compact('penandatangan'));
    }

    public function create()
    {
        $hasActivePptk = Penandatangan::where('jenis', 'pptk')->where('status_aktif', 1)->exists();
        return view('admin.penandatangan.form', compact('hasActivePptk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string',
            'pangkat' => 'nullable|string|max:50',
            'jabatan' => 'required|string|max:100',
            'jenis' => 'required|in:kepala,pptk,bendahara,sekretaris,kasubbag,kabid', // Adjust based on known types
            'variant_ttd' => 'in:normal,plt,plh',
        ]);

        if ($request->jenis === 'pptk') {
            $existingPptk = Penandatangan::where('jenis', 'pptk')->where('status_aktif', 1)->exists();
            if ($existingPptk) {
                return redirect()->back()->withInput()->with('error', 'Penandatangan jenis PPTK sudah ada dan masih aktif. Silakan nonaktifkan atau hapus pengguna PPTK yang lama agar bisa digantikan yang baru.');
            }
        }

        Penandatangan::create($request->all() + ['status_aktif' => 1]);

        return redirect()->route('admin.penandatangan.index')->with('success', 'Data Penandatangan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $penandatangan = Penandatangan::findOrFail($id);
        $hasActivePptk = Penandatangan::where('jenis', 'pptk')->where('status_aktif', 1)->where('id', '!=', $id)->exists();
        return view('admin.penandatangan.form', compact('penandatangan', 'hasActivePptk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string',
            'pangkat' => 'nullable|string|max:50',
            'jabatan' => 'required|string|max:100',
            'jenis' => 'required|in:kepala,pptk,bendahara,sekretaris,kasubbag,kabid',
            'variant_ttd' => 'in:normal,plt,plh',
        ]);

        if ($request->jenis === 'pptk') {
            $existingPptk = Penandatangan::where('jenis', 'pptk')->where('status_aktif', 1)->where('id', '!=', $id)->exists();
            if ($existingPptk) {
                return redirect()->back()->withInput()->with('error', 'Penandatangan jenis PPTK sudah ada dan masih aktif. Silakan nonaktifkan atau hapus pengguna PPTK yang lama agar bisa digantikan yang baru.');
            }
        }

        $penandatangan = Penandatangan::findOrFail($id);
        $penandatangan->update($request->all());

        return redirect()->route('admin.penandatangan.index')->with('success', 'Data Penandatangan berhasil diperbarui.');
    }

    public function toggleStatus($id)
    {
        $penandatangan = Penandatangan::findOrFail($id);

        if (!$penandatangan->status_aktif && $penandatangan->jenis === 'pptk') {
            $existingPptk = Penandatangan::where('jenis', 'pptk')->where('status_aktif', 1)->exists();
            if ($existingPptk) {
                return redirect()->back()->with('error', 'Tidak dapat mengaktifkan PPTK ini karena sudah ada PPTK lain yang aktif. Silakan nonaktifkan pengguna PPTK yang lama agar bisa digantikan yang baru.');
            }
        }

        $penandatangan->status_aktif = !$penandatangan->status_aktif;
        $penandatangan->save();

        $message = $penandatangan->status_aktif ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()->with('success', "Penandatangan berhasil $message.");
    }

    public function destroy($id)
    {
        $penandatangan = Penandatangan::findOrFail($id);

        try {
            $penandatangan->delete();
            return redirect()->route('admin.penandatangan.index')->with('success', 'Data Penandatangan berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                return redirect()->route('admin.penandatangan.index')->with('error', 'Penandatangan ini tidak dapat dihapus karena masih memiliki data terkait (SPD, dll).');
            }
            return redirect()->route('admin.penandatangan.index')->with('error', 'Terjadi kesalahan saat menghapus penandatangan: ' . $e->getMessage());
        }
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return redirect()->back()->with('error', 'Tidak ada penandatangan yang dipilih.');
        }

        try {
            $deletedCount = Penandatangan::whereIn('id', $ids)->delete();

            return redirect()->route('admin.penandatangan.index')->with('success', "$deletedCount penandatangan berhasil dihapus.");
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                return redirect()->route('admin.penandatangan.index')->with('error', 'Beberapa penandatangan tidak dapat dihapus karena masih memiliki data terkait (SPD, dll).');
            }
            return redirect()->route('admin.penandatangan.index')->with('error', 'Terjadi kesalahan saat menghapus penandatangan: ' . $e->getMessage());
        }
    }
}
