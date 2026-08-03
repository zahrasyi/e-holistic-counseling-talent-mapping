<x-layouts.app>

    <x-partials.breadcrumbs :items="$breadcrumbs" />

    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-500">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Resume Sesi Konseling</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">
            Oleh: <span class="font-semibold">{{ $summary->counselor->name ?? '-' }}</span><br>
            Sesi pada: <span> {{ $summary->meeting?->meeting_time?->format('d F Y, H:i') ?? '-' }}</span>
        </p>
    </div>

    <div class="px-6 py-6 space-y-6">

        {{-- Detail Appointment --}}
        <div class="bg-white dark:bg-gray-900 shadow rounded-lg border border-gray-200 dark:border-gray-700">
            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Detail Appointment</h2>
            </div>
            <x-tables.table-show :fields="$fieldsMeetings">
                <x-slot name="actions"> </x-slot>
            </x-tables.table-show>
        </div>

        {{-- Resume --}}
        <div class="bg-white dark:bg-gray-900 shadow rounded-lg border border-gray-200 dark:border-gray-700">
            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Ringkasan Konseling</h2>
            </div>
            <x-tables.table-show :fields="$fieldsSummary">
                <x-slot name="actions">
                </x-slot>
            </x-tables.table-show>
        </div>
        @role('mahasiswa')
            {{-- Jika belum ada refleksi diri --}}
            @if (empty($meeting->reflections))
                <div
                    class="mx-auto p-6 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl shadow-md transition-all duration-300">
                    <h5 class="mb-3 text-2xl font-bold tracking-tight text-gray-900 dark:text-gray-100">Refleksi Pribadi
                    </h5>
                    <p class="mb-4 text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                        Tulislah refleksi pribadi Anda dalam bentuk kalimat atau paragraf pendek untuk setiap masalah yang
                        sedang Anda alami.
                    </p>
                    <a href="{{ route('appointments.refleksiDiri', $summary->meeting->id) }}"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-600 rounded-lg transition-all focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">
                        Refleksi Diri
                        <svg class="w-4 h-4 ms-2 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>
            @else
                {{-- Jika sudah ada refleksi --}}
                <div
                    class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl shadow-md p-6 transition-all duration-300">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Refleksi Pribadi</h2>

                    {{-- TOTAL SKOR --}}
                    @php
                        $total = collect($meeting->reflection_results)->sum('score');
                        if ($total >= 26) {
                            $label = 'A. Sehat Secara Islami / Stabil';
                            $desc =
                                'Konseli memiliki kesadaran iman, ilmu, dan amal yang stabil. Hati cenderung tenang, pikiran jernih, serta mampu menghadapi masalah dengan bijak. Tugas berikutnya adalah menjaga istiqamah.';
                            $color =
                                'border-green-300 bg-green-50 text-green-800 dark:bg-green-900/30 dark:border-green-700 dark:text-green-300';
                        } elseif ($total >= 21) {
                            $label = 'B. Cenderung Rentan / Perlu Waspada';
                            $desc =
                                'Konseli cukup positif, tapi masih rentan secara emosional. Perlu pendampingan ringan agar lebih matang dan konsisten.';
                            $color =
                                'border-yellow-300 bg-yellow-50 text-yellow-800 dark:bg-yellow-900/30 dark:border-yellow-700 dark:text-yellow-300';
                        } elseif ($total >= 16) {
                            $label = 'C. Tidak Sehat Secara Islami / Perlu Intervensi';
                            $desc =
                                'Menunjukkan ketidakseimbangan antara iman, ilmu, dan amal. Perlu intervensi Islami seperti peningkatan ibadah dan dukungan sosial.';
                            $color =
                                'border-orange-300 bg-orange-50 text-orange-800 dark:bg-orange-900/30 dark:border-orange-700 dark:text-orange-300';
                        } else {
                            $label = 'D. Kritis / Perlu Penanganan Serius';
                            $desc =
                                'Kondisi rawan secara spiritual, emosional, atau sosial. Dibutuhkan pendampingan intensif dan intervensi segera.';
                            $color =
                                'border-red-300 bg-red-50 text-red-800 dark:bg-red-900/30 dark:border-red-700 dark:text-red-300';
                        }
                    @endphp

                    <div class="mt-4 border-t border-gray-200 dark:border-gray-700 pt-4 mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Total Skor Refleksi</h3>
                        <p class="text-2xl font-bold text-blue-700 dark:text-blue-400">{{ $total }} / 30</p>

                        <div class="mt-4 p-4 rounded-lg border {{ $color }}">
                            <h4 class="font-semibold text-lg mb-1">{{ $label }}</h4>
                            <p class="text-sm leading-relaxed">{{ $desc }}</p>
                        </div>
                    </div>

                    {{-- DAFTAR REFLEKSI --}}
                    <div class="space-y-6">
                        @foreach ($meeting->reflections as $i => $refleksi)
                            @php
                                $hasil = $meeting->reflection_results[$i] ?? null;
                            @endphp
                            <div
                                class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 bg-gray-50 dark:bg-gray-800 transition-all duration-300 hover:shadow-md">
                                <h3 class="text-lg font-semibold text-blue-700 dark:text-blue-400 mb-2">
                                    Refleksi {{ $i + 1 }}
                                </h3>

                                <p class="text-gray-700 dark:text-gray-300 mb-2">
                                    <span class="font-semibold text-gray-900 dark:text-gray-100">Jawaban:</span>
                                    {{ $refleksi }}
                                </p>

                                @if ($hasil)
                                    <p class="text-gray-700 dark:text-gray-300 mb-1">
                                        <span class="font-semibold">Kata Kunci:</span>
                                        {{ implode(', ', $hasil['keywords']) }}
                                    </p>
                                    <p class="text-gray-700 dark:text-gray-300">
                                        <span class="font-semibold">Kategori:</span>
                                        <span
                                            class="@if ($hasil['kategori'] === 'positif') text-green-600 dark:text-green-400 @elseif($hasil['kategori'] === 'negatif') text-red-600 dark:text-red-400 @else text-yellow-600 dark:text-yellow-400 @endif font-semibold">
                                            {{ ucfirst($hasil['kategori']) }}
                                        </span>
                                        <span class="ml-4 font-semibold">Skor:</span>
                                        <span
                                            class="text-blue-700 dark:text-blue-400 font-bold">{{ $hasil['score'] }}</span>
                                    </p>
                                @else
                                    <p class="text-gray-500 dark:text-gray-400 italic">
                                        Belum ada hasil analisis untuk refleksi ini.
                                    </p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- CAROUSEL INSPIRASI --}}
                <div id="default-carousel" class="relative w-full mt-8" data-carousel="slide">
                    <div class="relative h-56 overflow-hidden rounded-xl">
                        @foreach ([['Al-Qur’an', '“Sesungguhnya bersama kesulitan ada kemudahan.” (QS. Al-Insyirah [94]: 6)<br>“Barangsiapa bertakwa kepada Allah, niscaya Dia akan menjadikan baginya jalan keluar.” (QS. At-Talaq [65]: 2-3)'], ['Hadis', '“Mukmin yang kuat lebih baik dan lebih dicintai Allah daripada mukmin yang lemah, dan pada keduanya ada kebaikan.” (HR. Muslim, no. 2664)'], ['Pandangan Ulama', 'Imam Al-Ghazali: hati yang tenang hanya bisa dicapai dengan dzikir.<br>Ibnu Qayyim: iman, ilmu, dan amal adalah tiga pilar kesehatan jiwa.']] as $slide)
                            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                <div
                                    class="block h-56 text-center p-6 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm">
                                    <h5 class="mb-3 mt-6 text-2xl font-bold text-gray-900 dark:text-gray-100">
                                        {{ $slide[0] }}</h5>
                                    <p class="text-sm font-normal text-gray-700 dark:text-gray-300 leading-relaxed">
                                        {!! $slide[1] !!}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Indicators & Controls --}}
                    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3">
                        <button type="button" class="w-3 h-3 rounded-full bg-gray-300 dark:bg-gray-600"
                            data-carousel-slide-to="0"></button>
                        <button type="button" class="w-3 h-3 rounded-full bg-gray-300 dark:bg-gray-600"
                            data-carousel-slide-to="1"></button>
                        <button type="button" class="w-3 h-3 rounded-full bg-gray-300 dark:bg-gray-600"
                            data-carousel-slide-to="2"></button>
                    </div>

                    <button type="button"
                        class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 group focus:outline-none"
                        data-carousel-prev>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/40 dark:bg-gray-700/40 group-hover:bg-white/60 dark:group-hover:bg-gray-600/60 transition">
                            <svg class="w-4 h-4 text-gray-800 dark:text-gray-100 rtl:rotate-180"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 1 1 5l4 4" />
                            </svg>
                        </span>
                    </button>
                    <button type="button"
                        class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 group focus:outline-none"
                        data-carousel-next>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/40 dark:bg-gray-700/40 group-hover:bg-white/60 dark:group-hover:bg-gray-600/60 transition">
                            <svg class="w-4 h-4 text-gray-800 dark:text-gray-100 rtl:rotate-180"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                        </span>
                    </button>
                </div>
            @endif
        @endrole

        @role('konselor|admin')
            <div class="sm:px-6 bg-gray-50 dark:bg-gray-900/50 flex justify-end space-x-3">
                @role('konselor')
                    <a href="{{ route('appointments.riwayatCounselor') }}">
                        <button type="button"
                            class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br 
                   focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 
                   font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                            Back
                        </button>
                    </a>
                @endrole

                @role('admin')
                    <a href="{{ route('appointments.riwayat') }}">
                        <button type="button"
                            class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br 
                   focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 
                   font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                            Back
                        </button>
                    </a>
                @endrole

                {{-- Tombol Edit --}}
                <a href="{{ route('summary.edit', $meeting->id) }}">
                    <button type="button"
                        class="text-white bg-gradient-to-r from-green-500 via-green-600 to-green-700 hover:bg-gradient-to-br 
                   focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 
                   font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        Edit
                    </button>
                </a>
            </div>
        @endrole


        @role('mahasiswa')
            <div class="sm:px-6 bg-gray-50 dark:bg-gray-900/50 flex justify-end space-x-3">
                <a href="{{ route('appointments.riwayatMahasiswa') }}">
                    <button type="button"
                        class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        Back
                    </button>
                </a>
            </div>
        @endrole
    </div>

</x-layouts.app>
