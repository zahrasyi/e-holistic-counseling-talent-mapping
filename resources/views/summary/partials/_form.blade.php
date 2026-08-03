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
        <label for="recommendations" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
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

<div class="px-6 py-4 bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700 text-right">
    <button type="submit"
        class="bg-primary hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        Simpan & Bagikan ke Mahasiswa
    </button>
</div>
