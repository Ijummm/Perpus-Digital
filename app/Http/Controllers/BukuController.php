<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Buku;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::with('kategoris')->get();
        return view('admin.buku.index', compact('bukus'));
    }

    public function create()
    {
        $kategoris = KategoriBuku::all();
        return view('admin.buku.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahunTerbit' => 'required|numeric',
            'kategoriID' => 'required|array'
        ]);

        $buku = Buku::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahunTerbit' => $request->tahunTerbit,
        ]);

        $buku->kategoris()->attach($request->kategoriID);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $kategoris = KategoriBuku::all();
        return view('admin.buku.edit', compact('buku', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahunTerbit' => 'required|numeric',
            'kategoriID' => 'required|array'
        ]);

        $buku = Buku::findOrFail($id);
        $buku->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahunTerbit' => $request->tahunTerbit,
        ]);

        $buku->kategoris()->sync($request->kategoriID);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();
        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus.');
    }
    
        public function adminDashboard()
    {
        $totalBuku = Buku::count();
        $totalPeminjaman = Peminjaman::where('statusPeminjaman', 'Dipinjam')->count();
        $totalPetugas = User::where('role', 'petugas')->count();

        return view('admin.dashboard', compact('totalBuku', 'totalPeminjaman', 'totalPetugas'));
    }
}