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
        Schema::create('katalogs', function (Blueprint $table) {
             $table->uuid('katalog_id')->primary();

            $table->foreignUuid('bisnis_id')
                    ->constrained('bisnis', 'bisnis_id')
                    ->onDelete('cascade');

            $table->string('nama');
            $table->text('deskripsi');
            $table->double('harga');
            $table->string('gambar');
            $table->enum('jenis', ['Workshop', 'Kelas', 'Gamelan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('katalogs');
    }
};
