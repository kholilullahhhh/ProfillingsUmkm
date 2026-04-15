<?php

namespace App\Http\Controllers;

use App\Models\JenisUsaha;
use Illuminate\Http\Request;

class JenisUsahaController extends Controller
{

    private $menu = 'jenis_usaha';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = JenisUsaha::get();
        $menu = $this->menu;
        return view('pages.admin.jenisUsaha.index', compact('menu', 'datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menu = $this->menu;
        return view('pages.admin.jenisUsaha.create', compact('menu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $r = $request->all();
        // dd($r);
        JenisUsaha::create($r);


        return redirect()->route('jenis_usaha.index')->with('message', 'store');
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisUsaha $jenis_usaha)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = JenisUsaha::find($id);
        $menu = $this->menu;

        return view('pages.admin.jenisUsaha.edit', compact('data', 'menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $r = $request->all();
        $data = JenisUsaha::find($r['id']);

        // $r['nama_kegiatan'] = $r['judul'];
        // $r['tempat_kegiatan'] = $r['lokasi_kegiatan'];

        // dd($r);
        $data->update($r);

        return redirect()->route('jenis_usaha.index')->with('message', 'update');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = JenisUsaha::find($id);
        $data->delete();
        return response()->json($data);
    }
}
