<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PegawaiBkdSpd;

class AdminPegawaiController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        $query = PegawaiBkdSpd::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%");
            });
        }

        if ($request->has('status') && in_array($request->status, ['0', '1'])) {
            $query->where('status_aktif', $request->status);
        }

        $pegawai = $query->orderBy('nama')->paginate($perPage)->withQueryString();
        return view('admin.pegawai.index', compact('pegawai'));
    }

    public function create()
    {
        return view('admin.pegawai.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string',
            'pangkat_gol' => 'nullable|string|max:50',
            'jabatan' => 'required|string|max:100',
            'unit_kerja' => 'nullable|string|max:150',
        ]);

        PegawaiBkdSpd::create($request->all() + ['status_aktif' => 1]);

        return redirect()->route('admin.pegawai.index')->with('success', 'Data Pegawai berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pegawai = PegawaiBkdSpd::findOrFail($id);
        return view('admin.pegawai.form', compact('pegawai'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string',
            'pangkat_gol' => 'nullable|string|max:50',
            'jabatan' => 'required|string|max:100',
            'unit_kerja' => 'nullable|string|max:150',
        ]);

        $pegawai = PegawaiBkdSpd::findOrFail($id);
        $pegawai->update($request->all());

        return redirect()->route('admin.pegawai.index')->with('success', 'Data Pegawai berhasil diperbarui.');
    }

    public function toggleStatus($id)
    {
        $pegawai = PegawaiBkdSpd::findOrFail($id);
        $pegawai->status_aktif = !$pegawai->status_aktif;
        $pegawai->save();

        $message = $pegawai->status_aktif ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()->with('success', "Pegawai berhasil $message.");
    }
}
