<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instruksi extends Model
{
    use HasFactory;
    protected $fillable = [
        'soal',
        'waktu',
        'kkm',
        'status',
    ];
    public function pertanyaan()
    {
        return $this->hasMany('App\Models\Pertanyaan', 'id_instruksi'); // Sesuaikan dengan nama kolom yang benar
    }
}
