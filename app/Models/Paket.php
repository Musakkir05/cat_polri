<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'jenis',
        'deskripsi',
        'kkm',
        'waktu'
    ];
    public function detailSoals()
    {
        return $this->hasMany(DetailSoal::class, 'id_paket');
    }

    public function jawabs()
    {
        return $this->hasMany(Jawab::class, 'id_paket');
    }
}
