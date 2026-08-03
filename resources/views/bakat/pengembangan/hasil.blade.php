<x-layouts.app>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <div id="view-hasil-pengembangan" class="p-8 flex flex-col items-center justify-center min-h-[70vh]">
            <div class="bg-white rounded-3xl border border-gray-200 p-10 max-w-5xl w-full shadow-lg text-center relative overflow-hidden">
                

                <h2 class="text-2xl font-bold mt-4 mb-2 relative z-10" style="color: #34538c">Hasil Akhir Tes Aptitude</h2>
                <p class="text-slate-500 mb-8 relative z-10">Peta 6 Domain Kognitif & Sikap.</p>
                
                <div class="bg-blue-50 border border-blue-200 rounded-2xl p-4 mb-8 w-full max-w-4xl mx-auto relative z-10 shadow-inner flex flex-col items-center">                    
                   
                   <form id="formCetakGabungan" action="{{ url('/talent/export-pdf-aptitude/' . $hasilTerbaru->id) }}" method="POST" style="display: none;">
                        @csrf
                        <!-- Menyimpan 2 input gambar -->
                        <input type="hidden" name="chart_aptitude" id="input_chart_aptitude">
                        <input type="hidden" name="chart_portofolio" id="input_chart_portofolio">
                    </form>
                    
                    <!-- Tombol Cetak -->
                    <div class="flex justify-end mb-4 w-full">
                        <button type="button" onclick="cetakLaporanGabungan()" class="px-4 py-2 rounded-xl shadow-sm transition-all bg-green-600 text-white hover:bg-green-700 font-medium" style="cursor: pointer; margin-right: 10px;">
                            <i class="fas fa-print"></i> 
                            Cetak Hasil pdf
                        </button>
                    </div>
                    <div class="flex flex-col lg:flex-row items-center justify-center gap-8 w-full">
                        <div class="relative w-full lg:w-1/2 h-87.5 flex items-center justify-center">
                            <canvas id="devHexagonChart"></canvas>
                        </div>

                        <div class="w-full lg:w-1/2 bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
                            <h3 class="text-sm font-bold text-[#34538c] mb-3 border-b pb-2">Rincian Skor Per Domain</h3>
                            <div class="overflow-y-auto max-h-80 pr-2 custom-scrollbar">
                                <table class="w-full text-sm text-left">
                                    <thead class="text-xs text-gray-500 bg-gray-100 uppercase sticky top-0">
                                        <tr>
                                            <th class="px-3 py-2 rounded-tl-lg">Domain Aptitude</th>
                                            <th class="px-3 py-2 rounded-tr-lg text-right">Persentase</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            // Murni mengurutkan array skor dari tertinggi ke terendah
                                            $sortedDomains = $domainScores;
                                            arsort($sortedDomains);
                                            $nilaiTerendah = min($sortedDomains);
                                        @endphp
                                
                                        <!-- UBAH DISINI: Loop menggunakan array yang sudah disortir ($sortedDomains) -->
                                        @foreach($sortedDomains as $domain => $percent)
                                            @php
                                                // Cek apakah ini bakat dominan (tertinggi)
                                                $isDominant = ($domain == $dominantDomain);
                                                $isLowest = ($percent == $nilaiTerendah);
                                                
                                                // Logika Warna Dinamis
                                                if ($isDominant) {
                                                    $textColor = 'text-blue-700 font-bold';
                                                    $bgColor = 'bg-blue-50';
                                                } elseif ($isLowest) {
                                                    // Warna merah otomatis untuk skor paling kecil
                                                    $textColor = 'text-red-500 font-bold';
                                                    $bgColor = 'bg-red-50'; 
                                                } else {
                                                    $textColor = 'text-gray-700';
                                                    $bgColor = 'bg-white';
                                                }
                                            @endphp
                                        
                                
                                            <tr class="border-b {{ $bgColor }}">
                                                <td class="px-3 py-3 {{ $textColor }}">
                                                    {{ $domain }}
                                                </td>
                                                <td class="px-3 py-3 text-right font-bold {{ $textColor }}">
                                                    {{ $percent }}%
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8 bg-white border rounded-2xl p-5 w-full max-w-md shadow-sm" style="border-color: #34538c">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Bakat Paling Dominan</p>
                        <h3 class="text-2xl font-extrabold text-[#2b4c80] mb-1">{{ $dominantDomain }}</h3>
                        <p class="text-sm font-bold text-[#5b83d7]">Skor Domain: {{ $dominantScore }}%</p>
                    </div>
                </div>
                
                <div class="flex flex-col md:flex-row gap-6 mb-8 w-full max-w-3xl mx-auto relative z-10 justify-center">
                    <div class="bg-white border border-gray-200 rounded-xl p-4 flex-1 shadow-sm">
                        <p class="text-xs text-gray-500 uppercase font-bold mb-1">Total Skor 60 Item</p>
                        <p class="text-2xl font-bold text-slate-800">{{ $totalSkor }}</p>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-xl p-4 flex-1 shadow-sm">
                        <p class="text-xs text-gray-500 uppercase font-bold mb-1">Status Potensi</p>
                        <span class="inline-block px-4 py-1 rounded-full font-bold text-sm {{ $warna }} mt-1">
                            {{ $status }}
                        </span>
                    </div>
                </div>
                
                <p class="text-slate-700 font-medium text-base leading-relaxed relative z-10 mb-8 p-4 bg-gray-50 rounded-lg">
                    {{ $makna }}
                </p>

                <!-- AREA RINGKASAN PORTOFOLIO -->
                <!-- Kita gunakan untuk mengecek apakah user sudah mengisi portofolio -->
                @if(isset($hasPortfolio) && $hasPortfolio)

                    <!-- KARTU RINGKASAN PORTOFOLIO (Muncul jika sudah mengisi) -->
                    <div class="mt-10 w-full max-w-4xl mx-auto bg-blue-50 border border-blue-200 rounded-3xl p-6 md:p-8 relative shadow-sm overflow-hidden z-10">
                        <!-- Badge Selesai di Pojok Kanan Atas -->
                        <div class="absolute top-0 right-0 bg-[#5b83d7] text-blue-700 px-4 py-1.5 rounded-bl-xl text-xs font-bold shadow-sm">
                            <i class="fas fa-check-circle mr-1"></i> Portofolio Selesai
                        </div>
                        
                        <h3 class="text-xl font-bold mb-2 mt-2 md:mt-0" style="color:#34538c "><i class="fas fa-folder-open mr-2"></i> Ringkasan Portofolio Bukti Karya</h3>
                        <p class="text-sm text-slate-600 mb-6">Anda telah mendokumentasikan rekam jejak pengembangan bakat Anda.</p>
                        
                        <!-- Kotak Nilai di Dalam Kartu -->
                        <div class="flex flex-col md:flex-row items-center justify-between bg-white p-5 md:p-6 rounded-xl border mb-6" style="border-color: #34538c">
                            <div class="flex-1 w-full mb-4 md:mb-0 text-center">
                                <p class="text-xs text-gray-500 font-bold uppercase mb-1">Status Portofolio</p>
                                <p class="text-xl md:text-2xl font-black text-[#2b4c80] uppercase">{{ $portoCategory ?? '' }}</p>
                            </div>
                            <div class="flex-1 w-full mb-4 md:text-center text-center">
                                <p class="text-xs text-gray-500 font-bold uppercase mb-1">Skor Bukti Karya</p>
                                <p class="text-3xl font-black text-[#5b83d7]">{{ $portoScore ?? '0' }}<span class="text-xl text-blue-300">/300</span></p>
                            </div>
                        </div>
                        
                        <!-- Tombol Lihat Detail Portofolio (Bisa diarahkan ke route hasil portofolio) -->
                        <a href="{{ route('talent.portofolio.hasil') }}" class="flex justify-center items-center w-full bg-blue-700 hover:bg-blue-400 hover:shadow-md hover:-translate-y-1 text-white py-3.5 p-3 rounded-xl text-sm font-bold transition border border-blue-100">
                            Lihat Detail Portofolio <i class="fas fa-external-link-alt ml-2"></i>
                        </a>
                    </div>

                    <!-- Tombol Lihat & Ubah Portofolio (Di luar kartu) -->
                    <div class="mt-6 flex justify-center w-full max-w-5xl mx-auto relative z-10 mb-10">
                        <a href="{{ route('talent.portofolio') }}" class="bg-blue-50 border hover:bg-gray-50 hover:shadow-md hover:-translate-y-1 px-8 py-3 rounded-xl text-sm font-bold transition flex items-center" style= "color:#34538c">
                            Ubah Portofolio? <i class="fas fa-edit ml-2"></i>
                        </a>
                    </div>

                @else

                    <div class="mt-8 border-t border-gray-100 mb-4 pt-8 relative z-10 flex gap-4 justify-center">
                        <a href="{{ route('talent.portofolio') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl text-sm font-bold transition-all shadow-lg hover:shadow-xl hover:-translate-y-1">
                            Lanjut Buat Portofolio <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>

                @endif
            </div>
        </div>

        @php
            // Mengambil data portofolio dari database
            $answersPorto = \App\Models\PortofolioAnswer::where('user_id', Auth::id())->get();
            $portoScores = array_fill(0, 10, 0);
            foreach ($answersPorto as $ans) {
                $index = (int) floor(($ans->nomor_soal - 1) / 6);
                if(isset($portoScores[$index])) {
                    $portoScores[$index] += $ans->skor;
                }
            }
            $portoScoresJson = json_encode($portoScores);
        @endphp

        <!-- Disembunyikan di luar layar secara aman -->
        <div style="position: absolute; left: -9999px; top: 0; opacity: 0.01; pointer-events: none;">
            <canvas id="portoBarChart" width="800" height="250"></canvas>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // 1. MENGGAMBAR GRAFIK APTITUDE (HEXAGON)
                const ctx = document.getElementById('devHexagonChart').getContext('2d');
                const chartLabels = @json($labels);
                const chartData = @json($chartDataPercent);
                
                new Chart(ctx, {
                    type: 'radar',
                    data: {
                        labels: chartLabels,
                        datasets: [{
                            label: 'Persentase Aptitude',
                            data: chartData,
                            backgroundColor: 'rgba(52, 83, 140, 0.2)',
                            borderColor: 'rgba(52, 83, 140, 1)',
                            pointBackgroundColor: 'rgba(52, 83, 140, 1)',
                            pointBorderColor: '#fff',
                            pointHoverBackgroundColor: '#fff',
                            pointHoverBorderColor: 'rgba(52, 83, 140, 1)',
                            borderWidth: 2,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            r: {
                                min: 0, max: 100,
                                angleLines: { color: 'rgba(0, 0, 0, 0.1)' },
                                grid: { color: 'rgba(0, 0, 0, 0.1)' },
                                pointLabels: { color: '#475569', font: { size: 11, weight: 'bold' } },
                                ticks: { min: 0, max: 100, stepSize: 50, display: false }
                            }
                        },
                        plugins: { legend: { display: false } }
                    }
                });

                // 2. MENGGAMBAR GRAFIK PORTOFOLIO GAIB DI BELAKANG LAYAR
                const ctxPorto = document.getElementById('portoBarChart').getContext('2d');
                new Chart(ctxPorto, {
                    type: 'bar',
                    data: {
                        labels: ["Kreativitas", "Analytical", "Komunikasi", "Numerik", "Sosial", "Moral", "Kemandirian", "Kerjasama", "Teknologi", "Emosional"],
                        datasets: [{
                            label: 'Skor Aspek',
                            data: {!! $portoScoresJson !!},
                            backgroundColor: ['#b91c1c', '#ef4444', '#f97316', '#f59e0b', '#eab308', '#84cc16', '#22c55e', '#0ea5e9', '#3b82f6', '#8b5cf6'],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: false, // KUNCI UTAMA 2: Matikan responsive agar dipaksa berukuran 600x300
                        animation: false,  // Matikan animasi agar instan difoto
                        scales: { y: { beginAtZero: true, max: 30 } }
                    }
                });
            });

            // 3. FUNGSI CETAK GABUNGAN
            function cetakLaporanGabungan() {
            const canvasAptitude = document.getElementById('devHexagonChart'); 
            const canvasPorto = document.getElementById('portoBarChart'); 
            const inputAptitude = document.getElementById('input_chart_aptitude');
            const inputPorto = document.getElementById('input_chart_portofolio');

            // 1. Cek apakah Input formnya beneran ada
            if (!inputPorto) {
                alert("ERROR: Input tersembunyi 'input_chart_portofolio' tidak ditemukan di dalam Form!");
                return;
            }

            // 2. Cek apakah Kanvasnya ada
            if (!canvasPorto) {
                alert("ERROR: Kanvas 'portoBarChart' tidak ditemukan di halaman!");
                return;
            }

            // 3. Tangkap gambarnya
            const dataPorto = canvasPorto.toDataURL('image/png');

            // 4. Cek apakah gambarnya kosong/gagal dirender
            if (dataPorto.length < 100) {
                alert("ERROR: Grafik Portofolio kosong! Chart.js gagal menggambar.");
                return;
            }

            // Jika semua aman, masukkan ke form
            inputAptitude.value = canvasAptitude.toDataURL('image/png');
            inputPorto.value = dataPorto;

            document.getElementById('formCetakGabungan').submit();
        }
        </script>

</x-layouts.app>