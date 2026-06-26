<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (session('admin') === true) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $admin = AdminUser::where('username', $request->username)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            session([
                'admin' => true,
                'admin_id' => $admin->id,
                'admin_username' => $admin->username
            ]);

            return redirect()->route('admin.dashboard')->with('success', 'Login berhasil, selamat datang');
        }

        return redirect()->back()->with('error', 'Username atau password salah')->withInput();
    }

    public function logout()
    {
        session()->forget(['admin', 'admin_id', 'admin_username']);
        return redirect()->route('admin.login')->with('success', 'Berhasil logout');
    }
}
