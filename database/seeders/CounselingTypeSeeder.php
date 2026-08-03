<?php

namespace Database\Seeders;

use App\Models\CounselingType;
use App\Models\CounselingTypes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CounselingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * ini table master
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Biological Factors', 'description' => 'Covers the physical aspects of an individual, such as genetics, organ function, and other health conditions.'],
            ['name' => 'Psychological Factors', 'description' => "Covers aspects of an individual's emotions, thoughts, and behavior, such as stress, motivation, and coping."],
            ['name' => 'Social Factors', 'description' => "Includes aspects of an individual's social environment, such as family, friends, culture, and economic conditions."],
            ['name' => 'Spiritual Factors', 'description' => "Covers aspects of belief, worship, and an individual's relationship with God. Including peace of mind through prayer, the strength of faith in facing trials, as well as gratitude and trust that shape daily behavior."],
        ];

        foreach ($types as $type) {
            CounselingType::create($type);
        }
    }
}