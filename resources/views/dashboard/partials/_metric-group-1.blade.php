<!-- Metric Item Start -->
@role('admin|super admin')
    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 dark:bg-blue-900/50">
            <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
        </div>

        <div class="mt-5 flex items-end justify-between">
            <div>
                <span class="text-sm text-gray-500 dark:text-gray-400">Patient</span>
                <h4 class="mt-2 text-4xl font-bold text-gray-800 dark:text-white/90">
                    {{ number_format($totalPasien) }}
                </h4>
            </div>

            {{-- Logika untuk menampilkan persentase pertumbuhan --}}
            {{-- Logika untuk menampilkan persentase pertumbuhan --}}
            <span
                class="flex items-center gap-1 rounded-full py-0.5 pl-2 pr-2.5 text-sm font-medium
            @if ($presentasePasienTumbuh > 0) bg-green-100 text-green-700 dark:bg-green-500/15 dark:text-green-400
            @elseif ($presentasePasienTumbuh < 0)
                bg-red-100 text-red-700 dark:bg-red-500/15 dark:text-red-400
            @else
                bg-gray-100 text-gray-700 dark:bg-gray-500/15 dark:text-gray-400 @endif
        ">
                @if ($presentasePasienTumbuh > 0)
                    {{-- SVG PANAH NAIK --}}
                    <svg class="fill-current" width="12" height="12" viewBox="0 0 12 12" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 2.5L10.5 7L1.5 7L6 2.5Z" fill="currentColor" />
                    </svg>
                @elseif ($presentasePasienTumbuh < 0)
                    {{-- SVG PANAH TURUN --}}
                    <svg class="fill-current" width="12" height="12" viewBox="0 0 12 12" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 9.5L1.5 5L10.5 5L6 9.5Z" fill="currentColor" />
                    </svg>
                @else
                    {{-- SVG GARIS DATAR (0%) --}}
                    <svg class="fill-current" width="12" height="12" viewBox="0 0 12 12" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 6h8" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                @endif

                {{-- Tampilkan nilai absolut dari persentase --}}
                {{ number_format(abs($presentasePasienTumbuh), 2) }}%
            </span>

        </div>
    </div>
@endrole

<!-- Metric Item Start -->
@role('konselor')
    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-100 dark:bg-orange-900/50">
            <svg class="w-6 h-6 text-orange-600 dark:text-orange-300" fill="none" stroke="currentColor"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>

        <div class="mt-5 flex items-end justify-between">
            <div>
                <span class="text-sm text-gray-500 dark:text-gray-400">Pending Appointment</span>
                <h4 class="mt-2 text-4xl font-bold text-gray-800 dark:text-white/90">
                    {{ $newRequestsCount }}
                </h4>
            </div>
        </div>
    </div>
@endrole

@role('mahasiswa')
    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 dark:bg-blue-900/50">
            <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
        </div>
        <div class="mt-5">
            <span class="text-sm text-gray-500 dark:text-gray-400">Janji Temu Akan Datang</span>
            <h4 class="mt-2 text-4xl font-bold text-gray-800 dark:text-white/90">
                {{ $upcomingAppointmentsCount }}
            </h4>
        </div>
    </div>
@endrole
