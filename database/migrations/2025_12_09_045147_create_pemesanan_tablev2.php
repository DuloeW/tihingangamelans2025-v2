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
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->uuid('pemesanan_id')->primary();

            $table->foreignUuid('pengguna_id')
                    ->constrained('pengguna', 'pengguna_id')
                    ->cascadeOnDelete();
    
            $table->foreignUuid('katalog_id')
                ->constrained('katalogs', 'katalog_id')
                ->cascadeOnDelete();

            $table->char('jadwal_id', 36)->nullable();
            $table->foreign('jadwal_id')
                ->references('jadwal_id')
                ->on('jadwal')
                ->nullOnDelete();

            $table->date('tgl_mulai_booking')->nullable();
            $table->date('tgl_selesai_booking')->nullable();

            $table->dateTime('tanggal_pemesanan');
            $table->enum('status', [
                'unpaid',       // Menunggu Pembayaran
                'paid',         // Lunas / Terkonfirmasi (Tiket Workshop Aman)
                'processing',   // Sedang Diproses (Khusus Gamelan: Packing/Pembuatan)
                'shipped',      // Sedang Dikirim (Khusus Gamelan)
                'completed',    // Selesai (Barang diterima / Workshop selesai dihadiri)
                'cancelled',    // Dibatalkan (Oleh user atau admin)
                'failed'        // Pembayaran Gagal (Opsional, jika pakai Payment Gateway)
            ])->default('unpaid');

            $table->double('total_harga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};
