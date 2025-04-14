<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['nama_lengkap', 'username', 'alamat', 'password', 'role', 'kelas_id'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function pencapaian()
    {
        return $this->hasMany(Pencapaian::class);
    }
}

