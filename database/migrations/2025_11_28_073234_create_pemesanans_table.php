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
            ->onDelete('cascade');
            $table->foreignUuid('jadwal_id')
            ->constrained('jadwal', 'jadwal_id')
            ->onDelete('cascade');

            $table->dateTime('tanggal_pemesanan');
            $table->enum('status', ['Pending', 'Lunnas', 'Batal', 'Selesai']);
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
