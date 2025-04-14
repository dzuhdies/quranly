<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pencapaian;

class PencapaianSeeder extends Seeder
{
    public function run()
    {
        Pencapaian::create([
            'user_id' => 3, // Ahmad
            'tanggal' => now()->subDays(1),
            'jumlah_halaman' => 10,
        ]);

        Pencapaian::create([
            'user_id' => 3,
            'tanggal' => now(),
            'jumlah_halaman' => 15,
        ]);
    }
}

