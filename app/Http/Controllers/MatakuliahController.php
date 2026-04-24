<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    public function index()
    {
        $matakuliahs = Matakuliah::with('jurusan')->get();
        return view('matakuliah.index', compact('matakuliahs'));
    }

    public function create()
    {
        $jurusans = Jurusan::all();
        return view('matakuliah.create', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_matakuliah' => 'required',
            'sks' => 'required|integer',
            'id_jurusan' => 'required',
        ]);

        Matakuliah::create($request->all());
        return redirect()->route('matakuliah.index')->with('success', 'Matakuliah berhasil ditambahkan!');
    }

    public function edit(Matakuliah $matakuliah)
    {
        $jurusans = Jurusan::all();
        return view('matakuliah.edit', compact('matakuliah', 'jurusans'));
    }

    public function update(Request $request, Matakuliah $matakuliah)
    {
        $request->validate([
            'nama_matakuliah' => 'required',
            'sks' => 'required|integer',
            'id_jurusan' => 'required',
        ]);

        $matakuliah->update($request->all());
        return redirect()->route('matakuliah.index')->with('success', 'Matakuliah berhasil diupdate!');
    }

    public function destroy(Matakuliah $matakuliah)
    {
        $matakuliah->delete();
        return redirect()->route('matakuliah.index')->with('success', 'Matakuliah berhasil dihapus!');
    }
}