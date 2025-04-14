<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\User;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with(['murid', 'guru'])->get();
        $semuaUser = User::all();

        $murid = $semuaUser->where('role', 'murid')->whereNull('kelas_id');
        $guru = $semuaUser->where('role', 'guru')->whereNull('kelas_id');

        return view('admin.kelas', compact('kelas', 'murid', 'guru'));
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|unique:kelas,nama',
        ]);

        Kelas::create([
            'nama' => $request->nama,
        ]);

        return back()->with('success', 'Kelas berhasil ditambahkan!');
    }

    public function hapus($id)
    {
        Kelas::findOrFail($id)->delete();
        return back()->with('success', 'Kelas berhasil dihapus!');
    }

    public function pindahkanKeKelas(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $user = User::find($request->user_id);
        $user->kelas_id = $request->kelas_id;
        $user->save();

        return response()->json(['message' => 'User berhasil dipindahkan ke kelas.']);
    }

    public function keluarkanDariKelas($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->kelas_id = null;
        $user->save();

        return back()->with('success', 'User berhasil dikeluarkan dari kelas.');
    }

    
}
