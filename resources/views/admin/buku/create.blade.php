@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Tambah Koleksi Buku Baru</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('buku.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Judul Buku</label>
                            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Penulis</label>
                                <input type="text" name="penulis" class="form-control" value="{{ old('penulis') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Penerbit</label>
                                <input type="text" name="penerbit" class="form-control" value="{{ old('penerbit') }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tahun Terbit</label>
                            <input type="number" name="tahunTerbit" class="form-control" value="{{ old('tahunTerbit') }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label d-block">Kategori Buku</label>
                            <div class="card p-3 bg-light">
                                <div class="row">
                                    @foreach($kategoris as $kategori)
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="kategoriID[]" value="{{ $kategori->kategoriID }}" id="kat{{ $kategori->kategoriID }}">
                                            <label class="form-check-label" for="kat{{ $kategori->kategoriID }}">
                                                {{ $kategori->namaKategori }}
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <small class="text-muted text-italic">*Pilih minimal satu kategori</small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('buku.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary px-4">Simpan Buku</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection