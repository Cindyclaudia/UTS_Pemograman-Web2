<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        Jurusan::create(['nama_jurusan' => 'Teknik Informatika', 'akreditasi' => 'A']);
        Jurusan::create(['nama_jurusan' => 'Sistem Informasi', 'akreditasi' => 'A']);
        Jurusan::create(['nama_jurusan' => 'Teknik Elektro', 'akreditasi' => 'B']);
    }
}