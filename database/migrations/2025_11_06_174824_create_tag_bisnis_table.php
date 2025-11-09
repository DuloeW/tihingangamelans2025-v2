<?php

use App\Models\Bisnis;
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
            $table->id('tag_bisnis_id');
            $table->foreignIdFor(Bisnis::class, 'bisnis_id')->onDelete('cascade');
            $table->timestamps();
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
