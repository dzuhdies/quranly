<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::create([
            'nama_lengkap' => 'Admin Utama',
            'username' => 'admin',
            'alamat' => 'Kantor Pusat',
            'password' => 'admin123',
            'role' => 'admin',
        ]);

        // Guru
        User::create([
            'nama_lengkap' => 'Ustadz Ali',
            'username' => 'ustadzali',
            'alamat' => 'Jl. Surga No. 1',
            'password' => 'guru123',
            'role' => 'guru',
        ]);

        // Murid
        User::create([
            'nama_lengkap' => 'Ahmad',
            'username' => 'ahmad01',
            'alamat' => 'Jl. Quran No. 7',
            'password' => 'murid123',
            'role' => 'murid',
            'kelas_id' => 1,
        ]);
    }
}

