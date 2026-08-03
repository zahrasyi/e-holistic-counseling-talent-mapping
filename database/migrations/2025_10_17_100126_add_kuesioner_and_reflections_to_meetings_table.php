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
        Schema::table('meetings', function (Blueprint $table) {
            $table->foreignId('kuesioner_id')->nullable()->constrained('questionnaires', 'id')->onDelete('set null')->after('student_notes');
            $table->json('reflections')->nullable()->after('kuesioner_id');
            $table->json('reflection_results')->nullable()->after('reflections');
            $table->integer('total_score_reflection')->nullable()->after('reflection_results');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('meetings', function (Blueprint $table) {
            $table->dropColumn('kuesioner_id');
            $table->dropColumn('reflections');
            $table->dropColumn('reflection_results');
            $table->dropColumn('total_score_reflection');
        });
    }
};