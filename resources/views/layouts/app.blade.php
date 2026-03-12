<?php
use App\Models\KategoriBuku;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">📚 Perpus Digital</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('buku.index') }}">Data Buku</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('kategori.index') }}">Kategori Buku</a></li>
                            
                            @if(Auth::user()->role == 'admin')
                                <li class="nav-item"><a class="nav-link text-warning fw-bold" href="{{ route('admin.user.create') }}">Tambah Petugas</a></li>
                            @endif

                            <li class="nav-item"><a class="nav-link" href="{{ route('laporan.index') }}">Laporan</a></li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('peminjam.dashboard') }}">Dashboard</a></li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('peminjam.koleksi') }}">Koleksi Saya</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    Kategori Buku
                                </a>
                                <ul class="dropdown-menu">
                                    @php
                                        $kategoris = KategoriBuku::all();
                                    @endphp
                                    @foreach($kategoris as $kat)
                                        <li><a class="dropdown-item" href="{{ route('peminjam.kategori', $kat->kategoriID) }}">{{ $kat->namaKategori }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                        
                        <li class="nav-item border-start ms-lg-3 ps-lg-3">
                            <span class="navbar-text text-white me-3">
                                <i class="bi bi-person-circle"></i> {{ Auth::user()->username }} ({{ ucfirst(Auth::user()->role) }})
                            </span>
                        </li>
                        
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>