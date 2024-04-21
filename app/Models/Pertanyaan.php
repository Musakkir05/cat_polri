<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_instruksi',
        'soal',
        'status',
        'kunci',
    ];
    public function instruksi()
    {
        return $this->belongsTo(Instruksi::class, 'id_instruksi');
    }
}
