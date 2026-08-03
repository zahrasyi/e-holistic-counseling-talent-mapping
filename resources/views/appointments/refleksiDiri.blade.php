<x-layouts.app>

    <x-partials.breadcrumbs :items="$breadcrumbs" />

    <x-partials.header title="Refleksi Pribadi" description="" />


    <!-- Main Content -->
    <p class="text-sm italic px-5 font-semibold text-blue-500 mb-2">Tulislah refleksi pribadi Anda dalam
        bentuk
        kalimat atau
        paragraf pendek
        untuk
        setiap masalah yang sedang Anda alami. <br> Setelah menuliskan narasi, sertakan kata kunci masalah
        dalam tanda kurung.</p>
    <p class="text-xs italic px-5 font-semibold text-gray-500">Contoh : “Saya sering menunda shalat karena
        sibuk belajar, akhirnya saya merasa tidak tenang.” (Kata
        kunci negatif: shalat tertunda, sibuk belajar, hati gelisah)
    </p>
    <p class="text-xs italic px-5 font-semibold text-gray-500">Contoh : “Saya merasa lebih tenang setelah
        memperbanyak dzikir sebelum tidur.”
        (Kata kunci positif: dzikir rutin, tidur berkualitas, hati tenang)</p>
    <form id="refleksi11Form" action="{{ route('appointments.storeRefleksiDiri', $meetingId) }}" method="POST">
        @csrf
        <input type="hidden" name="meetingId" value={{ $meetingId }}>
        <div class="refleksiDiri p-4">
            <?php for($i = 1; $i <= 10; $i++): ?>
            <div class="mb-2">
                <h2 class="text-lg font-semibold mb-1">Refleksi {{ $i }}.</h2>
                <textarea required rows="1" name="refleksiDiri[{{ $i }}]" placeholder="Tuliskan refleksimu..."
                    class="w-full p-2 rounded-lg border border-gray-300 bg-gray-50 
                                           dark:bg-gray-700 dark:border-gray-600 
                                           focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>
            <?php endfor; ?>
        </div>


        <div class="mt-6 flex justify-center items-center">
            <button type="submit" id="submitBtn"
                class="cursor-pointer mx-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 dark:hover:bg-green-500 active:scale-95 transition-all">Kirim</button>
        </div>
    </form>

</x-layouts.app>
