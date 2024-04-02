<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailsoal extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_paket',
        'jenis',
        'soal',
        'audio',
        'pilA',
        'pilB',
        'pilC',
        'pilD',
        'pilE',
        'kunci_jawaban1',
        'kunci_jawaban2',
        'score',
        'id_user',
        'paket',
        'status'
    ];
}
