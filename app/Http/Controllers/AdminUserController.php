<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        $query = User::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
            });
        }

        if ($request->has('role') && in_array($request->role, ['admin', 'user'])) {
            $query->where('role', $request->role);
        }

        if ($request->has('status') && in_array($request->status, ['aktif', 'nonaktif'])) {
            $query->where('status', $request->status);
        }

        $users = $query->orderBy('name')->paginate($perPage)->withQueryString();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',

            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,user',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,

            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => 'aktif', // Default active
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.form', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,

            'password' => 'nullable|string|min:6',
            'role' => 'required|in:admin,user',
        ]);

        $data = [
            'name' => $request->name,
            'username' => $request->username,

            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->status = ($user->status === 'aktif') ? 'nonaktif' : 'aktif';
        $user->save();

        $message = ($user->status === 'aktif') ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()->with('success', "User berhasil $message.");
    }
    public function destroy($id)
    {
        // Prevent deleting self
        if ($id == session('user_id')) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun sendiri yang sedang login.');
        }

        $user = User::findOrFail($id);

        try {
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                return redirect()->route('admin.users.index')->with('error', 'User ini tidak dapat dihapus karena masih memiliki data terkait (SPD, dll).');
            }
            return redirect()->route('admin.users.index')->with('error', 'Terjadi kesalahan saat menghapus user: ' . $e->getMessage());
        }
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return redirect()->back()->with('error', 'Tidak ada user yang dipilih.');
        }

        // Filter out self ID
        $currentUserId = session('user_id');
        $validIds = array_filter($ids, function ($id) use ($currentUserId) {
            return $id != $currentUserId;
        });

        try {
            $deletedCount = User::whereIn('id', $validIds)->delete();

            if (in_array($currentUserId, $ids)) {
                return redirect()->route('admin.users.index')->with('success', "$deletedCount user berhasil dihapus. Akun Anda sendiri dilewati.");
            }

            return redirect()->route('admin.users.index')->with('success', "$deletedCount user berhasil dihapus.");
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                return redirect()->route('admin.users.index')->with('error', 'Beberapa user tidak dapat dihapus karena masih memiliki data terkait (SPD, dll).');
            }
            return redirect()->route('admin.users.index')->with('error', 'Terjadi kesalahan saat menghapus user: ' . $e->getMessage());
        }
    }
}
