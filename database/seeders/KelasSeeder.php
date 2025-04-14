<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    public function run()
    {
        Kelas::create(['nama_kelas' => 'Kelas A', 'target_halaman' => 100]);
        Kelas::create(['nama_kelas' => 'Kelas B', 'target_halaman' => 120]);
    }
}

