<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = ['nama_kelas', 'target_halaman'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function murid()
    {
        return $this->hasMany(User::class)->where('role', 'murid');
    }

    public function guru()
    {
        return $this->hasMany(User::class)->where('role', 'guru');
    }
}
