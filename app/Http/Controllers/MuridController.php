<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Pencapaian;
use Illuminate\Support\Facades\DB;

class MuridController extends Controller
{
    public function dashboard()
    {
        $user = Session::get('user');

        $pencapaian = Pencapaian::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $totalHalaman = $pencapaian->sum('jumlah_halaman');

        $nama_kelas = $user->kelas ? $user->kelas->nama_kelas : null;

        $kelas = \App\Models\Kelas::find($user->kelas_id);
        $targetHalaman = $kelas ? $kelas->target_halaman : 0;

        $sudahMencapaiTarget = $totalHalaman >= $targetHalaman;

        $temanSekelas = DB::table('pencapaian')
            ->join('users', 'pencapaian.user_id', '=', 'users.id')
            ->select('users.nama_lengkap', 'pencapaian.user_id', DB::raw('SUM(pencapaian.jumlah_halaman) as total_halaman'))
            ->where('users.kelas_id', $user->kelas_id)
            ->where('pencapaian.user_id', '!=', $user->id)
            ->groupBy('pencapaian.user_id', 'users.nama_lengkap')
            ->orderByDesc('total_halaman')
            ->get();

        return view('murid.dashboard', compact(
            'user',
            'pencapaian',
            'totalHalaman',
            'targetHalaman',
            'sudahMencapaiTarget',
            'temanSekelas', 'nama_kelas'
        ));
    }


    public function simpanPencapaian(Request $request)
    {
        $user = Session::get('user');

        $request->validate([
            'jumlah_halaman' => 'required|integer|min:1',
        ]);

        Pencapaian::create([
            'user_id' => $user->id,
            'jumlah_halaman' => $request->jumlah_halaman,
            'tanggal' => now()->toDateString(),

        ]);

        return back()->with('success', 'Pencapaian berhasil ditambahkan!');
    }

    public function hapusPencapaian($id)
    {
        $p = Pencapaian::findOrFail($id);
        if ($p->user_id == Session::get('user')->id) {
            $p->delete();
            return back()->with('success', 'Pencapaian berhasil dihapus!');
        }

        return back()->with('error', 'Tidak bisa menghapus data orang lain.');
    }
}
