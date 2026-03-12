@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-warning">
                    <h5 class="mb-0 text-dark">Edit Kategori Buku</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('kategori.update', $kategori->kategoriID) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Nama Kategori</label>
                            <input type="text" name="namaKategori" class="form-control" value="{{ $kategori->namaKategori }}" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-warning">Perbarui Kategori</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection