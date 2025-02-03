<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\Berita;
use Carbon\Carbon;

class BeritaController extends Controller
{

    public function index()
    {
        $data = Berita::all();

        // dd($data);
        return view('pages.berita-admin', compact('data'));
    }



    public function create()
    {
        return view('pages.add-berita');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $getLastData = Berita::orderBy('id', 'desc')->first();
        $getId = 0;
        if ($getLastData) {
            $getId = $getLastData->id;
        }
        if ($request) {
            if ($request->hasFile('gambar')) {

                // $getPegawaiBaru = Pegawai::orderBy('created_at', 'desc')->first();
                // $getKonfigCuti = Konfig_cuti::where('tahun',(new \DateTime())->format('Y'))->first();
                $fileName = $request->file('gambar')->getClientOriginalName();
                $request->file('gambar')->move('img/berita', $fileName);

                $berita = new Berita;
                $berita->id = $getId->id + 1;
                $berita->judul = $request->judul;
                $berita->deskripsi = $request->deskripsi;
                $berita->gambar = $fileName;
                $berita->created_at = Carbon::now();
                $berita->updated_at = Carbon::now();

                $berita->save();

                return redirect('/admin/berita');



                // ->with('success', 'Berhasil membuat Materi');
            } else {
                return redirect('/admin/berita');
                // ->with('failed', 'Gagal membuat Materi');
            }
        } else {
            return redirect('/admin/berita');
            // ->with('failed', 'Gagal membuat Materi');
        }
    }
    public function edit(Request $request)
    {
        // $data['karyawan'] = Pegawai::where([
        //     'id' => $request->segment(3)
        // ])->first();
        $berita = Berita::where([
            'id' => $request->segment(3)
        ])->first();

        return view('pages.edit-berita', compact('berita'));
    }

    public function update(Request $request)
    {
        $berita = Berita::where([
            'id' => $request->segment(3)
        ])->first();
        $berita->judul = $request->judul;
        $berita->deskripsi = $request->deskripsi;
        $berita->updated_at = Carbon::now();
        if ($request->hasFile('gambar')) {
            $fileName = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move('img/berita', $fileName);

            $berita->gambar = $fileName;
            $berita->save();
            return redirect('/admin/berita');
        } else {
            $berita->save();
            return redirect('/admin/berita');
        }
    }

    public function destroy(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);



        if ($berita->delete()) {
            return redirect('/admin/berita');
        } else {
            return redirect('/admin/berita');
        }
    }

    public function getListBerita()
    {
        $data = Berita::all();

        return response()->json([
            'success' => true,
            'message' => 'List data berita berhasil diambil.',
            'data' => $data
        ], 200);
    }
}
