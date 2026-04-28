<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Halaman Login
     */
    public function login()
    {
        return view('pages.auth.login', ['menu' => 'login']);
    }

    /**
     * Proses Login
     */
    public function login_action(Request $request)
    {
        if ($request->role == null && $request->username == 'admin') {
            $request->role = 'admin';
        }

        if ($request->role == null) {
            return redirect()->back()->with('message', 'gagal login');
        }

        $user = Admin::where('username', $request->username)
            ->where('role', $request->role)
            ->first();

        $user1 = User::where('username', $request->username)
            ->where('role', $request->role)
            ->first();

        $cek = Auth::attempt([
            'username' => $request->username,
            'password' => $request->password,
            'role'     => $request->role
        ]);

        if ($cek) {

            if ($user) {
                Session::put('user_id', $user->id);
                Session::put('name', $user->name);
                Session::put('username', $user->username);
                Session::put('role', $user->role);
            }

            if ($user1) {
                Session::put('user_id', $user1->id);
                Session::put('name', $user1->name);
                Session::put('username', $user1->username);
                Session::put('role', $user1->role);
            }

            Session::put('cek', true);

            return redirect()->route('dashboard')
                ->with('message', 'sukses login');
        } else {
            return redirect()->back()->with('message', 'gagal login');
        }
    }

    /**
     * Halaman Register
     */
    public function register()
    {
        return view('pages.auth.register', ['menu' => 'register']);
    }

    /**
     * Proses Register
     */
    public function register_action(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role'     => 'user'
        ]);

        return redirect()->route('login')
            ->with('message', 'registrasi berhasil');
    }

    /**
     * Logout
     */
    public function logout()
    {
        Auth::logout();
        Session::flush();

        return redirect()->route('login')
            ->with('message', 'sukses logout');
    }
}