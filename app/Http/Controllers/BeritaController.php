<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\Berita;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

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
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $getLastData = Berita::orderBy('id', 'desc')->first();
        $getId = $getLastData ? $getLastData->id : 0;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = 'img/berita/' . $fileName;

            // Simpan file ke direktori publik (public/img/berita)
            Storage::disk('public')->putFileAs('img/berita', $file, $fileName);

            // Simpan data ke database
            $berita = new Berita();
            $berita->id = $getId + 1;
            $berita->judul = $request->judul;
            $berita->deskripsi = $request->deskripsi;
            $berita->gambar = $fileName;
            $berita->created_at = Carbon::now();
            $berita->updated_at = Carbon::now();
            $berita->save();

            // Jalankan perintah Git untuk push ke repository GitHub
            $repoPath = base_path(); // Pastikan Laravel berada di dalam repository GitHub
            exec("cd {$repoPath} && git add . && git commit -m 'Tambah berita: {$request->judul}' && git push origin main");

            return redirect('/admin/berita')->with('success', 'Berita berhasil ditambahkan dan dikirim ke GitHub!');
        }

        return redirect('/admin/berita')->with('failed', 'Gagal menambahkan berita, gambar tidak ditemukan.');
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
