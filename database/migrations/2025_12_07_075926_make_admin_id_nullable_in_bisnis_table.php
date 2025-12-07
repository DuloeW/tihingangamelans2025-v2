<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bisnis', function (Blueprint $table) {
            // 1. Hapus kunci relasi (Foreign Key) dulu agar tidak error saat diubah
            // Format default nama index laravel: namaTabel_namaKolom_foreign
            $table->dropForeign(['admin_id']); 

            // 2. Ubah kolom admin_id menjadi NULLABLE
            // Kita gunakan tipe data char(36) karena Anda pakai UUID
            $table->char('admin_id', 36)->nullable()->change();

            // 3. Pasang kembali relasinya
            // nullOnDelete() artinya jika admin dihapus, kolom ini jadi NULL (bukan ikut terhapus)
            $table->foreign('admin_id')->references('admin_id')->on('admin')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('bisnis', function (Blueprint $table) {
            // Kembalikan seperti semula jika di-rollback (Wajib diisi / NOT NULL)
            $table->dropForeign(['admin_id']);
            $table->char('admin_id', 36)->nullable(false)->change();
            $table->foreign('admin_id')->references('admin_id')->on('admin')->cascadeOnDelete();
        });
    }
};
