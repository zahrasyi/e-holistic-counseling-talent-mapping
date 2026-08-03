<x-layouts.app>
    <div id="view-hasil-portofolio" class="p-8 flex flex-col items-center justify-center min-h-[70vh]">
        <div class="bg-white rounded-3xl border border-gray-200 p-10 max-w-6xl w-full shadow-lg text-center relative overflow-hidden">
            <h2 class="text-3xl font-bold mb-2 mt-8 relative z-10" style="color:#34538c">Evaluasi & Validasi Portofolio</h2>
            <p class="text-slate-500 mb-8 relative z-10">Tingkat kematangan pengalaman dan pembuktian karya bakat Anda.</p>
            
            <div class="flex flex-col md:flex-row gap-6 mb-8 relative z-10 justify-center">
    
                <!-- KOTAK KIRI: Total Skor Diperoleh (Maks 300) -->
                <div class="bg-[#f0f4fc] border border-blue-200 rounded-2xl p-8 flex flex-col items-center justify-center max-w-xl min-w-50 shadow-sm">
                    <p class="text-xs text-gray-500 font-bold uppercase mb-2">Total Skor Mentah</p>
                    <span class="text-5xl font-extrabold text-[#5b83d7]">{{ $totalScore }}</span>
                    <p class="text-[11px] text-gray-400 mt-2 font-medium">Maksimal: 300 Poin</p>
                </div>
            
                <!-- KOTAK KANAN: Skor Akhir (Rumus) & Kategori -->
                <div class="bg-white border border-blue-200 rounded-2xl p-8 flex-1 max-w-xl shadow-sm flex flex-col justify-center items-center text-center">
                    <p class="text-xl text-blue-400 font-bold uppercase mb-2 tracking-wider">Skor Akhir Validasi</p>
                    
                    <!-- Menampilkan Variabel Skor Akhir (Skala 100) -->
                    <span class="text-4xl font-black text-[#34538c] mb-3">{{ $skorAkhir }}</span>
                    
                    <!-- Menampilkan Kategori (Sangat Unggul/Baik/dll) -->
                    <span class="inline-block px-4 py-1.5 rounded-full font-bold text-sm tracking-wide bg-blue-100 text-blue-800 w-fit mb-3">
                        {{ $kategori }}
                    </span>
                    
                    <!-- Menampilkan Interpretasi Makna -->
                    <p class="text-slate-600 font-medium text-[15px] leading-relaxed max-w-lg px-2">
                        {{ $makna }}
                    </p>
                </div>
                
            </div>

            
            <div class="max-w-5xl mx-auto mt-8 bg-[#f8fafc] border border-blue-200 rounded-2xl p-3 md:p-8 shadow-inner text-left relative z-10">
                <h3 class="text-xl font-bold border-b border-blue-200 pb-2 mt-2 tracking-wider mb-6" style="color:#34538c"><i class="fas fa-chart-bar text-2xl mr-2"></i> Grafik Distribusi Bukti per Aspek</h3>
                
                <div class="max-w-5xl mx-auto relative px-5 md:px-4" style="height: 400px;">
                    <canvas id="portoBarChart"></canvas>
                </div>
            </div>

            <!-- Rekap Bukti Karya (Gaya Badge/Chip Kelompok) -->
            <div class="max-w-5xl mx-auto mt-8 bg-[#f8fafc] border border-blue-200 rounded-2xl p-3 md:p-8 shadow-inner text-left relative z-10">
                <div class="flex items-center gap-2 border-b border-gray-200 pb-2 mb-4">
                    <i class="fas fa-archive text-blue-800 text-xl"></i>
                    <h3 class="text-xl font-bold pb-2 mt-2 tracking-wider mb-2" style="color:#34538c">Rekap Bukti Karya (Evidence) yang Diunggah</h3>
                </div>

                @php
                    // 1. Kita kelompokkan dulu berkasnya berdasarkan nama Aspek
                    $groupedEvidences = [];
                    foreach($evidences as $evidence) {
                        $indexAspek = (int) floor(($evidence->nomor_soal - 1) / 6);
                        $namaAspek = $aspectNames[$indexAspek] ?? 'Aspek Lainnya';
                        $groupedEvidences[$namaAspek][] = $evidence;
                    }
                @endphp

                <div class="space-y-5">
                    @forelse($groupedEvidences as $aspek => $items)
                        <!-- Block per Kategori Aspek -->
                        <div>
                            <!-- Judul Aspek -->
                            <h4 class="text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">{{ $aspek }}</h4>
                            
                            <!-- Deretan Badge Berkas -->
                            <div class="flex flex-wrap gap-2">
                                @foreach($items as $item)
                                    
                                    <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank" 
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white border border-gray-200 text-gray-700 text-xs font-medium rounded-full hover:bg-blue-50 hover:text-blue-700 hover:border-blue-300 transition-all duration-200 shadow-sm cursor-pointer">
                                         <i class="fas fa-file-pdf text-red-500"></i>
                                         Berkas No. {{ $item->nomor_soal }}
                                     </a>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 italic bg-gray-50 p-3 rounded-lg border border-dashed border-gray-200">
                            Belum ada berkas karya yang diunggah.
                        </p>
                    @endforelse
                </div>
            </div>

            <div class="max-w-5xl mx-auto md:mx-8 mt-10 bg-blue-50 border border-blue-200 rounded-3xl p-6 md:p-8 text-left relative overflow-hidden shadow-inner z-10">
                <div class="absolute top-0 right-0 -mt-8 -mr-6 text-blue-200 opacity-30 transition-transform duration-1000 hover:rotate-12 hover:scale-110"></div>
                <h3 class="text-xl font-bold mb-6 border-b border-blue-200 pb-3 flex items-center" style="color:#34538c">
                    Penutup Motivasional Islam
                </h3>
                
                <div class="relative">
                    <div id="porto-quote-slider" class="flex overflow-x-auto snap-x snap-mandatory hide-scrollbar gap-4 pb-4 scroll-smooth">
                        <div class="snap-center shrink-0 w-[95%] sm:w-[85%] flex items-start bg-white p-5 rounded-xl shadow-sm border-l-4" style="border-color: #2563eb">
                            <i class="fas fa-book-open text-blue-400 mt-1 mr-4 text-2xl"></i>
                            <div>
                                <p class="text-sm text-slate-700 leading-relaxed ml-2 font-medium text-justify">"Sesungguhnya Allah tidak akan mengubah keadaan suatu kaum hingga mereka mengubah keadaan yang ada pada diri mereka sendiri."</p>
                                <span class="text-xs text-blue-600 font-bold block mt-3 bg-blue-50 w-fit px-2 py-1 rounded">QS. Ar-Ra’d: 11</span>
                                <p class="text-xs text-gray-500 mt-2 text-justify">Ayat ini mengisyaratkan bahwa perubahan dan pengembangan bakat merupakan tanggung jawab pribadi setiap insan yang disertai niat ikhlas dan usaha sungguh-sungguh. Dalam pandangan Islam, bakat adalah amanah Ilahi yang wajib dikembangkan untuk kemaslahatan umat.</p>
                            </div>
                        </div>
                        <div class="snap-center shrink-0 w-[95%] sm:w-[85%] flex items-start bg-white p-5 rounded-xl shadow-sm border-l-4" style="border-color: #34d399;">
                            <i class="fas fa-comment-dots mt-1 mr-4 text-2xl" style="color: #34d399;"></i>
                            <div>
                                <p class="text-sm text-slate-700 leading-relaxed ml-2 font-medium text-justify">"Sesungguhnya Allah mencintai apabila seseorang di antara kalian mengerjakan suatu pekerjaan, ia melakukannya dengan itqan (sebaik-baiknya)."</p>
                                <span class="text-xs font-bold block mt-3 w-fit px-2 py-1 rounded" style="color: #059669; background-color: #ecfdf5;">HR. al-Baihaqi</span>
                                <p class="text-xs text-gray-500 mt-2 text-justify">Hadis ini menegaskan nilai profesionalisme spiritual — bahwa setiap bakat yang dikembangkan dengan niat ibadah akan menjadi jalan menuju keberkahan hidup.</p>
                            </div>
                        </div>
                        <div class="snap-center shrink-0 w-[95%] sm:w-[85%] flex items-start bg-white p-5 rounded-xl shadow-sm border-l-4" style="border-color: #fbbf24;">
                            <i class="fas fa-pen-fancy mt-1 mr-4 text-2xl" style="color: #fbbf24;"></i>
                            <div>
                                <p class="text-sm text-slate-700 leading-relaxed ml-2 font-medium text-justify">"Sesungguhnya pekerjaan yang dilakukan dengan niat mencari ridha Allah akan menjadi ibadah, meskipun itu pekerjaan duniawi."</p>
                                <span class="text-xs font-bold block mt-3  w-fit px-2 py-1 rounded" style="color: #d97706; background-color: #fffbeb;">Imam al-Ghazali, Ihya’ Ulum al-Din</span>
                                <p class="text-xs text-gray-500 mt-2 text-justify">Ulama besar ini mengingatkan bahwa bakat akademik, sosial, maupun teknologis akan bernilai ibadah bila disertai iman dan tujuan suci.</p>
                            </div>
                        </div>
                        <div class="snap-center shrink-0 w-[95%] sm:w-[85%] flex items-start bg-white p-5 rounded-xl shadow-sm border-l-4" style="border-color: #c084fc;">
                            <i class="fas fa-feather-alt mt-1 mr-4 text-2xl" style="color: #c084fc;"></i>
                            <div>
                                <p class="text-sm text-slate-700 leading-relaxed ml-2 font-medium text-justify">"Setiap bakat dan potensi yang Allah karuniakan adalah sarana menuju penghambaan (ubudiyyah). Barang siapa mengenali dan menggunakannya untuk Allah, maka ia telah bersyukur."</p>
                                <span class="text-xs font-bold block mt-3 w-fit px-2 py-1 rounded" style="color: #9333ea; background-color: #faf5ff;">Ibn Qayyim al-Jauziyyah</span>
                                <p class="text-xs text-gray-500 mt-2 text-justify">Dengan demikian, pengembangan bakat Islami bukan sekadar peningkatan kemampuan teknis, tetapi juga proses tazkiyah an-nafs (penyucian diri), penguatan iman, dan pengabdian sosial.</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between items-center mt-2 px-2">
                        <p class="text-xs text-slate-400 font-medium animate-pulse"><i class="fas fa-arrows-alt-h mr-1"></i> Geser untuk membaca selengkapnya</p>
                        <div class="flex space-x-2">
                            <button onclick="slidePortoQuote(-1)" class="w-8 h-8 rounded-full bg-white shadow text-[#5b83d7] hover:bg-blue-50 flex items-center justify-center transition border border-gray-100"><i class="fas fa-chevron-left"></i></button>
                            <button onclick="slidePortoQuote(1)" class="w-8 h-8 rounded-full bg-white shadow text-[#5b83d7] hover:bg-blue-50 flex items-center justify-center transition border border-gray-100"><i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 mb-5 border-t border-gray-100 pt-6 relative z-10 w-full flex justify-center">
                <a href="/talent/development-stage/hasil" class="inline-flex items-center bg-blue-700 hover:bg-blue-400 hover:shadow-md hover:-translate-y-1 text-white px-8 py-3 rounded-xl text-sm font-bold transition shadow-sm border border-gray-300">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Hasil Pengembangan
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function slidePortoQuote(direction) {
            const slider = document.getElementById('porto-quote-slider');
            const scrollAmount = slider.clientWidth * 0.8;
            slider.scrollBy({ left: direction * scrollAmount, behavior: 'smooth' });
        }

        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('portoBarChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($aspectNames) !!},
                    datasets: [{
                        label: 'Skor Per Aspek',
                        data: {!! json_encode($aspectScores) !!},
                        backgroundColor: [
                            '#b91c1c', '#ef4444', '#f97316', '#f59e0b', '#fbbf24', 
                            '#a3e635', '#22c55e', '#0ea5e9', '#3b82f6', '#8b5cf6'  
                        ],
                        borderRadius: 4,
                        borderSkipped: false
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: { bottom: 35, left: 10, right: 10 }
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(52, 83, 140, 0.9)',
                            padding: 12,
                            cornerRadius: 8
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false, drawBorder: false },
                            ticks: {
                                font: { size: 11, weight: '600' },
                                color: '#475569',
                                maxRotation: 45, 
                                minRotation: 45
                            }
                        },
                        y: {
                            beginAtZero: true,
                            max: 30,
                            grid: {
                                display: true, 
                                color: '#f1f5f9', 
                                drawBorder: false
                            },
                            ticks: {
                                padding: 10,
                                font: { size: 11 },
                                color: '#64748b',
                                stepSize: 5 
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-layouts.app>