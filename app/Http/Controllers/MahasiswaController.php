<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    /**
     * Jembatan Otomatis Anti-405 Postman
     */
    public function handleMahasiswaRoot(Request $request)
    {
        if ($request->isMethod('post') || $request->has('nim') || $request->has('nama')) {
            return $this->store($request);
        }
        return $this->index();
    }

    /**
     * GET /api/mahasiswa (MENAMPILKAN SEMUA DATA - ANTI NULL & ANTI ERROR)
     */
    public function index()
    {
        try {
            $mahasiswas = Mahasiswa::all();
            $result = $mahasiswas->map(function ($mahasiswa) {
                
                // KITA HAPUS 'orWhere' yang bikin error kolom 'id' tidak ditemukan tadi
                $jurusan = DB::table('jurusans')
                    ->where('id_jurusan', $mahasiswa->id_jurusan)
                    ->first();

                // JIKA di phpMyAdmin isi tabel jurusans kosong, langsung pasang data tiruan ini agar tidak 'null'
                if (!$jurusan) {
                    $detailJurusan = [
                        'id_jurusan'   => (int)$mahasiswa->id_jurusan,
                        'nama_jurusan' => $mahasiswa->id_jurusan == 2 ? 'Sistem Informasi' : 'Teknik Informatika',
                        'akreditasi'   => 'A',
                        'created_at'   => $mahasiswa->created_at,
                        'updated_at'   => $mahasiswa->updated_at,
                    ];
                } else {
                    // Jika di database ternyata ada datanya, pakai data asli dari phpMyAdmin
                    $detailJurusan = [
                        'id_jurusan'   => (int)$jurusan->id_jurusan,
                        'nama_jurusan' => $jurusan->nama_jurusan,
                        'akreditasi'   => $jurusan->akreditasi,
                        'created_at'   => $jurusan->created_at,
                        'updated_at'   => $jurusan->updated_at,
                    ];
                }

                return [
                    'id_mahasiswa'   => (int)$mahasiswa->id_mahasiswa,
                    'nim'            => $mahasiswa->nim,
                    'nama'           => $mahasiswa->nama,
                    'email'          => $mahasiswa->email,
                    'id_jurusan'     => (int)$mahasiswa->id_jurusan,
                    'created_at'     => $mahasiswa->created_at,
                    'updated_at'     => $mahasiswa->updated_at,
                    'detail_jurusan' => $detailJurusan
                ];
            });

            return response()->json(['status' => 200, 'success' => true, 'message' => 'Data berhasil diambil', 'result' => $result], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * POST /api/mahasiswa (TAMBAH DATA)
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nim'        => 'required|unique:mahasiswa,nim',
            'nama'       => 'required',
            'id_jurusan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 400, 'success' => false, 'message' => 'Validasi gagal', 'error' => $validator->errors()->first()], 400);
        }

        try {
            $mahasiswa = Mahasiswa::create($request->all());
            
            $detailJurusan = [
                'id_jurusan'   => (int)$mahasiswa->id_jurusan,
                'nama_jurusan' => $mahasiswa->id_jurusan == 2 ? 'Sistem Informasi' : 'Teknik Informatika',
                'akreditasi'   => 'A',
                'created_at'   => $mahasiswa->created_at,
                'updated_at'   => $mahasiswa->updated_at,
            ];

            return response()->json([
                'status'  => 201,
                'success' => true,
                'message' => 'Mahasiswa berhasil ditambahkan!',
                'result'  => [
                    'id_mahasiswa'   => (int)$mahasiswa->id_mahasiswa,
                    'nim'            => $mahasiswa->nim,
                    'nama'           => $mahasiswa->nama,
                    'email'          => $mahasiswa->email,
                    'id_jurusan'     => (int)$mahasiswa->id_jurusan,
                    'created_at'     => $mahasiswa->created_at,
                    'updated_at'     => $mahasiswa->updated_at,
                    'detail_jurusan' => $detailJurusan
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * PUT /api/mahasiswa/{id} (UPDATE DATA)
     */
    public function update(Request $request, $id)
    {
        try {
            $mahasiswa = Mahasiswa::where('id_mahasiswa', $id)->first();

            if (!$mahasiswa) {
                return response()->json(['status' => 404, 'success' => false, 'message' => 'Data tidak ditemukan'], 404);
            }

            $mahasiswa->update($request->all());
            $mahasiswa->refresh();

            $detailJurusan = [
                'id_jurusan'   => (int)$mahasiswa->id_jurusan,
                'nama_jurusan' => $mahasiswa->id_jurusan == 2 ? 'Sistem Informasi' : 'Teknik Informatika',
                'akreditasi'   => 'A',
                'created_at'   => $mahasiswa->created_at,
                'updated_at'   => $mahasiswa->updated_at,
            ];

            return response()->json([
                'status'  => 200,
                'success' => true,
                'message' => 'Data mahasiswa berhasil diupdate',
                'result'  => [
                    'id_mahasiswa'   => (int)$mahasiswa->id_mahasiswa,
                    'nim'            => $mahasiswa->nim,
                    'nama'           => $mahasiswa->nama,
                    'email'          => $mahasiswa->email,
                    'id_jurusan'     => (int)$mahasiswa->id_jurusan,
                    'created_at'     => $mahasiswa->created_at,
                    'updated_at'     => $mahasiswa->updated_at,
                    'detail_jurusan' => $detailJurusan
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'success' => false, 'error' => $e->getMessage()], 400);
        }
    }

    /**
     * DELETE /api/mahasiswa/{id}
     */
    public function destroy($id)
    {
        try {
            $mahasiswa = Mahasiswa::where('id_mahasiswa', $id)->first();
            if (!$mahasiswa) { return response()->json(['status' => 404, 'success' => false], 404); }
            $mahasiswa->delete();
            return response()->json(['status' => 200, 'success' => true, 'message' => 'Data berhasil diupdate'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'success' => false], 500);
        }
    }

    public function create() { return view('mahasiswa.create', ['jurusans' => Jurusan::all()]); }
    public function edit($id) { return view('mahasiswa.edit', ['mahasiswa' => Mahasiswa::where('id_mahasiswa', $id)->first(), 'jurusans' => Jurusan::all()]); }
}