<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'status' => 'admin',
            'No_hp' => '025843534535',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
        ]);
        User::create([
            'name' => 'siswa',
            'status' => 'siswa',
            'No_hp' => '08123456789',
            'email' => 'siswa@gmail.com',
            'password' => Hash::make('siswa'),
        ]);
        User::create([
            'name' => 'siswa2',
            'status' => 'siswa2',
            'No_hp' => '08123456789',
            'email' => 'siswa2@gmail.com',
            'password' => Hash::make('siswa'),
        ]);
    }
}
