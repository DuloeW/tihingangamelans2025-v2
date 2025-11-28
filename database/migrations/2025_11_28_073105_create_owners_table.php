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
        Schema::create('owner', function (Blueprint $table) {
            $table->uuid('owner_id')->primary();

            $table->foreignUuid('bisnis_id')
            ->constrained('bisnis', 'bisnis_id')
            ->onDelete('cascade');
            
            $table->string('nama');
            $table->string('user_name');
            $table->string('no_telephone');
            $table->string('email');
            $table->string('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owner');
    }
};
