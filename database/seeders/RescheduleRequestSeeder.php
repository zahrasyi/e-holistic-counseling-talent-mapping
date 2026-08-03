<?php

namespace Database\Seeders;

use App\Models\RescheduleRequests;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RescheduleRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // RescheduleRequests::create([
        //     'meeting_id' => 4, // ID dari meeting yang statusnya reschedule_pending
        //     'requester_id' => 5,
        //     'new_meeting_time' => now()->addDays(9),
        //     'reason' => 'Mohon maaf, ternyata ada jadwal ujian mendadak di jam yang sama.',
        //     'status' => 'pending',
        // ]);
    }
}
