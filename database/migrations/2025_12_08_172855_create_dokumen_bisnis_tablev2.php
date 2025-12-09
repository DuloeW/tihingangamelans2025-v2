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
        Schema::create('dokumen_bisnis', function (Blueprint $table) {
            $table->uuid('dokumen_bisnis_id')->primary();

            $table->foreignUuid('bisnis_id')
                    ->constrained('bisnis', 'bisnis_id')
                    ->onDelete('cascade');

            $table->string('nama_dokumen');
            $table->string('path');
            $table->timestamp('tanggal_dibuat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_bisnis');
    }
};
