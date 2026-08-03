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
        Schema::create('session_summaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meeting_id')->unique()->constrained('meetings', 'id')->cascadeOnDelete();
            $table->foreignId('counselor_id')->nullable()->constrained('users', 'id')->onDelete('set null');
            $table->foreignId('student_id')->nullable()->constrained('users', 'id')->onDelete('set null');
            $table->text('summary');
            $table->text('recommendations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_summaries');
    }
};
