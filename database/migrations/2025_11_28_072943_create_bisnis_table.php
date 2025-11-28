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
        Schema::create('bisnis', function (Blueprint $table) {
            $table->uuid('bisnis_id')->primary();

            $table->foreignUuid('admin_id')
            ->constrained('admin', 'admin_id')
            ->onDelete('cascade');

            $table->string('nama');
            $table->text('deskripsi');
            $table->string('gambar');
            $table->string('email');
            $table->enum('status', ['active', 'inactive', 'verified', 'unverified'])->default('inactive');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bisnis');
    }
};
