<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban_kecermatan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'id_paket',
        'id_instruksi',
        'id_pertanyaan',
        'pilihan',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
