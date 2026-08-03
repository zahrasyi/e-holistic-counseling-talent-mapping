@role('admin|super admin')
    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-yellow-100 dark:bg-yellow-900/50">
            <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                </path>
            </svg>
        </div>

        <div class="mt-5 flex items-end justify-between">
            <div>
                <span class="text-sm text-gray-500 dark:text-gray-400">Jumlah Counselor</span>
                <h4 class="mt-2 text-4xl font-bold text-gray-800 dark:text-white/90">
                    {{ number_format($totalKonselor) }}
                </h4>
            </div>

            <span
                class="flex items-center gap-1 rounded-full py-0.5 pl-2 pr-2.5 text-sm font-medium
            @if ($presentasiKonselorAktif > 0) bg-green-100 text-green-700 dark:bg-green-500/15 dark:text-green-400
            @elseif ($presentasiKonselorAktif < 0)
                bg-red-100 text-red-700 dark:bg-red-500/15 dark:text-red-400
            @else
                bg-gray-100 text-gray-700 dark:bg-gray-500/15 dark:text-gray-400 @endif
        ">
                @if ($presentasiKonselorAktif > 0)
                    <svg class="fill-current" width="12" height="12" viewBox="0 0 12 12" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 2.5L10.5 7L1.5 7L6 2.5Z" fill="currentColor" />
                    </svg>
                @elseif ($presentasiKonselorAktif < 0)
                    <svg class="fill-current" width="12" height="12" viewBox="0 0 12 12" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 9.5L1.5 5L10.5 5L6 9.5Z" fill="currentColor" />
                    </svg>
                @else
                    <svg class="fill-current" width="12" height="12" viewBox="0 0 12 12" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 6h8" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                @endif

                {{ number_format(abs($presentasiKonselorAktif), 2) }}%
            </span>
        </div>
    </div>
@endrole

@role('konselor')
    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-100 dark:bg-green-900/50">
            <svg class="w-6 h-6 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                </path>
            </svg>
        </div>

        <div class="mt-5 flex items-end justify-between">
            <div>
                <span class="text-sm text-gray-500 dark:text-gray-400">Total Pasien</span>
                <h4 class="mt-2 text-4xl font-bold text-gray-800 dark:text-white/90">
                    {{ number_format($totalUniquePatients) }}
                </h4>
            </div>

            <span
                class="flex items-center gap-1 rounded-full py-0.5 pl-2 pr-2.5 text-sm font-medium
            @if ($patientGrowthPercentage > 0) bg-green-100 text-green-700 dark:bg-green-500/15 dark:text-green-400
            @elseif ($patientGrowthPercentage < 0)
                bg-red-100 text-red-700 dark:bg-red-500/15 dark:text-red-400
            @else
                bg-gray-100 text-gray-700 dark:bg-gray-500/15 dark:text-gray-400 @endif
        ">
                @if ($patientGrowthPercentage > 0)
                    <svg class="fill-current" width="12" height="12" viewBox="0 0 12 12" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 2.5L10.5 7L1.5 7L6 2.5Z" fill="currentColor" />
                    </svg>
                @elseif ($patientGrowthPercentage < 0)
                    <svg class="fill-current" width="12" height="12" viewBox="0 0 12 12" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 9.5L1.5 5L10.5 5L6 9.5Z" fill="currentColor" />
                    </svg>
                @else
                    <svg class="fill-current" width="12" height="12" viewBox="0 0 12 12" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 6h8" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                @endif

                {{ number_format(abs($patientGrowthPercentage), 2) }}%
            </span>
        </div>
    </div>
@endrole

@role('mahasiswa')
    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-100 dark:bg-green-900/50">
            <svg class="w-6 h-6 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <div class="mt-5">
            <span class="text-sm text-gray-500 dark:text-gray-400">Total Sesi Selesai</span>
            <h4 class="mt-2 text-4xl font-bold text-gray-800 dark:text-white/90">
                {{ $completedSessionsCount }}
            </h4>
        </div>
    </div>
@endrole
