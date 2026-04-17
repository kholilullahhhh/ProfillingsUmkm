<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Classes;
use App\Models\User;
use App\Models\Admin;
use App\Models\Umkm;
use App\Models\JenisUsaha;


class umkmController extends Controller
{
    private $menu = 'umkm';

    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $datas = User::where('role', 'user')->latest()->get();
    //     $menu = $this->menu;
    //     return view('pages.admin.umkm.index', compact('menu', 'datas'));
    // }
    
   public function index()
{
    $user = auth()->user();

    if ($user->role == 'admin') {
        // Admin lihat semua data
        $datas = Umkm::with(['user', 'jenisUsaha'])
            ->latest()
            ->get();
    } else {
        // User hanya lihat data miliknya
        $datas = Umkm::with(['user', 'jenisUsaha'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();
    }

    $menu = $this->menu;

    return view('pages.admin.umkm.index', compact('menu', 'datas'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $menu = $this->menu;
    $users = User::where('role', 'user')->get();
    $jenisUsahas = JenisUsaha::all(); // Perbaikan: ambil semua data dari model JenisUsaha
    
    return view('pages.admin.umkm.create', compact('menu', 'users', 'jenisUsahas'));
}

    /**
     * Store a newly created resource in storage.
     */

    // public function store(Request $request)
    // {
    //     $r = $request->all();
    //     // dd($r);
    //     // Menyimpan data umkm
    //     // dd($r);
    //     User::create($r);
    //     return redirect()->route('umkm.index')->with('message', 'Data umkm berhasil ditambahkan.');
    // }

    // public function store(Request $r)
    // {
    //     $cek_username = Admin::where('username', $r->username)->where('role', $r->role)->first();
    //     if ($cek_username == null) {
    //         // dd($r);
    //         $r = $r->all();
    //         $r['password'] = bcrypt($r['password']);
    //         Admin::create($r);
    //         User::create($r);

    //         return redirect()->route('umkm.index')->with('message', 'store');
    //     } else {
    //         return redirect()->route('umkm.index')->with('message', 'username sudah ada');
    //     }
    // }

    public function store(Request $request)
{
    // cek username di users
    // $cek = User::where('username', $request->username)->first();
    $cek = Admin::where('username', $request->username)->where('role', $request->role)->first();

    if ($cek) {
        return redirect()->route('umkm.index')
            ->with('message', 'Username sudah ada');
    }

    // simpan user
    $user = User::create([
    'name' => $request->pemilik,
    'username' => $request->username,
    'password' => bcrypt($request->password),
    'jabatan' => $request->jabatan,
    'role' => 'user'
]);

$admin = Admin::create([
    'name' => $request->pemilik,
    'username' => $request->username,
    'password' => bcrypt($request->password),
    'jabatan' => $request->jabatan,
    'role' => 'user'
]);

    // simpan umkm
    Umkm::create([
        'user_id' => $user->id,
        'jenis_usaha_id' => $request->jenis_usaha_id,
        'nama_usaha' => $request->nama_usaha,
        'pemilik' => $request->pemilik,
        'alamat' => $request->alamat,
        'kabupaten' => $request->kabupaten,
        'tahun_berdiri' => $request->tahun_berdiri,
        'skala_usaha' => $request->skala_usaha,
        'omset_per_tahun' => $request->omset_per_tahun,
        'kontak' => $request->kontak,
        'status_binaan' => $request->status_binaan ?? true,
    ]);

    return redirect()->route('umkm.index')->with('message', 'Data UMKM berhasil ditambahkan');
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // $data = User::findOrFail($id);
        $data = Umkm::with('user')->findOrFail($id);
    $jenisUsahas = JenisUsaha::all(); // Perbaikan: ambil semua data dari model JenisUsaha

        $menu = $this->menu;

        return view('pages.admin.umkm.edit', compact('data', 'jenisUsahas','menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request)
    // {
    //     $r = $request->all();
    //     $data = User::find($r['id']);

    //     // dd($r);
    //     $data->update($r);

    //     return redirect()->route('umkm.index')->with('message', 'Data umkm berhasil diperbarui.');
    // }


   public function update(Request $request)
{
    // ambil UMKM berdasarkan ID
    $umkm = Umkm::findOrFail($request->id);

    // ambil user dari relasi
    $user = User::findOrFail($umkm->user_id);

    // update user
    $user->update([
        'name' => $request->pemilik,
        'username' => $request->username,
        'jabatan' => $request->jabatan,
    ]);

    if ($request->password) {
        $user->update([
            'password' => bcrypt($request->password)
        ]);
    }

    // update UMKM
    $umkm->update([
        'jenis_usaha_id' => $request->jenis_usaha_id,
        'nama_usaha' => $request->nama_usaha,
        'pemilik' => $request->pemilik,
        'alamat' => $request->alamat,
        'kabupaten' => $request->kabupaten,
        'tahun_berdiri' => $request->tahun_berdiri,
        'skala_usaha' => $request->skala_usaha,
        'omset_per_tahun' => $request->omset_per_tahun,
        'kontak' => $request->kontak,
        'status_binaan' => $request->status_binaan,
    ]);

    return redirect()->route('umkm.index')
        ->with('message', 'Data UMKM berhasil diperbarui');
}

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy($id)
    // {
    //     try {
    //         $user = User::findOrFail($id);
    //         $admin = Admin::findOrFail($id);

    //         $user->delete();
    //         $admin->delete();

    //         return redirect()->route('umkm.index')
    //             ->with('message', 'Data siswa dan admin berhasil dihapus.');

    //     } catch (\Exception $e) {
    //         return redirect()->route('umkm.index')
    //             ->with('error', 'Gagal menghapus data siswa dan admin: ' . $e->getMessage());
    //     }
    // }

    public function destroy($id)
{
    try {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('umkm.index')
            ->with('message', 'Data berhasil dihapus');
    } catch (\Exception $e) {
        return redirect()->route('umkm.index')
            ->with('error', 'Gagal hapus: ' . $e->getMessage());
    }
}

}
