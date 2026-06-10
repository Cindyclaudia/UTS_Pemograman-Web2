<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('matakuliahs', function (Blueprint $table) {
            $table->id('id_matakuliah');
            $table->string('nama_matakuliah');
            $table->integer('sks');
            $table->unsignedBigInteger('id_jurusan');
            $table->foreign('id_jurusan')->references('id_jurusan')->on('jurusans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matakuliahs');
    }
};