<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoribukuRelasi extends Model
{
    protected $table = 'kategoribuku_relasi';

    protected $primaryKey = 'kategoribukuid';

    public $timestamps = false;

    protected $fillable = [
        'bukuid', 
        'kategoriid'
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'bukuid', 'bukuid');
    }

    public function kategoribuku()
    {
        return $this->belongsTo(Kategoribuku::class, 'kategoriid', 'kategoriid');
    }
}