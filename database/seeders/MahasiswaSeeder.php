<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        Mahasiswa::create(['nim' => '2301001', 'nama' => 'Cindy Aulia', 'id_jurusan' => 1]);
        Mahasiswa::create(['nim' => '2301002', 'nama' => 'Budi Santoso', 'id_jurusan' => 1]);
        Mahasiswa::create(['nim' => '2301003', 'nama' => 'Siti Rahayu', 'id_jurusan' => 2]);
        Mahasiswa::create(['nim' => '2301004', 'nama' => 'Ahmad Fauzi', 'id_jurusan' => 3]);
    }
}