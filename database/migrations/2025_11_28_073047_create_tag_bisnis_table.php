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
        Schema::create('tag_bisnis', function (Blueprint $table) {
            $table->uuid('tag_bisnis_id')->primary();
            
            $table->foreignUuid('bisnis_id')
            ->constrained('bisnis', 'bisnis_id')
            ->onDelete('cascade');

            $table->enum('jenis', ['Learn', 'Workshop', 'Purchase']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tag_bisnis');
    }
};
