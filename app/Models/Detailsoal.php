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
        'kunci_jawaban',
        'score',
        'id_user',
        'status'
    ];
}
