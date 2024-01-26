<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriModel;
use App\Http\Resources\ProfesiResource;
use App\Models\ProfesiModel;

class KategoriController extends Controller
{
    public function index()
    {
        $listkategori = KategoriModel::latest()->paginate(5);
        return new ProfesiResource(true,'List Data Kategori', $listkategori);
    }

    public function store(Request $request)
    {
        $validasi = validator($request->all(),[
            'kategori'  => 'required',
            'deskripsi' => 'required',
            'status'    => 'required'
        ]);

        if($validasi->fails()){
            return response()->json($validasi->errors(), 422);
        }

        $insert = KategoriModel::create([
            'kategori'  => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'status'    => $request->status,
        ]);

        return new ProfesiResource(true, 'Berhasil Menyimpan Data', $insert);
    }

    public function show(KategoriModel $kategori)
    {
        return new ProfesiResource(true, 'Data Kategori Ditemukan', $kategori);
    }

    public function update(Request $request, KategoriModel $kategori)
    {
        $validasi = validator($request->all(),[
            'kategori'  => 'required',
            'deskripsi' => 'required',
            'status'    => 'required',
        ]);

        if($validasi->fails()){
            return response()->json($validasi->errors(), 422);
        }

        $kategori->update([
            'kategori'  => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'status'    => $request->status,
        ]);

        return new ProfesiResource(true, "Data Berhasil Di Update", $kategori);
    }

    public function destroy(KategoriModel $kategori)
    {
        $kategori->delete();
        return new ProfesiResource(true, "Data Berhasil Di Hapus", null);
    }
}
