<?php
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

    <x-partials.breadcrumbs :items="$breadcrumbs" />

    <x-partials.header title="Detail Kuesioner" description="Berikut hasil pengisian kuesioner." />

    <div class="w-full space-y-10 ">
        {{-- Alert Error --}}
        @if (session('error'))
        <div
            class="p-4 text-sm text-red-700 bg-red-100 border border-red-300 rounded-xl dark:bg-gray-800 dark:text-red-400 dark:border-red-700 shadow-sm">
            <strong class="font-semibold">Oops!</strong> {{ session('error') }}
        </div>
        @endif

        {{-- 🕒 Informasi Umum --}}
        <section
            class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-4 flex items-center gap-2">
                <span class="text-blue-600">🕒</span> Informasi Kuesioner
            </h2>

            <div class="space-y-3 text-gray-700 dark:text-gray-300">
                <div>
                    <span class="font-semibold">Waktu Pengisian:</span>
                    <p class="ml-2 inline">{{ $kuesioner->created_at->format('d M Y, H:i') }}</p>
                </div>
                <div>
                    <span class="font-semibold">Nama Pengisi:</span>
                    <p class="ml-2 inline">{{ $kuesioner->user->name }}</p>
                </div>
            </div>
        </section>

        {{-- 📊 Skor Akhir --}}
        <section
            class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/10 p-6 rounded-2xl shadow-lg border border-blue-200 dark:border-blue-700">
            <h2 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-5">
                📊 Skor Akhir & Rekomendasi Layanan
            </h2>

            @php
            $maxScore = min($kuesioner->scores);
            $typeMap = ['biologi' => 1, 'psikologi' => 2, 'sosial' => 3, 'spiritual' => 4];
            @endphp

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-5">
                @foreach ($kuesioner->scores as $aspek => $skor)
                @php $typeAspek = $typeMap[$aspek] ?? null; @endphp
                @php
                $result = getScoreResult($aspek, $skor, $scoreClassification);
                @endphp
                @if ($skor === $maxScore)
                <a href="{{ route('appointments.create', $typeAspek) }}"
                    class="group p-5 rounded-xl shadow-md border border-red-400 bg-red-100 dark:bg-red-800/40 hover:shadow-lg hover:scale-[1.02] transition-all duration-200">
                    <h4 class="capitalize font-semibold text-gray-800 dark:text-gray-100 mb-1">
                        {{ $aspek }}
                    </h4>
                    <p class="text-2xl font-bold text-red-600 dark:text-red-400">{{ $skor }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Klik untuk melihat rekomendasi</p>
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
                    class="p-5 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 hover:shadow-lg transition">
                    <h4 class="capitalize font-semibold text-gray-800 dark:text-gray-100 mb-1">
                        {{ $aspek }}
                    </h4>
                    <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $skor }}</p>
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

            @role('mahasiswa')
            <p class="text-center text-sm mt-5 text-gray-700 dark:text-gray-300">
                Ingin memahami diri lebih dalam?
                <a href="{{ route('questionnaire.refleksi', $kuesioner->id) }}"
                    class="font-semibold text-blue-600 dark:text-blue-400 hover:underline">
                    Isi Refleksi Diri
                </a>
            </p>
            @endrole
        </section>

        {{-- 📋 Jawaban Kuesioner --}}
        <section
            class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-gray-800 dark:text-gray-100">📋 Jawaban Kuesioner</h2>
                <a href="{{ route('questionnaire.listKuesioner') }}"
                    class="text-sm text-blue-600 dark:text-blue-400 hover:underline" target="_blank">
                    Lihat Soal Lengkap
                </a>
            </div>

            <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-5">
                @foreach ($kuesioner->answers as $namaAspek => $pertanyaan)
                <div class="p-5 rounded-xl bg-gray-50 dark:bg-gray-800 shadow-sm hover:shadow-md transition">
                    <h3 class="text-blue-600 dark:text-blue-400 font-semibold text-center mb-3 capitalize">
                        {{ $namaAspek }}
                    </h3>
                    <div
                        class="text-sm text-gray-700 dark:text-gray-300 space-y-1 max-h-60 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300 dark:scrollbar-thumb-gray-600 pr-2">
                        @foreach ($pertanyaan as $nomor => $jawaban)
                        <div class="flex justify-between">
                            <span>No.{{ $nomor }}</span>
                            <span class="font-medium text-gray-800 dark:text-gray-200">{{ $jawaban }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        {{-- 💭 Refleksi --}}
        <section class="space-y-10">
            @foreach ($refleksiSections as $section)
            <div
                class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-6 border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-all">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4 flex items-center gap-2">
                    💭 {{ $section['title'] }}
                </h2>

                <div class="space-y-5">
                    @foreach ($section['questions'] as $index => $question)
                    @php
                    $slug = $section['slug'];
                    $answer = $kuesioner->reflections[$slug][$index + 1] ?? null;
                    @endphp

                    <div class="border-l-4 border-blue-500 bg-gray-50 dark:bg-gray-900 rounded-md p-4">
                        <p class="font-medium text-gray-800 dark:text-gray-200">{{ $question }}</p>
                        @if ($answer)
                        <p class="mt-2 text-gray-700 dark:text-gray-300">
                            <span class="font-semibold text-blue-600 dark:text-blue-400">Refleksi:</span>
                            {{ $answer }}
                        </p>
                        @else
                        <p class="mt-2 italic text-gray-400 dark:text-gray-500">Belum ada refleksi</p>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </section>
    </div>

</x-layouts.app>