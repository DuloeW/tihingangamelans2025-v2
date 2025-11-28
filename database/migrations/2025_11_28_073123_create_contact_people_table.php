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
        Schema::create('contact_person', function (Blueprint $table) {
            $table->uuid('contact_person_id')->primary();
            $table->foreignUuid('bisnis_id')
            ->constrained('bisnis', 'bisnis_id')
            ->onDelete('cascade');
            $table->string('nama');
            $table->string('no_telephone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_person');
    }
};
