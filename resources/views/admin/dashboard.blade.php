@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card bg-primary text-white shadow">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="fw-bold">Dashboard Admin</h2>
                        <p class="mb-0">Selamat datang seekor <strong>{{ Auth::user()->namaLengkap }}</strong>! Kamu memiliki akses penuh ke sistem.</p>
                    </div>
                    <div class="display-4">
                        <i class="bi bi-person-badge"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="text-muted">Total Buku</h6>
                    <h1 class="fw-bold text-primary">{{ $totalBuku }}</h1>
                    <a href="{{ route('buku.index') }}" class="btn btn-sm btn-outline-primary mt-2">Kelola Buku</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="text-muted">Peminjaman Aktif</h6>
                    <h1 class="fw-bold text-success">{{ $totalPeminjaman }}</h1>
                    <a href="{{ route('laporan.index') }}" class="btn btn-sm btn-outline-success mt-2">Lihat Laporan</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="text-muted">Total Petugas</h6>
                    <h1 class="fw-bold text-warning">{{ $totalPetugas }}</h1>
                    <p class="small text-muted mt-2">Akses terbatas untuk petugas.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection