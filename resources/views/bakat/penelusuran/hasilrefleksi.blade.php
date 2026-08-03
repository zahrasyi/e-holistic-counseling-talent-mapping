<x-layouts.app>
    <div id="view-hasil-refleksi" class="p-8 flex flex-col items-center justify-center min-h-[70vh]">
        <div class="bg-white rounded-3xl border border-gray-100 p-10 max-w-2xl w-full shadow-lg text-center relative overflow-hidden flex flex-col items-center">
            <div class="absolute -top-10 -right-10 text-blue-50 opacity-40"></div>

            <div class="text-white p-2 text-center font-bold relative z-20"></div>
            <p class="text-slate-500 mb-8 relative z-10">Evaluasi kesadaran spiritual dan pemahaman potensi diri.</p>
            
            <div class="inline-flex items-center justify-center w-36 h-36 rounded-full mb-6 relative z-10 bg-white shadow-xl" style="border: 5px solid #5c77ce;">
                <span id="refleksi-score-display" class="text-5xl font-extrabold text-blue-800">0</span>
            </div>
            
            <div class="mb-5 relative z-10">
                <span id="refleksi-category-display" class="px-6 py-2.5 rounded-full font-bold text-sm tracking-wide shadow-sm">KATEGORI</span>
            </div>
            
            <p id="refleksi-meaning-display" class="text-slate-700 font-medium text-lg leading-relaxed relative z-10 mb-6 px-4"></p>

            <div class="mt-2 bg-blue-50 border border-blue-200 rounded-2xl p-6 text-left shadow-sm w-full max-w-xl relative z-10">
                <h4 class="font-bold text-blue-800 text-sm mb-3 border-b border-blue-200 pb-2">
                    <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>Saran & Tindak Lanjut:
                </h4>
                <p id="refleksi-recommendation-display" class="text-sm text-slate-700 leading-relaxed text-justify"></p>
            </div>

            <div class="mt-6 mb-4 pt-6 relative z-10 w-full">
                <a href="{{ route('talent.hasil') }}" 
                   class="inline-flex items-center px-8 py-3 rounded-xl text-sm font-bold shadow-md transition-transform hover:-translate-y-1" 
                   style="background-color: #2563eb; color: white;">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Hasil Penelusuran
                </a>
            </div>
        </div>
    </div>

    <script>
        // Data Interpretasi sesuai tabel kamu (warna sudah disesuaikan ke standar Tailwind)
        // Rentang nilai dikembalikan ke maksimal 50
        const interpretasi = [
            { min: 41, max: 50, cat: "Sangat Tinggi", color: "bg-blue-100 text-blue-800", makna: "Kesadaran dan arah bakat sangat matang.", saran: "Luar biasa! Terus asah bakat Anda sebagai sarana dakwah dan wujud syukur. Anda sudah siap untuk menginspirasi dan menjadi mentor bagi teman sejawat." },
            { min: 31, max: 40, cat: "Tinggi", color: "bg-green-100 text-green-700", makna: "Refleksi kuat, sudah mengenal potensi dan peran.", saran: "Pertahankan konsistensi Anda. Mulailah mencoba mengambil peran yang lebih aktif di organisasi atau proyek yang sesuai dengan bakat Anda." },
            { min: 21, max: 30, cat: "Sedang", color: "bg-yellow-100 text-yellow-700", makna: "Kesadaran mulai tumbuh, perlu bimbingan lanjutan.", saran: "Anda sedang dalam perjalanan yang baik. Cobalah untuk lebih sering berefleksi dan meminta masukan dari mentor atau teman sejawat tentang potensi Anda." },
            { min: 0, max: 20, cat: "Rendah", color: "bg-red-100 text-red-600", makna: "Perlu pendampingan intensif.", saran: "Jangan berkecil hati. Mari kita jadwalkan sesi bimbingan lebih intensif untuk mengeksplorasi kembali apa yang sebenarnya menjadi minat dan bakat Anda." }
        ];

        // Mengambil angka 'skor' langsung dari URL
        // Mengambil angka skor langsung dari Controller Laravel
        // Mengambil angka skor langsung dari Controller Laravel
        const skorUser = parseInt("{{ $skor ?? 0 }}");

        function tampilkanHasil(skor) {
            let hasil = interpretasi.find(item => skor >= item.min && skor <= item.max);
            
            // Jaga-jaga kalau skor meleset
            if (!hasil) {
                hasil = skor > 40 ? interpretasi[0] : interpretasi[3];
            }
            
            document.getElementById('refleksi-score-display').innerText = skor;
            document.getElementById('refleksi-category-display').innerText = hasil.cat;
            document.getElementById('refleksi-category-display').className = `px-6 py-2.5 rounded-full font-bold text-sm tracking-wide shadow-sm ${hasil.color}`;
            document.getElementById('refleksi-meaning-display').innerText = hasil.makna;
            document.getElementById('refleksi-recommendation-display').innerText = hasil.saran;
        }

        tampilkanHasil(skorUser);
    </script>
</x-layouts.app>