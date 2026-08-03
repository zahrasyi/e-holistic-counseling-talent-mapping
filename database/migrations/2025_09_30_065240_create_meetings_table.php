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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->nullable()->constrained('users', 'id')->onDelete('set null');
            $table->foreignId('counselor_id')->nullable()->constrained('users', 'id')->onDelete('set null');
            $table->foreignId('counseling_type_id')->nullable()->constrained('counseling_types', 'id')->onDelete('set null');
            $table->dateTime('meeting_time')->nullable();
            $table->dateTime('counselor_proposed_time')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed', 'reschedule_pending', 'canceled', 'counselor_reschedule']);
            $table->string('topics')->nullable();
            $table->text('student_notes')->nullable();
            // $table->text('counselor_notes')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users', 'id')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};