<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Mapel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class JadwalController extends Controller
{
    private $menu = 'jadwal';

    public function index()
    {
        $menu = $this->menu;
        $datas = Jadwal::with(['user', 'mapel'])
            ->where('user_id', Auth::id())
            ->get();
        return view('pages.user.jadwal.index', compact('datas', 'menu'));
    }
    public function edit($id)
    {
        $data = Jadwal::find($id);
        $menu = $this->menu;
        $mapel = Mapel::all();
        $users = User::where('role', 'user')->get();
        return view('pages.user.jadwal.edit', compact('data', 'mapel', 'users', 'menu'));
    }
    public function update(Request $request)
    {
        $r = $request->all();
        $data = Jadwal::find($r['id']);
        // dd($r);
        $data->update($r);
        return redirect()->route('user.jadwal.index')->with('message', 'update');
    }
}
