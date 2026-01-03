<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Mapel;
use App\Models\User;


class JadwalController extends Controller
{
    private $menu = 'jadwal';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = $this->menu;
        $datas = Jadwal::with(['user', 'mapel'])->get();
        return view('pages.admin.jadwal.index', compact('datas', 'menu'));
    }
    public function create()
    {
        $menu = $this->menu;
        $mapel = Mapel::all();
        $users = User::where('role', 'user')->get();
        return view('pages.admin.jadwal.create', compact('users', 'mapel', 'menu'));
    }

    public function store(Request $request)
    {
        $r = $request->all();
        Jadwal::create($r);
        return redirect()->route('jadwal.index')->with('message', 'store');
    }

    public function edit($id)
    {
        $data = Jadwal::find($id);
        $menu = $this->menu;
        $mapel = Mapel::all();
        $users = User::where('role', 'user')->get();
        return view('pages.admin.jadwal.edit', compact('data', 'mapel', 'users', 'menu'));
    }
    public function update(Request $request)
    {
        $r = $request->all();
        $data = Jadwal::find($r['id']);
        // dd($r);
        $data->update($r);
        return redirect()->route('jadwal.index')->with('message', 'update');
    }
    public function destroy($id)
    {
        $data = Jadwal::find($id);
        $data->delete();
        return response()->json($data);
    }


}
