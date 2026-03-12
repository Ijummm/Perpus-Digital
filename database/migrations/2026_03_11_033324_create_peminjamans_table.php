<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id('peminjamanID');
            $table->foreignId('userID')->constrained('user', 'userID')->onDelete('cascade');
            $table->foreignId('bukuID')->constrained('buku', 'bukuID')->onDelete('cascade');
            $table->date('tanggalPeminjaman');
            $table->date('tanggalPengembalian')->nullable();
            $table->string('statusPeminjaman', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};
