<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pencapaian;
use Illuminate\Support\Facades\Session;

class GuruController extends Controller
{
    public function dashboard()
    {
        $guru = Session::get('user');

        // Total halaman yang telah dibaca oleh guru
        $totalHalamanGuru = Pencapaian::where('user_id', $guru->id)->sum('jumlah_halaman');

        $murid = User::where('kelas_id', $guru->kelas_id)->where('role', 'murid')->get();

        $data = [];

        $targetHalaman = $guru->kelas ? $guru->kelas->target_halaman : 0;

        foreach ($murid as $m) {
            $totalHalaman = Pencapaian::where('user_id', $m->id)->sum('jumlah_halaman');
            $data[] = [
                'murid' => $m,
                'total_halaman' => $totalHalaman,
                'lulus_target' => $totalHalaman >= $targetHalaman,
            ];
        }

        // Mengambil pencapaian guru
        $pencapaianGuru = Pencapaian::where('user_id', $guru->id)->get();

        return view('guru.dashboard', compact('data', 'targetHalaman', 'totalHalamanGuru', 'pencapaianGuru'));
    }


    public function lihatDetailMurid($id)
    {
        $guru = Session::get('user');
        $murid = User::findOrFail($id);
        $pencapaian = Pencapaian::where('user_id', $id)
            ->selectRaw('tanggal, SUM(jumlah_halaman) as total_halaman')
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('guru.detail-murid', compact('murid', 'pencapaian'));
    }

    public function editPencapaian(Request $request, $id)
    {
        $p = Pencapaian::findOrFail($id);
        $p->jumlah_halaman = $request->jumlah_halaman;
        $p->save();

        return back()->with('success', 'Jumlah halaman berhasil diperbarui.');
    }

    public function tambahPencapaian(Request $request)
    {
        $guru = Session::get('user');
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'jumlah_halaman' => 'required|integer|min:1',
        ]);

        Pencapaian::create([
            'user_id' => $request->user_id,
            'jumlah_halaman' => $request->jumlah_halaman,
            'tanggal' => now()->toDateString(),
        ]);

        return back()->with('success', 'Pencapaian berhasil ditambahkan.');
    }

    // Method untuk guru menambahkan halaman
    public function tambahHalamanGuru(Request $request)
    {
        $guru = Session::get('user');
        $request->validate([
            'jumlah_halaman' => 'required|integer|min:1',
        ]);

        Pencapaian::create([
            'user_id' => $guru->id, // ID guru yang sedang login
            'jumlah_halaman' => $request->jumlah_halaman,
            'tanggal' => now()->toDateString(),
        ]);

        return back()->with('success', 'Pencapaian halaman guru berhasil ditambahkan.');
    }

    public function hapusPencapaian($id)
    {
        Pencapaian::destroy($id);
        return back()->with('success', 'Pencapaian berhasil dihapus.');
    }
    public function hapusPencapaianGuru(Request $request)
    {
        $guru = Session::get('user');
        $pencapaian = Pencapaian::where('id', $request->pencapaian_id)
            ->where('user_id', $guru->id) // memastikan itu milik guru
            ->first();

        if (!$pencapaian) {
            return back()->with('error', 'Pencapaian tidak ditemukan atau bukan milik Anda.');
        }

        $pencapaian->delete();

        return back()->with('success', 'Pencapaian guru berhasil dihapus.');
    }
}
