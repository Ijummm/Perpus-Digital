@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Buku Yang Sedang Saya Pinjam</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Judul Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tenggat Kembali</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjamans as $pinjam)
                    <tr>
                        <td>{{ $pinjam->buku->judul }}</td>
                        <td>{{ $pinjam->tanggalPeminjaman }}</td>
                        <td>{{ $pinjam->tanggalPengembalian }}</td>
                        <td>
                            @if($pinjam->statusPeminjaman == 'Dipinjam')
                                <span class="badge bg-warning text-dark">Dipinjam</span>
                            @else
                                <span class="badge bg-info text-dark">Menunggu di ACC</span>
                            @endif
                        </td>
                        <td>
                            @if($pinjam->statusPeminjaman == 'Dipinjam')
                                <form action="{{ route('peminjam.kembali', $pinjam->peminjamanID) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Konfirmasi Pengembalian</button>
                                </form>
                            @else
                                <button class="btn btn-secondary btn-sm" disabled>Menunggu ACC Petugas</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection