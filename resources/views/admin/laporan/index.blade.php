@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-print-none mb-4">
        <h4>Filter Laporan Peminjaman</h4>
        <form action="{{ route('laporan.index') }}" method="GET" class="row g-3 bg-light p-3 rounded shadow-sm">
            <div class="col-md-4">
                <label class="form-label small fw-bold">Tanggal Mulai</label>
                <input type="date" name="tgl_mulai" class="form-control" value="{{ request('tgl_mulai') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-bold">Tanggal Selesai</label>
                <input type="date" name="tgl_selesai" class="form-control" value="{{ request('tgl_selesai') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">Status</label>
                <select name="status" class="form-control">
                    <option value="">Semua Status</option>
                    <option value="Dipinjam" {{ request('status') == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                    <option value="Menunggu Verifikasi" {{ request('status') == 'Menunggu Verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                    <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">Filter</button>
                <a href="{{ route('laporan.index') }}" class="btn btn-secondary me-2">Reset</a>
                <button type="button" onclick="window.print()" class="btn btn-success">Cetak</button>
            </div>
        </form>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="d-none d-print-block text-center mb-4">
                <h2>LAPORAN PERPUSTAKAAN DIGITAL</h2>
                @if(request('tgl_mulai') && request('tgl_selesai'))
                <p>Periode: {{ request('tgl_mulai') }} s/d {{ request('tgl_selesai') }}</p>
                @else
                <p>Semua Riwayat Peminjaman</p>
                @endif
                <hr>
            </div>

            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th width="50">No</th>
                        <th>Peminjam</th>
                        <th>Buku</th>
                        <th width="120">Tgl Pinjam</th>
                        <th width="120">Tgl Kembali</th>
                        <th width="160">Status</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporans as $laporan)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $laporan->user->namaLengkap }}</td>
                        <td>{{ $laporan->buku->judul }}</td>
                        <td class="text-center">{{ $laporan->tanggalPeminjaman }}</td>
                        <td class="text-center">{{ $laporan->tanggalPengembalian }}</td>

                        <td class="text-center">
                            @if($laporan->statusPeminjaman == 'Menunggu di ACC')
                            <span class="badge bg-warning text-dark">Menunggu ACC</span>
                            @elseif($laporan->statusPeminjaman == 'Dipinjam')
                            <span class="badge bg-primary">Dipinjam</span>
                            @else
                            <span class="badge bg-success">Selesai</span>
                            @endif
                        </td>

                        <td class="text-center">
                            @if($laporan->statusPeminjaman == 'Menunggu di ACC')

                            <div class="d-flex justify-content-center gap-2">

                                <form action="{{ route('admin.acc_kembali', $laporan->peminjamanID) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-success btn-sm">
                                        ACC
                                    </button>
                                </form>

                                <form action="{{ route('admin.tolak_kembali', $laporan->peminjamanID) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Tolak pengembalian ini?')">
                                        Tolak
                                    </button>
                                </form>

                            </div>

                            @elseif($laporan->statusPeminjaman == 'Dipinjam')
                            <span class="badge bg-warning text-dark">Sedang Dipinjam</span>

                            @else
                            <span class="badge bg-success">Selesai</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            Data tidak ditemukan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection