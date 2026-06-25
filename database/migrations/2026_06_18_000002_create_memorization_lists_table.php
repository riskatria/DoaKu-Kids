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
        Schema::create('memorization_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('prayer_id', 50);
            $table->string('prayer_title', 255);
            $table->enum('status', ['belum_mulai', 'sedang_dihafal', 'sudah_hafal'])->default('belum_mulai');
            $table->timestamps();

            // Unique constraint to prevent duplicate entries per user
            $table->unique(['user_id', 'prayer_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memorization_lists');
    }
};
