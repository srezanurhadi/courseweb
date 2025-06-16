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
        Schema::create('uploaded_images', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('path')->unique();
            $table->string('url');

            // ✨ BARU: Kolom untuk hubungan polimorfik
            $table->nullableMorphs('imageable'); // ✨ Gunakan ini// Ini akan membuat `imageable_id` (BIGINT) dan `imageable_type` (VARCHAR)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uploaded_images');
    }
};
