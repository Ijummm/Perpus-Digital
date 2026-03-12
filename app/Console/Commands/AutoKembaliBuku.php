<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Peminjaman;
use Carbon\Carbon;

class AutoKembaliBuku extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'buku:autokembali';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengubah status peminjaman menjadi Selesai jika sudah melewati batas tanggal kembali';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $peminjaman = Peminjaman::where('statusPeminjaman', 'Dipinjam')
            ->where('tanggalPengembalian', '<', Carbon::today())
            ->update([
                'statusPeminjaman' => 'Selesai'
            ]);

        $this->info("Berhasil mengupdate $peminjaman data peminjaman.");
    }
}
