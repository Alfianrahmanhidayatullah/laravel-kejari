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

    // public function store(Request $request)
    // {
    //     // dd($request->all());
    //     $getLastData = Berita::orderBy('id', 'desc')->first();
    //     $getId = 0;
    //     if ($getLastData) {
    //         $getId = $getLastData->id;
    //     }
    //     if ($request) {
    //         if ($request->hasFile('gambar')) {

    //             // $getPegawaiBaru = Pegawai::orderBy('created_at', 'desc')->first();
    //             // $getKonfigCuti = Konfig_cuti::where('tahun',(new \DateTime())->format('Y'))->first();
    //             $fileName = $request->file('gambar')->getClientOriginalName();
    //             $request->file('gambar')->move('img/berita', $fileName);

    //             $berita = new Berita;
    //             $berita->id = $getId->id + 1;
    //             $berita->judul = $request->judul;
    //             $berita->deskripsi = $request->deskripsi;
    //             $berita->gambar = $fileName;
    //             $berita->created_at = Carbon::now();
    //             $berita->updated_at = Carbon::now();

    //             $berita->save();

    //             return redirect('/admin/berita');



    //             // ->with('success', 'Berhasil membuat Materi');
    //         } else {
    //             return redirect('/admin/berita');
    //             // ->with('failed', 'Gagal membuat Materi');
    //         }
    //     } else {
    //         return redirect('/admin/berita');
    //         // ->with('failed', 'Gagal membuat Materi');
    //     }
    // }

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
            // Storage::disk('public')->put($filePath, file_get_contents($file));
            $fileName = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move('img/berita', $fileName);

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
            // Jalankan perintah Git untuk push ke repository GitHub
            // $repoPath = base_path(); // Pastikan Laravel berada di dalam repository GitHub
            // // exec("cd {$repoPath} && git add . && git commit -m 'Tambah berita: {$request->judul}' && git push origin main");
            // exec("cd {$repoPath} && touch database.sqlite && git add . && git commit -m 'Tambah berita: {$request->judul}' && git push origin main");


            // Log hasil eksekusi Git
            // file_put_contents("{$repoPath}/git-log.txt", implode("\n", $output), FILE_APPEND);

            // return redirect('/admin/berita')->with('success', 'Berita berhasil ditambahkan dan dikirim ke GitHub!');
            // Pastikan Laravel berada di dalam repository GitHub
            // Pastikan Laravel berada di dalam repository GitHub
            // Ambil path repository Laravel
            $repoPath = base_path();

            // Deteksi OS
            $isWindows = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';

            // Perintah touch untuk memicu perubahan Git
            if ($isWindows) {
                $touchCommand = "echo. >> database.sqlite";
                $cdCommand = "cd {$repoPath}"; // Tidak pakai /D karena di C:
            } else {
                $touchCommand = "touch database.sqlite";
                $cdCommand = "cd {$repoPath}";
            }

            // Gabungkan command Git
            $command = "{$cdCommand} && {$touchCommand} && git add . && git commit -m \"Tambah berita: {$request->judul}\" && git push origin main";

            // Jalankan command Git
            exec($command, $output, $return_var);

            // Cek apakah Git berhasil dieksekusi
            if ($return_var === 0) {
                return redirect('/admin/berita')->with('success', 'Berita berhasil ditambahkan dan dikirim ke GitHub!');
            } else {
                return redirect('/admin/berita')->with('warning', 'Berita berhasil ditambahkan, tetapi gagal dikirim ke GitHub.');
            }
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
        // $data = Berita::all();
        $data = Berita::latest()->get();


        return response()->json([
            'success' => true,
            'message' => 'List data berita berhasil diambil.',
            'data' => $data
        ], 200);
    }
}
