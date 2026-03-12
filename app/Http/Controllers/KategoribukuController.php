<?php

namespace App\Http\Controllers;

use App\Models\KategoriBuku;
use Illuminate\Http\Request;

class KategoribukuController extends Controller
{
    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaKategori' => 'required|unique:kategoribuku,namaKategori'
        ]);

        KategoriBuku::create([
            'namaKategori' => $request->namaKategori
        ]);

        return redirect()->route('buku.index')->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    public function index()
    {
        $kategoris = KategoriBuku::all();
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function edit($id)
    {
        $kategori = KategoriBuku::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'namaKategori' => 'required|unique:kategoribuku,namaKategori,' . $id . ',kategoriID'
        ]);

        $kategori = KategoriBuku::findOrFail($id);
        $kategori->update(['namaKategori' => $request->namaKategori]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kategori = KategoriBuku::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
