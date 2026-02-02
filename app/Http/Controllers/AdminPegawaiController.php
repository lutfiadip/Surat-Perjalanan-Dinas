<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PegawaiBkdSpd;

class AdminPegawaiController extends Controller
{
    public function index()
    {
        $pegawai = PegawaiBkdSpd::orderBy('nama')->paginate(10);
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
