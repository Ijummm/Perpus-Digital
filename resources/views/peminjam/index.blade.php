@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">
        {{ isset($kategori) ? 'Kategori: ' . $kategori->namaKategori : 'Koleksi Buku Perpustakaan' }}
    </h4>
    
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="row">
        @forelse($bukus as $buku)
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title text-primary">{{ $buku->judul }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $buku->penulis }}</h6>
                    <hr>
                    <p class="card-text small">
                        <strong>Penerbit:</strong> {{ $buku->penerbit }}<br>
                        <strong>Tahun:</strong> {{ $buku->tahunTerbit }}
                    </p>
                    <div class="mb-2">
                        @foreach($buku->kategoris as $kategori)
                            <span class="badge bg-info text-dark" style="font-size: 0.7rem;">{{ $kategori->namaKategori }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer bg-white border-top-0 pb-3">
                    <a href="{{ route('pinjam.form', $buku->bukuID) }}" class="btn btn-primary btn-sm w-100 shadow-sm">
                        <i class="bi bi-book"></i> Pinjam Buku
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center mt-5">
            <div class="alert alert-light border">Belum ada koleksi buku yang tersedia.</div>
        </div>
        @endforelse
    </div>
</div>
@endsection