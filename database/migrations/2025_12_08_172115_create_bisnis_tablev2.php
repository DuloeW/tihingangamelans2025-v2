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

            $table->char('admin_id', 36)->nullable();

            $table->foreign('admin_id')
                    ->references('admin_id')
                    ->on('admin')
                    ->nullOnDelete();
            
            $table->foreignUuid('owner_id')
                    ->constrained('owner', 'owner_id')
                    ->onDelete('cascade');
            
            $table->string('nama');
            $table->string('slug')->unique();

            $table->text('deskripsi');
            $table->string('gambar');
            $table->string('email');
            $table->enum('status', ['verified', 'unverified'])->default('unverified');
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
