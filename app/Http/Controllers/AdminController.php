<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Pencapaian;

class AdminController extends Controller
{
    public function dashboard()
    {
        $kelas = Kelas::with(['murid', 'guru'])->get();
        $users = User::all();
        $totalHalaman = Pencapaian::sum('jumlah_halaman');
        $harian = Pencapaian::selectRaw('DATE(created_at) as tanggal, SUM(jumlah_halaman) as total')
            ->groupByRaw('DATE(created_at)')
            ->get();
        return view('admin.dashboard', compact('kelas', 'users', 'totalHalaman', 'harian'));
    }

    public function aturKelas()
    {
        $kelas = Kelas::with(['guru', 'murid'])->get();
        $guruTersedia = User::where('role', 'guru')->get();
        $muridTersedia = User::where('role', 'murid')->get();
        
        return view('admin.kelas', compact('kelas', 'guruTersedia', 'muridTersedia'));
    }
    

    public function tambahKelas(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255|unique:kelas,nama_kelas'
        ]);

        Kelas::create(['nama_kelas' => $request->nama_kelas]);
        return back()->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function hapusKelas($id)
    {
        $kelas = Kelas::findOrFail($id);
        
        // Hapus relasi kelas dari user
        User::where('kelas_id', $id)->update(['kelas_id' => null]);
        
        $kelas->delete();
        
        return back()->with('success', 'Kelas berhasil dihapus.');
    }

    public function aturTarget(Request $request, $kelasId)
    {
        $request->validate([
            'target_halaman' => 'required|integer|min:0'
        ]);

        $kelas = Kelas::findOrFail($kelasId);
        $kelas->target_halaman = $request->target_halaman;
        $kelas->save();

        return back()->with('success', 'Target pencapaian diperbarui.');
    }

    public function resetPencapaian(Request $request)
    {
        $request->validate([
            'tipe' => 'required|in:semua,kelas,user',
            'kelas_id' => 'required_if:tipe,kelas',
            'user_id' => 'required_if:tipe,user'
        ]);

        if ($request->tipe == 'semua') {
            Pencapaian::truncate();
        } elseif ($request->tipe == 'kelas') {
            $kelasId = $request->kelas_id;
            $userIds = User::where('kelas_id', $kelasId)->pluck('id');
            Pencapaian::whereIn('user_id', $userIds)->delete();
        } elseif ($request->tipe == 'user') {
            Pencapaian::where('user_id', $request->user_id)->delete();
        }

        return back()->with('success', 'Pencapaian berhasil direset.');
    }

    public function ubahUser(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.$id,
            'alamat' => 'nullable|string',
            'password' => 'nullable|string|min:6'
        ]);

        $user = User::findOrFail($id);
        $data = $request->only(['nama_lengkap', 'username', 'alamat']);
        
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);
        return back()->with('success', 'User berhasil diperbarui.');
    }

    public function hapusUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }

    public function pindahUserKeKelas(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'kelas_id' => 'nullable|exists:kelas,id'
        ]);

        $user = User::findOrFail($request->user_id);
        $user->kelas_id = $request->kelas_id;
        $user->save();

        return response()->json(['success' => true]);
    }

    public function searchUser(Request $request)
    {
        $request->validate([
            'search' => 'required|string|min:2'
        ]);

        $query = $request->search;
        $users = User::where('nama_lengkap', 'LIKE', "%$query%")
            ->orWhere('username', 'LIKE', "%$query%")
            ->orWhere('role', 'LIKE', "%$query%")
            ->get();

        return response()->json($users);
    }

    public function lihatSemuaAkun()
    {
        $users = User::with('kelas')->get();
        $kelas = Kelas::all();
        return view('admin.akun', compact('users'));
    }

    public function tambahMuridKeKelas(Request $request, $kelasId)
    {
        $request->validate([
            'murid_id' => 'required|array',
            'murid_id.*' => 'exists:users,id,role,murid'
        ]);

        $kelas = Kelas::findOrFail($kelasId);
        User::whereIn('id', $request->murid_id)->update(['kelas_id' => $kelasId]);

        return back()->with('success', 'Murid berhasil ditambahkan ke kelas.');
    }

    public function tambahGuruKeKelas(Request $request, $kelasId)
    {
        $request->validate([
            'guru_id' => 'required|exists:users,id,role,guru'
        ]);

        $kelas = Kelas::findOrFail($kelasId);
        User::where('id', $request->guru_id)->update(['kelas_id' => $kelasId]);

        return back()->with('success', 'Guru berhasil ditambahkan ke kelas.');
    }

    public function buatAkunBaru(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,guru,murid',
            'kelas_id' => 'nullable|exists:kelas,id'
        ]);

        $user = User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'kelas_id' => $request->kelas_id
        ]);

        return back()->with('success', 'Akun baru berhasil dibuat.');
    }
}