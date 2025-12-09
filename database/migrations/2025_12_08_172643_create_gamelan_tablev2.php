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
        Schema::create('gamelan', function (Blueprint $table) {
           $table->uuid('gamelan_id')->primary();

            $table->foreignUuid('admin_id')
                    ->constrained('admin', 'admin_id')
                    ->onDelete('cascade');

            $table->string('nama');
            $table->text('deskripsi');
            $table->string('gambar');
            $table->string('audio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gamelan');
    }
};
