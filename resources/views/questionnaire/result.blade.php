<?php
    // --- 1️⃣ Cari aspek dengan skor tertinggi ---
    $maxScore = min($kuesioner->scores);

    // Ambil semua aspek yang punya skor tertinggi
    $topAspects = collect($kuesioner->scores)
        ->filter(fn($score) => $score === $maxScore)
        ->keys();

    // --- 2️⃣ Data khusus untuk setiap aspek ---
    $aspekData = [
        'psikologi' => [
            'name' => 'Layanan Psikologi',
            'image' => './img/psikolog.png',
            'desc' => 'Konsultasi dengan ahli psikologi untuk membantu menjaga keseimbangan emosi, mental, dan spiritual Anda.',
        ],
        'sosial' => [
            'name' => 'Layanan Sosial',
            'image' => './img/sosial.png',
            'desc' => 'Bantu kembangkan kemampuan sosial dan komunikasi Anda dalam lingkungan sekitar.',
        ],
        'biologi' => [
            'name' => 'Layanan Biologi',
            'image' => './img/bio.png',
            'desc' => 'Fokus pada aspek kesehatan fisik dan biologis untuk meningkatkan kualitas hidup secara islami.',
        ],
        'spiritual' => [
            'name' => 'Layanan Spiritual',
            'image' => './img/spirit.png',
            'desc' => 'Pendampingan spiritual untuk memperkuat hubungan dengan Allah dan menenangkan hati.',
        ],
    ];
    // Peta jenis aspek ke tipe (biar lebih bersih)
    $typeMap = [
                'biologi' => 1,
                'psikologi' => 2,
                'sosial' => 3,
                'spiritual' => 4,
                ];

    $scoreClassification = [
        'biologi' => [
            [
                'min' => 0.75,
                'max' => 1,
                'label' => 'Sangat Sehat Fisik Islami',
                'desc' => 'Anda menjaga tubuh dengan penuh tanggung jawab ruhiyah dan akhlak Islami.',
            ],
            [
                'min' => 0.50,
                'max' => 0.74,
                'label' => 'Cukup Sehat',
                'desc' => 'Anda memiliki kebiasaan sehat. Tingkatkan kualitas hidup dengan pendekatan Islami.',
            ],
            [
                'min' => 0.25,
                'max' => 0.49,
                'label' => 'Perlu Perbaikan',
                'desc' => 'Perlu meningkatkan kesadaran bahwa tubuh adalah amanah dan modal utama beribadah.',
            ],
            [
                'min' => 0,
                'max' => 0.24,
                'label' => 'Kurang Sehat Fisik',
                'desc' => 'Diperlukan evaluasi serius atas gaya hidup. Konsultasi dan niat taubat sangat dianjurkan.',
            ],
        ],

        'psikologi' => [
            [
                'min' => 0.75,
                'max' => 1,
                'label' => 'Sangat Stabil & Sehat Jiwa',
                'desc' => 'Jiwa Anda kuat, tenang, dan kokoh dengan nilai-nilai Islam. Pertahankan & syukuri.',
            ],
            [
                'min' => 0.50,
                'max' => 0.74,
                'label' => 'Sehat Jiwa',
                'desc' => 'Kondisi psikologis cukup baik. Terus jaga dan isi dengan ruhiyah dan muhasabah.',
            ],
            [
                'min' => 0.25,
                'max' => 0.49,
                'label' => 'Perlu Keseimbangan Emosi',
                'desc' => 'Perlu latihan kesabaran, keikhlasan, dan peningkatan spiritual.',
            ],
            [
                'min' => 0,
                'max' => 0.24,
                'label' => 'Kondisi Jiwa Rentan',
                'desc' => 'Perlu perhatian serius, konsultasi, dan penguatan ruhiyah secara berkelanjutan.',
            ],
        ],

        'sosial' => [
            [
                'min' => 0.75,
                'max' => 1,
                'label' => 'Sangat Sehat Sosial',
                'desc' => 'Hubungan sosial Anda sangat baik dan mencerminkan akhlak Islami yang matang.',
            ],
            [
                'min' => 0.50,
                'max' => 0.74,
                'label' => 'Sehat Sosial',
                'desc' => 'Anda cukup aktif dan positif dalam kehidupan sosial. Pertahankan dan tingkatkan.',
            ],
            [
                'min' => 0.25,
                'max' => 0.49,
                'label' => 'Cukup Sehat',
                'desc' => 'Diperlukan peningkatan komunikasi, kepedulian, dan kepekaan sosial.',
            ],
            [
                'min' => 0,
                'max' => 0.24,
                'label' => 'Kurang Sehat Sosial',
                'desc' => 'Perlu refleksi mendalam dan bimbingan untuk memperbaiki kualitas hubungan sosial.',
            ],
        ],
        'spiritual' => [
            [
                'min' => 0.75,
                'max' => 1,
                'label' => 'Sangat Sehat Ruhaniyah',
                'desc' => 'Hati Anda hidup dengan zikir, ibadah, dan kedekatan yang kokoh pada Allah.',
            ],
            [
                'min' => 0.50,
                'max' => 0.74,
                'label' => 'Sehat Spiritual',
                'desc' => 'Anda cukup stabil secara ruhiyah. Jaga dan tingkatkan dengan amal sunnah.',
            ],
            [
                'min' => 0.25,
                'max' => 0.49,
                'label' => 'Perlu Penguatan',
                'desc' => 'Hubungan spiritual Anda fluktuatif. Perbanyak muhasabah dan ibadah hati.',
            ],
            [
                'min' => 0,
                'max' => 0.24,
                'label' => 'Lemah Spiritual',
                'desc' => 'Diperlukan perbaikan serius melalui taubat, pembimbing ruhani, dan dzikir.',
            ],
        ]

    // nanti tinggal tambah sosial & spiritual
    ];

    function getScoreResult($aspek, $score, $scoreClassification)
    {
        if (!isset($scoreClassification[$aspek])) {
            return null;
        }

        foreach ($scoreClassification[$aspek] as $range) {
            if ($score >= $range['min'] && $score <= $range['max']) {
                return $range;
            }
        }

        return null;
    }

?>

<x-layouts.app>
    <div class="max-w-6xl mx-auto mt-2 space-y-8">
        {{-- --}}
        @php
        $count = $topAspects->count();
        // Tentukan jumlah kolom grid
        $gridCols = match(true) {
        $count === 1 => 'grid-cols-1',
        $count === 2 => 'grid-cols-2',
        $count >= 3 => 'grid-cols-3',
        default => 'grid-cols-1',
        };
        @endphp

        {{-- Skor Akhir --}}
        <div class="bg-blue-50 dark:bg-blue-900/30 p-5 rounded-2xl shadow mt-4">
            <h2 class="text-lg font-semibold mb-4">Skor Akhir (Rekomendasi Layanan Berdasarkan Hasil Kuesioner)</h2>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-center">
                @php
                $maxScore = min($kuesioner->scores);
                @endphp
                @foreach ($kuesioner->scores as $aspek => $skor)
                @php
                $typeAspek = $typeMap[$aspek] ?? null;
                $result = getScoreResult($aspek, $skor, $scoreClassification);
                @endphp
                @if ($skor === $maxScore)
                <a href="{{ route('appointments.create', $typeAspek) }}"
                    class="cursor-pointer hover:opacity-85 p-4 rounded-xl shadow-sm border bg-red-100 dark:bg-red-800 border-red-400">
                    <h4 class="capitalize font-semibold mb-1 text-gray-700 dark:text-gray-200">{{ $aspek }}</h4>
                    <p class="text-xl font-bold text-blue-600 dark:text-blue-400">{{ $skor }}</p>
                    @if ($result)
                    <p class="text-xs mt-2 px-2 py-1 rounded-lg bg-blue-600 text-white font-semibold">
                        {{ $result['label'] }}
                    </p>
                    <p class="text-xs mt-1 text-gray-700 dark:text-gray-200">
                        {{ $result['desc'] }}
                    </p>
                    @endif
                </a>
                @else
                <div
                    class="p-4 rounded-xl shadow-sm border bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700">
                    <h4 class="capitalize font-semibold mb-1 text-gray-700 dark:text-gray-200">{{ $aspek }}</h4>
                    <p class="text-xl font-bold text-blue-600 dark:text-blue-400">{{ $skor }}</p>
                    @if ($result)
                    <p class="text-xs mt-2 px-2 py-1 rounded-lg bg-blue-600 text-white font-semibold">
                        {{ $result['label'] }}
                    </p>
                    <p class="text-xs mt-1 text-gray-700 dark:text-gray-200">
                        {{ $result['desc'] }}
                    </p>
                    @endif
                </div>
                @endif
                @endforeach
            </div>
            <p class="mx-auto text-center text-sm mt-3">Jika anda ingin lebih merefleksikan diri anda lebih dalam, anda
                dapat
                mengisi <a href="{{ route('questionnaire.refleksi', $kuesionerId) }}"
                    class="font-semibold text-blue-600 dark:text-blue-400 hover:text-blue-500">Refleksi
                    Diri</a> yang
                sudah kami
                sediakan.</p>
        </div>
        {{-- 💡 3️⃣ Rekomendasi Layanan Berdasarkan Skor Tertinggi --}}
        @if ($topAspects->isNotEmpty())
        <div class="m-1">
            <h2 class="text-lg font-semibold mb-6 text-center">🌟 Rekomendasi Layanan Berdasarkan Hasil Kuesioner</h2>
            <div class="grid {{ $gridCols }} gap-6 justify-center">
                @foreach ($topAspects as $aspek)
                @php
                $data = $aspekData[$aspek] ?? [
                'name' => ucfirst($aspek),
                'image' => 'https://picsum.photos/seed/'.$aspek.'/300/200',
                'desc' => 'Layanan untuk mendukung aspek '.ucfirst($aspek).' Anda.',
                ];
                @endphp
                @php
                $idType = $typeMap[$aspek] ?? null;
                @endphp
                <div
                    class="max-w-sm mx-auto bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700
                       transform transition duration-300 ease-in-out hover:shadow-lg hover:-translate-y-1 hover:scale-105">
                    <a href="{{ route('appointments.create', $idType) }}">
                        <img class="rounded-t-lg w-full h-48 object-cover transition duration-300 ease-in-out hover:opacity-90"
                            src="{{ $data['image'] }}" alt="{{ $data['name'] }}" />
                    </a>
                    <div class="p-5">
                        <a href="{{ route('appointments.create', $idType) }}">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $data['name'] }}
                            </h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                            {{ $data['desc'] }}
                        </p>
                        <a href="{{ route('appointments.create', $idType) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white
                              bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none
                              focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800
                              transition duration-300 ease-in-out">
                            Daftar Sekarang
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</x-layouts.app>