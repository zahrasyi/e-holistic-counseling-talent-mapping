<div class="grid gap-4 sm:grid-cols-2 sm:gap-6">

    <div class="sm:col-span-2 mt-5">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Layanan yang Dipilih</label>
        <div class="w-full p-2.5 bg-gray-100 dark:bg-gray-700 rounded-lg border border-gray-300 dark:border-gray-600">
            <p class="text-gray-900 dark:text-white font-semibold">{{ $counselingType->name }}</p>
        </div>
        <input type="hidden" name="counseling_type_id" value="{{ $counselingType->id }}">
    </div>

    <div class="w-full">
        <label for="counselor_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih
            Konselor</label>
        <select id="counselor_id" name="counselor_id" required
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
            <option selected value="">-- Pilih Konselor --</option>
            @foreach ($counselors as $counselor)
                <option value="{{ $counselor->id }}">{{ $counselor->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="w-full">
        <label for="meeting_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Pilih Tanggal & Waktu
        </label>

        <input type="datetime-local" name="meeting_time" id="meeting_time" required
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
               focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 
               dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
               dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">

        <p class="mt-1 text-sm text-red-500 dark:text-red-500">
            *Tanggal janji temu harus minimal <strong>1 hari setelah hari ini</strong>.
        </p>
    </div>

    <div class="sm:col-span-2">
        <label for="kuesioner_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lampirkan Data
            Tambahan : (optional)</label>
        <select id="kuesioner_id" name="kuesioner_id"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
            <option selected value="">-- Pilih Kuesioner --</option>
            @foreach ($kuesioners as $kuesioner)
                <option value="{{ $kuesioner->id }}">Kuesioner Tanggal {{ $kuesioner->created_at }}</option>
            @endforeach
        </select>
    </div>

    <div class="sm:col-span-2">
        <label for="topics" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Topics Permasalahan
        </label>
        <input type="text" id="topics" name="topics"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300
               focus:ring-primary-500 focus:border-primary-500
               dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
               dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="Tuliskan topik utama permasalahan Anda...">
    </div>

    <div class="sm:col-span-2">
        <label for="student_notes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ceritakan
            Permasalahan Anda</label>
        <textarea id="student_notes" name="student_notes" rows="6"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="Ceritakan singkat mengenai permasalahan yang ingin Anda konsultasikan..."></textarea>
    </div>
</div>
