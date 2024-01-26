<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProfesiResource;
use App\Models\ProfesiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ProfesiController extends Controller
{
    public function index()
    {
        $listprofesi = ProfesiModel::latest()->paginate(5);
        return new ProfesiResource(true,'List Data Profesi', $listprofesi);
    }

    public function store(Request $request)
    {
        $validasi = validator($request->all(),[
            'jenisprofesi' => 'required',
            'status'       => 'required',
        ]);

        if($validasi->fails()){
            return response()->json($validasi->errors(), 422);
        }

        $insert = ProfesiModel::create([
            'jenisprofesi' => $request->jenisprofesi,
            'status'       => $request->status,
        ]);

        return new ProfesiResource(true, 'Berhasil Menyimpan Data', $insert);
    }

    public function show(ProfesiModel $profesi){
        return new ProfesiResource(true, "Data Profesi Ditemukan", $profesi);
    }

    public function update(Request $request, ProfesiModel $profesi)
    {
        $validasi = validator($request->all(),[
            'jenisprofesi' => 'required',
            'status'       => 'required',
        ]);

        if($validasi->fails()){
            return response()->json($validasi->errors(), 422);
        }

        $profesi->update([
            'jenisprofesi' => $request->jenisprofesi,
            'status'       => $request->status,
        ]);

        return new ProfesiResource(true, "Data Berhasil Di Update", $profesi);
    }

    public function destroy(ProfesiModel $profesi)
    {
        $profesi->delete();

        return new ProfesiResource(true, 'Data Berhasil Dihapus', null);
    }
}
