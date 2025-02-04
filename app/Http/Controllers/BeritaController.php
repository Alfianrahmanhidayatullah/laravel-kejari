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




    use Illuminate\Support\Facades\Storage;
    use Carbon\Carbon;
    use App\Models\Berita;

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

            // Simpan file ke direktori public
            Storage::disk('public')->put($filePath, file_get_contents($file));

            // Simpan data ke database
            $berita = new Berita();
            $berita->id = $getId + 1;
            $berita->judul = $request->judul;
            $berita->deskripsi = $request->deskripsi;
            $berita->gambar = $fileName;
            $berita->created_at = Carbon::now();
            $berita->updated_at = Carbon::now();
            $berita->save();

            // Pastikan Laravel berada di dalam repository GitHub
            $repoPath = base_path();

            // Buat atau update file `.git-trigger`
            $triggerFile = "{$repoPath}/.git-trigger";
            file_put_contents($triggerFile, "Last push: " . Carbon::now());

            // Jalankan Git secara bertahap
            $output = [];
            exec("cd {$repoPath} && git add .git-trigger img/berita/{$fileName}", $output);
            exec("cd {$repoPath} && git commit -m 'Tambah berita: {$request->judul}'", $output);
            exec("cd {$repoPath} && git push origin main", $output);

            // Log hasil eksekusi Git
            file_put_contents("{$repoPath}/git-log.txt", implode("\n", $output), FILE_APPEND);

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
