@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Daftar Koleksi Buku</h4>
        <div>
            <a href="{{ route('kategori.create') }}" class="btn btn-outline-dark btn-sm me-2">
                <i class="bi bi-tag"></i> Tambah Kategori
            </a>
            <a href="{{ route('buku.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg"></i> Tambah Buku Baru
            </a>
        </div>     
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th>Tahun</th>
                            <th>Kategori</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bukus as $buku)
                        <tr>
                            <td>{{ $buku->bukuID }}</td>
                            <td><strong>{{ $buku->judul }}</strong></td>
                            <td>{{ $buku->penulis }}</td>
                            <td>{{ $buku->penerbit }}</td>
                            <td>{{ $buku->tahunTerbit }}</td>
                            <td>
                                @foreach($buku->kategoris as $kategori)
                                    <span class="badge bg-secondary">{{ $kategori->namaKategori }}</span>
                                @endforeach
                            </td>
                            <td class="text-center">
                                <form action="{{ route('buku.destroy', $buku->bukuID) }}" method="POST">
                                    <a href="{{ route('buku.edit', $buku->bukuID) }}" class="btn btn-warning btn-sm text-white">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus buku ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada data buku.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection