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
        Schema::create('course_contents', function (Blueprint $table) {
            $table->id();

            // Foreign key ke tabel course.
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');

            // Foreign key ke tabel content.
            $table->foreignId('content_id')->constrained('content')->onDelete('cascade');

            $table->integer('order'); 

            $table->timestamps();   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_contents');
    }
};
