<?php

namespace App\Http\Controllers;

use App\Models\KategoriBuku;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        Peminjaman::where('statusPeminjaman', 'Dipinjam')
            ->where('tanggalPengembalian', '<', now()->format('Y-m-d'))
            ->update(['statusPeminjaman' => 'Selesai']);

        $bukus = Buku::with('kategoris')->get();
        return view('peminjam.index', compact('bukus'));
    }

    public function pinjam(Request $request, $id)
    {
        Peminjaman::create([
            'userID' => Auth::id(),
            'bukuID' => $id,
            'tanggalPeminjaman' => now(),
            'statusPeminjaman' => 'Dipinjam'
        ]);

        return redirect()->back()->with('success', 'Buku berhasil dipinjam!');
    }

    public function create($id)
    {
        $buku = Buku::findOrFail($id);
        return view('peminjam.pinjam_form', compact('buku'));
    }

    public function store(Request $request)
    {
        $maxDate = date('Y-m-d', strtotime($request->tanggalPeminjaman . ' + 7 days'));

        $request->validate([
            'bukuID' => 'required',
            'tanggalPeminjaman' => 'required|date',
            'tanggalPengembalian' => [
                'required',
                'date',
                'after_or_equal:tanggalPeminjaman',
                'before_or_equal:' . $maxDate,
            ],
        ], [
            'tanggalPengembalian.before_or_equal' => 'Maksimal waktu peminjaman adalah 7 hari.',
            'tanggalPengembalian.after_or_equal' => 'Tanggal kembali tidak boleh sebelum tanggal pinjam.'
        ]);

        Peminjaman::create([
            'userID' => Auth::user()->userID,
            'bukuID' => $request->bukuID,
            'tanggalPeminjaman' => $request->tanggalPeminjaman,
            'tanggalPengembalian' => $request->tanggalPengembalian,
            'statusPeminjaman' => 'Dipinjam',
        ]);

        return redirect()->route('peminjam.dashboard')->with('success', 'Buku berhasil dipinjam!');
    }

    public function kategori($id)
    {
        $kategori = KategoriBuku::with('bukus')->findOrFail($id);

        $bukus = $kategori->bukus;

        return view('peminjam.index', compact('bukus', 'kategori'));
    }

    public function koleksiPribadi()
    {
        $peminjamans = Peminjaman::with('buku')
            ->where('userID', Auth::user()->userID)
            ->whereIn('statusPeminjaman', ['Dipinjam', 'Menunggu di ACC'])
            ->get();

        return view('peminjam.koleksi', compact('peminjamans'));
    }

    public function kembalikan($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        if($peminjaman->userID == Auth::user()->userID) {
            $peminjaman->update([
                'statusPeminjaman' => 'Menunggu di ACC',
            ]);
            return redirect()->back()->with('success', 'Permintaan pengembalian dikirim. Silahkan serahkan buku ke petugas');
        }
        return redirect()->back()->with('error', 'Akses ditolak');
    }

    public function laporan(Request $request)
    {
        $query = Peminjaman::with(['user', 'buku']);

        if ($request->tgl_mulai && $request->tgl_selesai) {
            $query->whereBetween('tanggalPeminjaman', [$request->tgl_mulai, $request->tgl_selesai]);
        }
        if ($request->status) {
            $query->where('statusPeminjaman', $request->status);
        }
        $laporans = $query->latest()->get();
        
        return view('admin.laporan.index', compact('laporans'));
    }

    public function acc($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        $peminjaman->update([
            'statusPeminjaman' => 'Selesai',
            'tanggalPengembalian' => now()
        ]);

        return redirect()->back()->with('success', 'Buku telah diterima dan status diperbarui.');
    }

    public function tolakKembali($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        $peminjaman->update([
            'statusPeminjaman' => 'Dipinjam',
        ]);

        return redirect()->back()->with('success', 'Pengembalian ditolak. Status buku kembali menjadi Dipinjam.');
    }
}
