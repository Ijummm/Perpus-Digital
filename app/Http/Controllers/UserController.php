<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function createPetugas()
    {
        return view('admin.user.create_petugas');
    }

    public function storePetugas(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:user,username',
            'password' => 'required|min:5',
            'email' => 'required|email|unique:user,email',
            'namaLengkap' => 'required',
            'alamat' => 'required',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'namaLengkap' => $request->namaLengkap,
            'alamat' => $request->alamat,
            'role' => 'petugas',
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Petugas baru berhasil didaftarkan!');
    }
}
