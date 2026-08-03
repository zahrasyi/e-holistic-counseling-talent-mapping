<x-layouts.app>

    <x-partials.breadcrumbs :items="$breadcrumbs" />

    {{-- Header Form --}}
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Buat Resume Sesi</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">
            Untuk sesi dengan: <span class="font-semibold">{{ $meeting->student->name }}</span>
            <br>
            Pada: <span class="font-semibold">{{ $meeting->meeting_time->format('d F Y, H:i') }}</span>
        </p>
    </div>

    <div class="px-6 py-4 space-y-6">
        {{-- Detail Appointment --}}
        <div class="bg-white dark:bg-gray-900 shadow rounded-lg border border-gray-200 dark:border-gray-700">
            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Detail Appointment</h2>
            </div>
            <x-tables.table-show :fields="$fieldsMeetings">
                <x-slot name="actions"></x-slot>
            </x-tables.table-show>
        </div>

        <div class="bg-white dark:bg-gray-900 shadow rounded-lg border border-gray-200 dark:border-gray-700">
            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Ringkasan Konseling</h2>
            </div>
            <form action="{{ route('summary.store', $meeting) }}" method="POST">
                @csrf
                <div class="p-6">
                    <div class="mb-6">
                        <label for="summary" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Rangkuman Sesi (Analisis & Pembahasan)
                        </label>
                        <textarea id="summary" name="summary" rows="8" required minlength="50"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            placeholder="Tuliskan rangkuman dari pembahasan selama sesi konseling...">{{ old('summary') }}</textarea>
                        @error('summary')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="recommendations"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Saran & Langkah Selanjutnya
                        </label>
                        <textarea id="recommendations" name="recommendations" rows="5" required minlength="20"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            placeholder="Tuliskan rekomendasi, latihan, atau langkah selanjutnya yang disarankan untuk mahasiswa...">{{ old('recommendations') }}</textarea>
                        @error('recommendations')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div
                    class="px-6 py-4 bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700 text-right">
                    <button type="submit"
                        class="bg-primary hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Simpan & Bagikan ke Mahasiswa
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-layouts.app>
