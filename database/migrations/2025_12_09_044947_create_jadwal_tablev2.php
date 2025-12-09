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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->uuid('jadwal_id')->primary();
    
            $table->foreignUuid('katalog_id')
                ->constrained('katalogs', 'katalog_id')
                ->cascadeOnDelete(); 

            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_selesai');
    
            $table->integer('kuota')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
