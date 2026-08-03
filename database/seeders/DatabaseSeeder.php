<?php

namespace Database\Seeders;

use App\Models\RescheduleRequests;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            RolesAndPermissionsSeeder::class,
            SpecializationSeeder::class,
            CounselingTypeSeeder::class,
            UserSeeder::class,
            MeetingSeeder::class,
            RescheduleRequestSeeder::class,
        ]);
    }
}
