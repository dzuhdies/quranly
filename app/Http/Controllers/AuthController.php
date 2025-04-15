<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $user = User::where(function($q) use ($request) {
                $q->where('username', $request->input('login'))
                  ->orWhere('nama_lengkap', $request->input('login'));
            })
            ->where('password', $request->input('password')) 
            ->first();

        if ($user) {
            Session::put('user', $user);

            switch ($user->role) {
                case 'admin':
                    return redirect('admin/dashboard');
                case 'guru':
                    return redirect('guru/dashboard');
                case 'murid':
                    return redirect('murid/dashboard');
            }
        }

        return back()->with('error', 'Login gagal. Cek username/nama dan password.');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'alamat' => $request->alamat,
            'password' => $request->password,
            'role' => 'murid',
        ]);

        return redirect('/login')->with('success', 'Akun berhasil dibuat.');
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login');
    }

    public function editPassword()
    {
        $user = Session::get('user');
        return view('auth.edit_password', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $user = Session::get('user');
        $userModel = \App\Models\User::find($user->id);
        $userModel->password = bcrypt($request->password);
        $userModel->save();

        return back()->with('success', 'Password berhasil diubah.');
    }
}

