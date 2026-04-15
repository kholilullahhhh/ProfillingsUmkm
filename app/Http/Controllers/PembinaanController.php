<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembinaan;
use App\Models\Umkm;
use App\Models\User;


class PembinaanController extends Controller
{
private $menu = 'pembinaan';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = $this->menu;
        $datas = Pembinaan::with(['umkm'])->get();
        return view('pages.admin.pembinaan.index', compact('datas', 'menu'));
    }
    public function create()
    {
        $menu = $this->menu;
        $umkm = Umkm::all();
        $users = User::where('role', 'user')->get();
        return view('pages.admin.pembinaan.create', compact('users', 'umkm', 'menu'));
    }

    public function store(Request $request)
    {
        $r = $request->all();
        Pembinaan::create($r);
        return redirect()->route('pembinaan.index')->with('message', 'store');
    }

    public function edit($id)
    {
        $data = Pembinaan::find($id);
        $menu = $this->menu;
        $umkm = Umkm::all();
        $users = User::where('role', 'user')->get();
        return view('pages.admin.pembinaan.edit', compact('data', 'umkm', 'users', 'menu'));
    }
    public function update(Request $request)
    {
        $r = $request->all();
        $data = Pembinaan::find($r['id']);
        // dd($r);
        $data->update($r);
        return redirect()->route('pembinaan.index')->with('message', 'update');
    }
    public function destroy($id)
    {
        $data = pembinaan::find($id);
        $data->delete();
        return response()->json($data);
    }


}
