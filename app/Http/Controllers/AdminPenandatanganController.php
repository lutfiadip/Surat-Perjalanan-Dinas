<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penandatangan;

class AdminPenandatanganController extends Controller
{
    public function index(Request $request)
    {
        $query = Penandatangan::query();

        if ($request->has('status') && in_array($request->status, ['0', '1'])) {
            $query->where('status_aktif', $request->status);
        }

        $penandatangan = $query->orderBy('nama')->paginate(10)->withQueryString();
        return view('admin.penandatangan.index', compact('penandatangan'));
    }

    public function create()
    {
        return view('admin.penandatangan.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string',
            'pangkat' => 'nullable|string|max:50',
            'jabatan' => 'required|string|max:100',
            'jenis' => 'required|in:kepala,pptk,bendahara,sekretaris,kasubbag', // Adjust based on known types
            'variant_ttd' => 'in:normal,plt,plh',
        ]);

        Penandatangan::create($request->all() + ['status_aktif' => 1]);

        return redirect()->route('admin.penandatangan.index')->with('success', 'Data Penandatangan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $penandatangan = Penandatangan::findOrFail($id);
        return view('admin.penandatangan.form', compact('penandatangan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string',
            'pangkat' => 'nullable|string|max:50',
            'jabatan' => 'required|string|max:100',
            'jenis' => 'required|in:kepala,pptk,bendahara,sekretaris,kasubbag',
            'variant_ttd' => 'in:normal,plt,plh',
        ]);

        $penandatangan = Penandatangan::findOrFail($id);
        $penandatangan->update($request->all());

        return redirect()->route('admin.penandatangan.index')->with('success', 'Data Penandatangan berhasil diperbarui.');
    }

    public function toggleStatus($id)
    {
        $penandatangan = Penandatangan::findOrFail($id);
        $penandatangan->status_aktif = !$penandatangan->status_aktif;
        $penandatangan->save();

        $message = $penandatangan->status_aktif ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()->with('success', "Penandatangan berhasil $message.");
    }
}
