<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pencapaian extends Model
{
    protected $table = 'pencapaian';

    protected $fillable = ['user_id', 'tanggal', 'jumlah_halaman'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

