<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pencapaian;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class PencapaianController extends Controller
{
    // Untuk murid: melihat pencapaian sendiri
    public function index()
    {
        $user = Session::get('user');

        $pencapaian = Pencapaian::where('user_id', $user->id)->first();

        return view('murid.dashboard', compact('pencapaian'));
    }

    // Untuk murid: menambahkan jumlah halaman
    public function tambahHalaman(Request $request)
    {
        $request->validate([
            'jumlah_halaman' => 'required|integer|min:1'
        ]);

        $user = Session::get('user');

        $pencapaian = Pencapaian::firstOrCreate(
            ['user_id' => $user->id],
            ['jumlah_halaman' => 0]
        );

        $pencapaian->jumlah_halaman += $request->jumlah_halaman;
        $pencapaian->save();

        return back()->with('success', 'Berhasil menambahkan jumlah halaman.');
    }

    // Untuk guru/admin: lihat semua pencapaian murid di kelasnya
    public function semua()
    {
        $user = Session::get('user');

        if ($user->role == 'guru') {
            $murid = User::where('kelas_id', $user->kelas_id)
                        ->where('role', 'murid')
                        ->with('pencapaian')
                        ->get();
        } else if ($user->role == 'admin') {
            $murid = User::where('role', 'murid')
                        ->with('pencapaian')
                        ->get();
        } else {
            abort(403);
        }

        return view($user->role . '.dashboard', compact('murid'));
    }

    // Optional: reset jumlah halaman (untuk admin/guru)
    public function resetHalaman($user_id)
    {
        $pencapaian = Pencapaian::where('user_id', $user_id)->first();

        if ($pencapaian) {
            $pencapaian->jumlah_halaman = 0;
            $pencapaian->save();
        }

        return back()->with('success', 'Pencapaian berhasil direset.');
    }
}
