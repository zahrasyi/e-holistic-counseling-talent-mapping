<?php

namespace Database\Seeders;

use App\Models\Meeting;
use App\Models\Meetings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MeetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Meeting::create([
            'student_id' => 5,
            'counselor_id' => 2,
            'counseling_type_id' => 1,
            'meeting_time' => '2025-09-25 14:00:00',
            'status' => 'completed',
            'student_notes' => 'Saya merasa sangat stres dengan tugas akhir, butuh bantuan.',
            'approved_by' => 2,
        ]);
        Meeting::create([
            'student_id' => 6,
            'counselor_id' => 3,
            'counseling_type_id' => 2,
            'meeting_time' => now()->addDays(2),
            'status' => 'approved',
            'student_notes' => 'Butuh saran untuk manajemen waktu ujian.',
            'approved_by' => 3,
        ]);
        Meeting::create([
            'student_id' => 7,
            'counselor_id' => 4,
            'counseling_type_id' => 3,
            'meeting_time' => now()->addDays(5),
            'status' => 'pending',
            'student_notes' => 'Saya bingung memilih antara lanjut S2 atau bekerja.',
        ]);
        Meeting::create([
            'student_id' => 5,
            'counselor_id' => 3,
            'counseling_type_id' => 2,
            'meeting_time' => now()->addDays(7),
            'status' => 'reschedule_pending',
            'student_notes' => 'Konsultasi akademik rutin.',
            'approved_by' => 3,
        ]);
    }
}