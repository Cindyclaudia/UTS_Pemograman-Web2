<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Matakuliah;

class MatakuliahSeeder extends Seeder
{
    public function run(): void
    {
        Matakuliah::create(['nama_matakuliah' => 'Pemrograman Web', 'sks' => 3, 'id_jurusan' => 1]);
        Matakuliah::create(['nama_matakuliah' => 'Basis Data', 'sks' => 3, 'id_jurusan' => 1]);
        Matakuliah::create(['nama_matakuliah' => 'Sistem Informasi Manajemen', 'sks' => 3, 'id_jurusan' => 2]);
        Matakuliah::create(['nama_matakuliah' => 'Rangkaian Listrik', 'sks' => 3, 'id_jurusan' => 3]);
    }
}