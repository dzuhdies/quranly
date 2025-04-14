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
        $kelas = Kelas::with(['murid', 'guru'])->get();
        $users = User::where('role', '!=', 'admin')->get();

        return view('admin.kelas', compact('kelas', 'users'));
    }

    public function tambahKelas(Request $request)
    {
        Kelas::create(['nama_kelas' => $request->nama_kelas]);
        return back()->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function hapusKelas($id)
    {
        Kelas::destroy($id);
        return back()->with('success', 'Kelas berhasil dihapus.');
    }

    public function aturTarget(Request $request, $kelasId)
    {
        $kelas = Kelas::findOrFail($kelasId);
        $kelas->target_halaman = $request->target_halaman;
        $kelas->save();

        return back()->with('success', 'Target pencapaian diperbarui.');
    }

    public function resetPencapaian(Request $request)
    {
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
        $user = User::findOrFail($id);
        $user->update($request->only(['nama_lengkap', 'username', 'alamat', 'password']));
        return back()->with('success', 'User berhasil diperbarui.');
    }

    public function hapusUser($id)
    {
        User::destroy($id);
        return back()->with('success', 'User berhasil dihapus.');
    }
    public function pindahUserKeKelas(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->kelas_id = $request->kelas_id;
        $user->save();

        return response()->json(['success' => true]);
    }

    public function searchUser(Request $request)
    {
        $query = $request->search;
        $users = User::where('nama_lengkap', 'LIKE', "%$query%")
            ->orWhere('username', 'LIKE', "%$query%")
            ->orWhere('role', 'LIKE', "%$query%")
            ->get();

        return response()->json($users);
    }
    public function lihatSemuaAkun()
    {
        $users = User::all(); // Termasuk password
        return view('admin.lihat-akun', compact('users'));
    }

    public function tambahMuridKeKelas(Request $request, $kelasId)
    {
        $kelas = Kelas::findOrFail($kelasId);
        $muridIds = $request->murid_id; // ID murid yang dipilih
    
        // Update kelas_id untuk murid yang dipilih
        User::whereIn('id', $muridIds)->update(['kelas_id' => $kelasId]);
    
        return back()->with('success', 'Murid berhasil ditambahkan ke kelas.');
    }
    
    public function tambahGuruKeKelas(Request $request, $kelasId)
    {
        $kelas = Kelas::findOrFail($kelasId);
        $guruIds = (array) $request->guru_id; // pastikan bentuknya array
    
        // Update kelas_id untuk guru yang dipilih
        User::whereIn('id', $guruIds)->update(['kelas_id' => $kelasId]);
    
        return back()->with('success', 'Guru berhasil ditambahkan ke kelas.');
    }
    
    

}
