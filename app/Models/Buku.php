<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';
    protected $primaryKey = 'bukuID';

    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahunTerbit',
    ];

    public function kategoris()
    {
        return $this->belongsToMany(KategoriBuku::class, 'kategoribuku_relasi', 'bukuID', 'kategoriID');
    }
}
