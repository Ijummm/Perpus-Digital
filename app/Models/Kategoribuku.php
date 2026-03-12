<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriBuku extends Model
{
    protected $table = 'kategoribuku';
    protected $primaryKey = 'kategoriID';

    protected $fillable = ['namaKategori'];

    public function bukus()
    {
        return $this->belongsToMany(Buku::class, 'kategoribuku_relasi', 'kategoriID', 'bukuID');
    }
}
