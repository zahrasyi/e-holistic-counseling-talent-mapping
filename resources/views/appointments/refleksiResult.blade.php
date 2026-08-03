<x-layouts.app>
    <x-partials.header title="Hasil Refleksi Pribadi" description="Berikut hasil refleksi pribadi Anda." />

    <div class="max-w-5xl mx-auto mt-8 space-y-8">

        {{-- ALERT ERROR --}}
        @if (session('error'))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            {{ session('error') }}
        </div>
        @endif

        {{-- ALERT SUCCES --}}
        @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            {{ session('success') }}
        </div>
        @endif
        {{-- KONTEN REFLEKSI --}}
        <div class="bg-white shadow-md rounded-xl p-6 border border-gray-200">
            <h2 class="text-2xl font-semibold text-gray-800 mb-3">Refleksi Pribadi</h2>
            {{-- TOTAL SKOR --}}
            @php
            $total = collect($reflectionResults)->sum('score');
            if ($total >= 26) {
            $label = 'A. Sehat Secara Islami / Stabil';
            $desc = 'Konseli memiliki kesadaran iman, ilmu, dan amal yang stabil. Hati cenderung tenang, pikiran jernih,
            serta mampu menghadapi masalah dengan bijak. Tugas berikutnya adalah menjaga istiqamah.';
            $color = 'text-green-700 bg-green-50 border-green-300';
            } elseif ($total >= 21) {
            $label = 'B. Cenderung Rentan / Perlu Waspada';
            $desc = 'Konseli sudah cukup positif dalam menghadapi masalah, namun masih ada celah yang bisa menggoyahkan
            iman atau emosi. Dibutuhkan pendampingan ringan agar semakin matang dan konsisten.';
            $color = 'text-yellow-700 bg-yellow-50 border-yellow-300';
            } elseif ($total >= 16) {
            $label = 'C. Tidak Sehat Secara Islami / Perlu Intervensi';
            $desc = 'Konseli menunjukkan tanda-tanda kurang seimbang antara iman, ilmu, dan amal. Perlu intervensi
            konseling Islami seperti peningkatan ibadah, manajemen emosi Islami, dan dukungan sosial.';
            $color = 'text-orange-700 bg-orange-50 border-orange-300';
            } else {
            $label = 'D. Kritis / Perlu Penanganan Serius';
            $desc = 'Konseli berada pada titik rawan dengan dominasi refleksi negatif. Kondisi ini berisiko menimbulkan
            krisis spiritual, emosional, atau sosial. Dibutuhkan penanganan serius melalui konseling intensif,
            pendampingan ruhani, dan intervensi segera.';
            $color = 'text-red-700 bg-red-50 border-red-300';
            }
            @endphp

            <div class="mt-4 border-t pt-2 mb-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Total Skor Refleksi</h3>
                <p class="text-2xl font-bold text-blue-700">{{ $total }} / 30</p>

                <div class="mt-4 p-4 rounded-lg border {{ $color }}">
                    <h4 class="font-semibold text-lg mb-1">{{ $label }}</h4>
                    <p class="text-sm leading-relaxed">{{ $desc }}</p>
                </div>
            </div>
            <div id="default-carousel" class="relative w-full" data-carousel="slide">
                <!-- Carousel wrapper -->
                <div class="relative h-56 overflow-hidden rounded-lg">
                    <!-- Item 1 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <div
                            class="block h-56 text-center p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                            <h5 class="mb-2 mt-8 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">1.
                                Al-Qur’an
                            </h5>
                            <p class="font-normal text-gray-700 dark:text-gray-400">“Sesungguhnya bersama kesulitan ada
                                kemudahan.” (QS. Al-Insyirah [94]: 6)
                                “Barangsiapa bertakwa kepada Allah, niscaya Dia akan menjadikan baginya jalan keluar,
                                dan
                                memberi rezeki dari arah yang tiada disangka-sangka.” (QS. At-Talaq [65]: 2-3).</p>
                        </div>
                    </div>
                    <!-- Item 2 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <div
                            class="block h-56 text-center p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                            <h5 class="mb-2 mt-8 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">2.
                                Hadis
                            </h5>
                            <p class="font-normal text-gray-700 dark:text-gray-400">“Mukmin yang kuat lebih baik dan
                                lebih
                                dicintai Allah daripada mukmin yang lemah, dan pada keduanya ada kebaikan.” (HR. Muslim,
                                no.
                                2664).</p>
                        </div>
                    </div>
                    <!-- Item 3 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <div
                            class="block h-56 text-center p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                            <h5 class="mb-2 mt-8 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">3.
                                Pandangan
                                Ulama</h5>
                            <p class="font-normal text-gray-700 dark:text-gray-400">Imam Al-Ghazali: hati yang tenang
                                hanya
                                bisa dicapai dengan dzikir.
                                Ibnu Qayyim: iman, ilmu, dan amal adalah tiga pilar kesehatan jiwa.</p>
                        </div>
                    </div>
                </div>
                <!-- Slider indicators -->
                <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1"
                        data-carousel-slide-to="0"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2"
                        data-carousel-slide-to="1"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3"
                        data-carousel-slide-to="2"></button>
                </div>
                <!-- Slider controls -->
                <button type="button"
                    class="absolute top-0 inset-s-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                    data-carousel-prev>
                    <span
                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 1 1 5l4 4" />
                        </svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
                <button type="button"
                    class="absolute top-0 inset-e-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                    data-carousel-next>
                    <span
                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
            </div>
            <br>
            <div class="space-y-6">
                @foreach ($refleksis as $i => $refleksi)
                @php
                $hasil = $reflectionResults[$i] ?? null;
                @endphp

                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                    <h3 class="text-lg font-semibold text-blue-700 mb-2">Refleksi {{ $i }}</h3>

                    {{-- Jawaban Asli --}}
                    <p class="text-gray-700 mb-2">
                        <span class="font-semibold text-gray-800">Jawaban:</span>
                        {{ $refleksi }}
                    </p>

                    @if ($hasil)
                    {{-- Kata Kunci --}}
                    <p class="text-gray-700 mb-1">
                        <span class="font-semibold text-gray-800">Kata Kunci:</span>
                        {{ implode(', ', $hasil['keywords']) }}
                    </p>

                    {{-- Kategori & Skor --}}
                    <p class="text-gray-700">
                        <span class="font-semibold text-gray-800">Kategori:</span>
                        <span
                            class="@if($hasil['kategori'] === 'positif') @elseif($hasil['kategori'] === 'negatif') text-red-600 @else @endif font-semibold">
                            {{ ucfirst($hasil['kategori']) }}
                        </span>
                        <span class="ml-4 font-semibold">Skor:</span>
                        <span class="text-blue-700 font-bold">{{ $hasil['score'] }}</span>
                    </p>
                    @else
                    <p class="text-gray-500 italic">Belum ada hasil analisis untuk refleksi ini.</p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layouts.app>