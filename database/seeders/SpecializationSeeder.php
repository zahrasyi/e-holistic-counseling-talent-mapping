<?php

namespace Database\Seeders;

use App\Models\Specialization;
use App\Models\Specializations;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * table master
     */
    public function run(): void
    {
        $specializations = [
            ['name' => 'Manajemen Stres', 'description' => 'Teknik mengelola stres dan tekanan sehari-hari.'],
            ['name' => 'Kecemasan Akademik', 'description' => 'Mengatasi kecemasan terkait tugas, ujian, dan presentasi.'],
            ['name' => 'Masalah Hubungan Interpersonal', 'description' => 'Menangani konflik dan membangun hubungan yang sehat.'],
            ['name' => 'Pengembangan Karir', 'description' => 'Bimbingan dan perencanaan untuk masa depan karir setelah lulus.'],
            ['name' => 'Depresi Ringan', 'description' => 'Membantu mengatasi gejala depresi pada tahap awal.'],
        ];

        foreach ($specializations as $specialization) {
            Specialization::create($specialization);
        }
    }
}
