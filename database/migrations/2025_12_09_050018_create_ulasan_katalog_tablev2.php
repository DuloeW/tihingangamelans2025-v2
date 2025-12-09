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
        Schema::create('ulasan_katalog', function (Blueprint $table) {
            $table->uuid('ulasan_katalog_id')->primary();

            $table->foreignUuid('pengguna_id')
                    ->constrained('pengguna', 'pengguna_id')
                    ->onDelete('cascade');
            $table->foreignUuid('katalog_id')
                    ->constrained('katalogs', 'katalog_id')
                    ->onDelete('cascade');

            $table->string('isi_ulasan');
            $table->tinyInteger('rating');
            $table->string('nama_pengulas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulasan_katalog');
    }
};
