<?php

namespace Database\Seeders;

use App\Models\Detailsoal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Detailsoal::create([
            'id_paket' => '1',
            'jenis' => 'kecerdasan',
            'soal' => 'Apakah membangun aplikasi dengan laravel itu susah',
            'audio' => '',
            'pilA' => 'Enggak,gampang kok',
            'pilB' => 'Yahh,Lumayan Susah',
            'pilC' => 'Susah, harus ngerti MVC',
            'pilD' => 'Sangat Susah,Harus tau dulu OOP',
            'pilE' => 'Kek nya aku enggak cocok laravel',
            'kunci_jawaban' => 'B',
            'score' => '50',
            'status' => 'Y',
        ]);
    }
}
