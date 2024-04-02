<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawab extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_soal',
        'id_user',
        'id_paket',
        'nama',
        'pilihan1',
        'pilihan2'
    ];
}
