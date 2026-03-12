@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h5 class="mb-0">Form Peminjaman Buku</h5>
                </div>
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <p class="text-muted mb-1">Buku yang akan dipinjam:</p>
                        <h4 class="fw-bold text-dark">{{ $buku->judul }}</h4>
                    </div>

                    <form action="{{ route('pinjam.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="bukuID" value="{{ $buku->bukuID }}">

                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal Peminjaman</label>
                            <input type="date" name="tanggalPeminjaman" id="tgl_pinjam"
                                class="form-control" 
                                value="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Tanggal Pengembalian (mnimal 1 minggu)</label>
                            <input type="date" name="tanggalPengembalian" id="tgl_kembali"
                                class="form-control @error('tanggalPengembalian') is-invalid @enderror" required>
                            @error('tanggalPengembalian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary shadow-sm py-2">
                                <i class="bi bi-check-circle me-1"></i> Konfirmasi Pinjam
                            </button>
                            <a href="{{ route('peminjam.dashboard') }}" class="btn btn-light py-2">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const tglPinjam = document.getElementById('tgl_pinjam');
    const tglKembali = document.getElementById('tgl_kembali');

    function updateBatasTanggal() {
        let pinjamDate = new Date(tglPinjam.value);
        
        let minDateStr = pinjamDate.toISOString().split('T')[0];
        tglKembali.min = minDateStr;

        let maxDate = new Date(tglPinjam.value);
        maxDate.setDate(maxDate.getDate() + 7);
        let maxDateStr = maxDate.toISOString().split('T')[0];
        
        tglKembali.max = maxDateStr;
        
        tglKembali.value = maxDateStr; 
    }
    updateBatasTanggal();
    tglPinjam.addEventListener('change', updateBatasTanggal);
</script>
@endsection
