<x-layouts.app>

    <div class="bg-white rounded-2xl mb-10 shadow-sm p-8">

        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold" style="color:#34538c">
                Peta Potensi & Bakat Anda
            </h2>
            <p class="text-gray-500">
                Berdasarkan 15 Kompetensi Dasar UNIDA Gontor
            </p>
        </div>

        <form id="exportPdfForm" action="{{ url('/talent/export-pdf/' . $hasilTerbaru->id) }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="chart_image" id="chart_image_input">
        </form>
        <div class="flex justify-end mb-4 w-full "> 
            <button type="button" onclick="exportToPdf()" class="px-4 py-2 rounded-xl shadow-sm transition-all bg-green-600 text-white hover:bg-green-700 font-medium" style="cursor: pointer; margin-right: 10px;">
                <i class="fas fa-print"></i>
                Export hasil pdf
            </button>
        </div>
    
        <div class="flex flex-col lg:flex-row items-start justify-center gap-8 lg:gap-10">
    
            <!-- BAGIAN RADAR CHART -->
            <div class="w-full lg:w-2/3 flex justify-center items-center">
                <div class="relative w-full max-w-100 aspect-square">
                    <canvas id="radarChart"></canvas>
                </div>
            </div>
        
            <style>
                /* Bikin scrollbar jadi tipis dan elegan */
                .skor-scrollbar::-webkit-scrollbar {
                    width: 6px; /* Ketebalan batang scrollbar */
                }
                .skor-scrollbar::-webkit-scrollbar-track {
                    background: #f8fafc; /* Warna jalur background */
                    border-radius: 10px;
                }
                .skor-scrollbar::-webkit-scrollbar-thumb {
                    background: #cbd5e1; /* Warna scrollbar-nya (abu-abu kalem) */
                    border-radius: 10px;
                }
                .skor-scrollbar::-webkit-scrollbar-thumb:hover {
                    background: #94a3b8; /* Warnanya sedikit gelap saat disorot mouse */
                }
            </style>
        
            <!-- BAGIAN RINCIAN SKOR BAKAT (TABEL) -->
            <div class="w-full lg:w-2/3 bg-[#f8fafc] rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                <div class="p-5 border-b border-gray-200 bg-[#f8fafc]">
                    <h3 class="font-bold text-slate-800">Rincian Skor Bakat</h3>
                </div>
            
                <div class="flex justify-between px-5 py-3 border-b border-gray-200 text-sm text-slate-600">
                    <span>Kompetensi</span>
                    <span>Skor</span>
                </div>
                
                <div style="max-height: 490px; overflow-y: auto;" class="bg-white skor-scrollbar">
                    @php 
                        if(!empty($detailSkor)) {
                            arsort($detailSkor); 
                            $totalData = count($detailSkor);
                        } else {
                            $detailSkor = [];
                            $totalData = 0;
                        }
                    @endphp
                
                    @foreach($detailSkor as $nama => $skor)
                        @php
                            // Deteksi posisi urutan
                            $isTop3 = $loop->iteration <= 3;
                            $isBottom3 = $loop->iteration > ($totalData - 3);
        
                            // Pengaturan Warna Default (Tengah-tengah)
                            $bgClass = 'hover:bg-slate-50';
                            $textNameClass = 'text-slate-700';
                            $textScoreClass = 'text-slate-800';
        
                            // Timpa warna jika masuk Top 3 atau Bottom 3
                            if ($isTop3) {
                                $bgClass = 'bg-blue-50 hover:bg-blue-100';
                                $textNameClass = 'text-blue-700 font-semibold';
                                $textScoreClass = 'text-blue-700';
                            } elseif ($isBottom3) {
                                $bgClass = 'bg-red-50 hover:bg-red-100';
                                $textNameClass = 'text-red-600 font-semibold';
                                $textScoreClass = 'text-red-600';
                            }
                        @endphp
                        <div class="flex justify-between px-5 py-4 border-b border-gray-100 transition-colors {{ $bgClass }}">
                            
                            <span class="text-sm {{ $textNameClass }}">
                                {{ $nama }}
                            </span>
                            
                            <span class="text-sm font-bold {{ $textScoreClass }}">
                                {{ $skor }}%
                            </span>
                
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    
    </div>

    <div class="bg-blue-50 p-6 md:p-8 rounded-2xl border shadow-sm mt-18 mb-8" style="border-color:#95b9e4;">
        @php
            $semuaBakat = [];
            foreach($topBakat as $nama => $skor){
                $semuaBakat[] = [
                    'nama' => $nama,
                    'skor' => $skor
                ];
            }
    
            // Ambil 3 Teratas dan 3 Terbawah
            $top3 = array_slice($semuaBakat, 0, 3);
            $bottom3 = array_slice($semuaBakat, -3);
        @endphp
    
        <h3 class="text-xl font-bold text-center mb-6 flex items-center justify-center gap-2" style="color:#34538c">
            <i class="fas fa-chart-pie"></i> Ringkasan Analisis 
        </h3>
    
        {{-- BARIS 1: 3 TERTINGGI (BIRU) --}}
        <h4 class="font-bold text-blue-800 mb-3 text-center md:text-left mt-2">3 Potensi Tertinggi</h4>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            @foreach($top3 as $bakat)
                <div class="bg-white border-b-4 border-blue-500 rounded-xl p-5 text-center shadow-md hover:-translate-y-1 transition-transform">
                    <h3 class="font-medium mt-1 text-gray-600 text-sm">{{ $bakat['nama'] }}</h3>
                    <p class="text-3xl font-bold mt-1 text-blue-600">{{ $bakat['skor'] }}%</p>
                </div>
            @endforeach
        </div>
    
        {{-- BARIS 2: 3 TERENDAH (MERAH) --}}
        <h4 class="font-bold text-red-700 mb-3 text-center md:text-left mt-6">3 Potensi Terendah</h4>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($bottom3 as $bakat)
                <div class="bg-white border-b-4 border-red-500 rounded-xl p-5 text-center shadow-md hover:-translate-y-1 transition-transform">
                    <h3 class="font-medium mt-1 text-gray-600 text-sm">{{ $bakat['nama'] }}</h3>
                    <p class="text-3xl font-bold mt-1 text-red-600">{{ $bakat['skor'] }}%</p>
                </div>
            @endforeach
        </div>
    
        {{-- TEKS INTERPRETASI --}}
        <div class="mt-8 bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <h4 class="font-bold text-[#34538c] mb-3">
                Interpretasi Peta Potensi Anda
            </h4>
            <p class="text-gray-700 leading-relaxed">
                Berdasarkan hasil kuesioner, Anda memiliki potensi dominan pada
                <b>{{ $top3[0]['nama'] ?? '-' }}</b>,
                <b>{{ $top3[1]['nama'] ?? '-' }}</b>,
                dan
                <b>{{ $top3[2]['nama'] ?? '-' }}</b>.
                Kombinasi ketiga kompetensi tersebut menunjukkan bahwa Anda memiliki peluang besar untuk berkembang secara optimal pada bidang yang sejalan dengan kemampuan tersebut.
            </p>
            <p class="mt-3 text-gray-700 leading-relaxed">
                Sementara itu, aspek
                <b>{{ $bottom3[0]['nama'] ?? '-' }}</b>, 
                <b>{{ $bottom3[1]['nama'] ?? '-' }}</b>, 
                dan 
                <b>{{ $bottom3[2]['nama'] ?? '-' }}</b> 
                berada pada posisi terendah. Aspek-aspek ini dapat Anda jadikan sebagai area evaluasi dan eksplorasi lebih lanjut agar potensi diri Anda menjadi lebih seimbang dan menyeluruh.
            </p>
        </div>
    </div>
    {{-- ========================= --}}
    {{-- REKOMENDASI UKM --}}
    {{-- ========================= --}}

    <div class="mt-10">

        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold" style="color: #34538c">Rekomendasi UKM</h2>
            <p class="text-gray-500">Berdasarkan kecocokan profil bakat Anda</p>
        </div>

        <style>
            /* CSS Khusus agar warna Biru Tua anti-gagal */
            .btn-aktif {
                background-color: #2563eb !important;
                border-color: #2563eb !important;
                color: white !important;
                font-weight: 700 !important;
                transform: scale(1.05);
            }
            .btn-pasif {
                background-color: white !important;
                border-color: #d1d5db !important;
                color: #6b7280 !important;
                font-weight: 500 !important;
            }
            .btn-pasif:hover {
                background-color: #eff6ff !important; /* Biru muda saat disorot */
                border-color: #34538c !important;
                color: #34538c !important;
            }
        </style>
        
        {{-- Tombol Filter bergaya Kapsul Modern --}}
        <div class="flex justify-center gap-4 mb-10">
            <button
                id="btn-putri"
                onclick="showUKM('putri')"
                class="px-8 py-2.5 rounded-full text-sm transition-all duration-300 border shadow-sm btn-aktif">
                Putri
            </button>
        
            <button
                id="btn-putra"
                onclick="showUKM('putra')"
                class="px-8 py-2.5 rounded-full text-sm transition-all duration-300 border shadow-sm btn-pasif">
                Putra
            </button>
        </div>

        {{-- ================= PUTRI ================= --}}
        <div id="ukm-putri" class="grid md:grid-cols-3 gap-6 transition-opacity duration-300">
            @forelse($rekomendasiPutri as $ukm)
                {{-- onclick --}}
                <div class="bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100 cursor-pointer hover:shadow-lg transform transition hover:-translate-y-1"
                    onclick="bukaModalUKM(
                        '{{ addslashes($ukm['UKM']) }}',
                        '{{ addslashes($ukm['deskripsi'] ?? 'Deskripsi tentang UKM ' . $ukm['UKM'] . ' belum tersedia saat ini.') }}',
                        '{{ asset($ukm['gambar']) }}',
                        '{{ $ukm['persen'] }}'
                    )">
                    <img src="{{ asset($ukm['gambar']) }}" onerror="this.src='https://placehold.co/400x200/e2e8f0/475569?text=UKM+Image'" class="w-full h-40 object-cover" alt="{{ $ukm['UKM'] }}">
                    <div class="p-5">
                        <h3 class="font-bold text-lg text-gray-800">{{ $ukm['UKM'] }}</h3>
                        <div class="mt-3">
                            <div class="flex justify-between text-sm mb-1 text-gray-600">
                                <span>Kecocokan</span>
                                <span class="font-bold">{{ $ukm['persen'] }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $ukm['persen'] }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-8 text-gray-500 bg-white rounded-2xl border border-dashed border-gray-300">
                    Belum ada rekomendasi UKM Putri yang sesuai.
                </div>
            @endforelse
        </div>

        {{-- ================= PUTRA ================= --}}
        <div id="ukm-putra" class="grid md:grid-cols-3 gap-6 transition-opacity duration-300">
            @forelse($rekomendasiPutra as $ukm)
                <div class="bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100 cursor-pointer hover:shadow-lg transform transition hover:-translate-y-1"
                    onclick="bukaModalUKM(
                        '{{ addslashes($ukm['UKM']) }}', 
                        '{{ addslashes($ukm['deskripsi'] ?? 'Deskripsi detail tentang UKM ' . $ukm['UKM'] . ' belum tersedia saat ini.') }}', 
                        '{{ asset($ukm['gambar']) }}', 
                        '{{ $ukm['persen'] }}'
                    )">
                    <img src="{{ asset($ukm['gambar']) }}" onerror="this.src='https://placehold.co/400x200/e2e8f0/475569?text=UKM+Image'" class="w-full h-40 object-cover" alt="{{ $ukm['UKM'] }}">
                    <div class="p-5">
                        <h3 class="font-bold text-lg text-gray-800">{{ $ukm['UKM'] }}</h3>
                        <div class="mt-3">
                            <div class="flex justify-between text-sm mb-1 text-gray-600">
                                <span>Kecocokan</span>
                                <span class="font-bold">{{ $ukm['persen'] }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $ukm['persen'] }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-8 text-gray-500 bg-white rounded-2xl border border-dashed border-gray-300">
                    Belum ada rekomendasi UKM Putra yang sesuai.
                </div>
            @endforelse
        </div>
    </div>

    <style>
        /* Sembunyikan scrollbar tapi tetap bisa di-scroll */
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
    
    {{-- ======================================= --}}
    {{-- SECTION PENUTUP MOTIVASIONAL --}}
    {{-- ======================================= --}}
    <!-- Ditambahkan class animasi milikmu: anim-fade-up opacity-0 z-10 -->
    <div class="w-full mt-10 bg-blue-100 border rounded-3xl p-6 md:p-8 text-left relative overflow-hidden shadow-sm" style="border-color: #95b9e4;">
        
        <!-- Ikon Quote Besar Transparan (Dipertahankan efek hover mutar milikmu) -->
        <i class="fas fa-quote-right absolute -top-4 right-4 text-[120px] opacity-40 z-0 transition-transform duration-1000 hover:rotate-12 hover:scale-110 pointer-events-none" style="color: #bfdbfe;"></i>
    
        <!-- Judul dengan Icon Lingkaran -->
        <h3 class="text-xl font-bold mb-6 flex items-center relative border-b pb-4" style="color:#34538c; border-color: #95b9e4">
            <div class="w-8 h-8 rounded-full bg-blue-100 text-[#34538c] flex items-center justify-center mr-3">
                <i class="fas fa-star-and-crescent text-xl" style="color: #34538c"></i>
            </div>
            Penutup Motivasional Islam
        </h3>
    
        <!-- Container Slider (Menggunakan ID search-quote-slider) -->
        <div class="relative">
            <div id="search-quote-slider" class="flex overflow-x-auto snap-x snap-mandatory hide-scrollbar gap-5 pb-4 scroll-smooth">

                <div class="snap-center shrink-0 w-[95%] sm:w-[85%] flex items-start bg-white p-5 rounded-xl shadow-sm border-l-4" style="border-color: #2563eb">
                    <i class="fas fa-book-open text-blue-400 mt-1 mr-4 text-2xl"></i>
                    <div>
                        <p class="text-sm text-slate-700 leading-relaxed ml-2 font-medium text-justify">"Kami telah menciptakan manusia dalam bentuk yang sebaik-baiknya."</p>
                        <span class="text-xs text-blue-600 font-bold block mt-3 bg-blue-50 w-fit px-2 py-1 rounded">QS. At-Tin: 4</span>
                    </div>
                </div>
                <div class="snap-center shrink-0 w-[95%] sm:w-[85%] flex items-start bg-white p-5 rounded-xl shadow-sm border-l-4" style="border-color: #34d399;">
                    <i class="fas fa-comment-dots mt-1 mr-4 text-2xl" style="color: #34d399;"></i>
                    <div>
                        <p class="text-sm text-slate-700 leading-relaxed ml-2 font-medium text-justify">"Setiap orang dimudahkan menuju apa yang telah diciptakan untuknya."</p>
                        <span class="text-xs font-bold block mt-3 w-fit px-2 py-1 rounded" style="color: #059669; background-color: #ecfdf5;">HR. Bukhari dan Muslim</span>
                    </div>
                </div>
                <div class="snap-center shrink-0 w-[95%] sm:w-[85%] flex items-start bg-white p-5 rounded-xl shadow-sm border-l-4" style="border-color: #fbbf24;">
                    <i class="fas fa-pen-fancy mt-1 mr-4 text-2xl" style="color: #fbbf24;"></i>
                    <div>
                        <p class="text-sm text-slate-700 leading-relaxed ml-2 font-medium text-justify">"Setiap manusia memiliki jalan dan kemampuan unik yang Allah titipkan kepadanya; tugasnya adalah mengenali dan memanfaatkannya untuk kebaikan."</p>
                        <span class="text-xs font-bold block mt-3  w-fit px-2 py-1 rounded" style="color: #d97706; background-color: #fffbeb;">Imam Ibn Qayyim al-Jauziyyah</span>
                    </div>
                </div>
    
            </div>
    
            <!-- Navigasi Bawah Slider (Tombol menggunakan slideSearchQuote) -->
            <div class="flex justify-between items-center mt-3 px-2">
                <p class="text-xs text-slate-400 font-medium animate-pulse">Geser untuk membaca selengkapnya</p>
                <div class="flex space-x-2">
                    <button onclick="slideSearchQuote(-1)" class="w-8 h-8 rounded-full bg-white shadow-sm border border-gray-400 text-blue-700 hover:bg-blue-50 transition flex items-center justify-center">
                        <i class="fas fa-chevron-left text-xs" style="color: #34538c;"></i>
                    </button>
                    <button onclick="slideSearchQuote(1)" class="w-8 h-8 rounded-full bg-white shadow-sm border border-gray-400 text-blue-700 hover:bg-blue-50 transition flex items-center justify-center">
                        <i class="fas fa-chevron-right text-xs" style="color: #34538c;"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Tombol Refleksi Diri --}}
    <div class="mt-10 mb-16 text-center">
        <p class="text-2xs font-bold text-[#34538c] mb-4">Ingin mengetahui lebih dalam tentang kesadaran potensi Anda?</p>
        <a href="{{ route('talent.refleksi') }}" class="inline-flex items-center justify-center bg-white text-blue-700 hover:bg-blue-700 hover:text-white px-8 py-3 rounded-full text-sm font-bold transition-all duration-300 shadow-md hover:shadow-lg hover:scale-105 border border-blue-50">
            Isi Refleksi Diri <i class="fas fa-arrow-right ml-2"></i>
        </a>
    </div>

    <div id="ukm-modal" class="fixed inset-0 z-100 hidden items-center justify-center bg-slate-900/40 backdrop-blur-sm transition-opacity duration-300 opacity-0 px-4 py-10 overflow-y-auto" style="display: none;">
        <div class="relative w-full max-w-2xl mx-auto my-auto flex items-center justify-center min-h-[calc(100vh-5rem)]">

            <div id="ukm-modal-content" class="bg-white rounded-3xl w-full max-w-2xl max-h-[90vh] overflow-hidden shadow-2xl transform scale-95 transition-transform duration-300 flex flex-col relative">
                
                <button onclick="tutupModalUKM()" class="absolute top-4 right-4 w-9 h-9 flex items-center justify-center bg-black/30 hover:bg-red-500 rounded-full text-white transition-colors z-10 backdrop-blur-md">
                    <i class="fas fa-times"></i>
                </button>

                {{-- Container Gambar Modal (Rasio 16:9, Anti-Crop) --}}
                <div class="w-full aspect-video relative bg-slate-100 border-b border-gray-200">
                    
                    {{-- Gambar UKM --}}
                    <img id="modal-ukm-img" src="" onerror="this.src='https://placehold.co/800x450/e2e8f0/475569?text=UKM+Image'" alt="Foto UKM" class="w-full h-full object-contain p-4">
                    
                    {{-- Overlay Judul UKM (Gradient Hitam) --}}
                    <div class="absolute bottom-0 left-0 right-0 bg-linear-to-t from-slate-900/90 to-transparent p-6 pointer-events-none">
                        <h2 id="modal-ukm-title" class="text-2xl md:text-3xl font-bold text-white">Nama UKM</h2>
                    </div>
                    
                </div>

                <div class="p-6 md:p-8 overflow-y-auto skor-scrollbar">
                    
                    <div class="flex items-center justify-between mb-5 border-b border-gray-100 pb-4">
                        <span class="text-sm font-semibold text-slate-500">Tingkat Kecocokan:</span>
                        <span id="modal-ukm-percent" class="px-4 py-1.5 bg-[#eef3fc] text-[#34538c] font-bold rounded-full text-sm border border-blue-100">
                            0%
                        </span>
                    </div>
                    
                    <h4 class="text-base font-bold text-[#34538c] mb-3 flex items-center">
                        <i class="fas fa-info-circle mr-2"></i> Tentang UKM
                    </h4>
                    
                    <p id="modal-ukm-desc" class="text-sm md:text-base text-slate-600 leading-relaxed text-justify whitespace-pre-line">
                        Deskripsi UKM akan muncul di sini...
                    </p>

                    <div class="mt-8 text-right">
                        <button onclick="tutupModalUKM()" class="px-8 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-full text-sm font-bold shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                            Tutup
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Load Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // ==========================================
        // 1. FUNGSI FILTER UKM (Ditaruh di luar agar bisa dipanggil onclick)
        // ==========================================
        function showUKM(gender) {
            const divPutri = document.getElementById('ukm-putri');
            const divPutra = document.getElementById('ukm-putra');
            const btnPutri = document.getElementById('btn-putri');
            const btnPutra = document.getElementById('btn-putra');

            if (!divPutri || !divPutra || !btnPutri || !btnPutra) return;

            // Sembunyikan daftar UKM
            divPutri.classList.add('hidden');
            divPutra.classList.add('hidden');

            // Kelas dasar (ukuran dan bentuk kapsul) yang selalu nempel
            const baseClass = "px-8 py-2.5 rounded-full text-sm transition-all duration-300 border shadow-sm ";

            if (gender === 'putri') {
                divPutri.classList.remove('hidden');
                
                // Set Putri jadi Biru Tua, Putra jadi Putih
                btnPutri.className = baseClass + "btn-aktif shadow-md";
                btnPutra.className = baseClass + "btn-pasif";
            } else {
                divPutra.classList.remove('hidden');
                
                // Set Putra jadi Biru Tua, Putri jadi Putih
                btnPutra.className = baseClass + "btn-aktif shadow-md";
                btnPutri.className = baseClass + "btn-pasif";
            }
        }

        // Fungsi untuk MEMBUKA Modal
        function bukaModalUKM(nama, deskripsi, fotoUrl, persen) {
            // Ambil elemen modal
            const modal = document.getElementById('ukm-modal');
            const modalContent = document.getElementById('ukm-modal-content');
            
            // Isi data ke dalam modal
            document.getElementById('modal-ukm-title').innerText = nama;
            document.getElementById('modal-ukm-desc').innerText = deskripsi;
            document.getElementById('modal-ukm-percent').innerText = persen + '%';
            document.getElementById('modal-ukm-img').src = fotoUrl;

            // Tampilkan modal dengan animasi
            modal.style.display = "flex";
            modal.classList.remove('hidden');
            
            // Sedikit delay agar transisi CSS terbaca
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modalContent.classList.remove('scale-95');
                modalContent.classList.add('scale-100');
            }, 10);
        }

        // Fungsi untuk MENUTUP Modal
        function tutupModalUKM() {
            const modal = document.getElementById('ukm-modal');
            const modalContent = document.getElementById('ukm-modal-content');
            
            // Jalankan animasi keluar
            modal.classList.add('opacity-0');
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
            
            // Sembunyikan sepenuhnya setelah animasi selesai (300ms)
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.style.display = "none";
            }, 300);
        }

        // Fungsi untuk menggeser slider motivasi dengan panah
        // Fungsi untuk menggeser slider motivasi
        function slideSearchQuote(direction) {
            const slider = document.getElementById('search-quote-slider');
            // Geser selebar card
            const scrollAmount = slider.clientWidth * 0.70; 
            
            slider.scrollBy({ 
                left: direction * scrollAmount, 
                behavior: 'smooth' 
            });
        }

        
        function exportToPdf() {
            // Pastikan ID 'radarChart' ini benar-benar ada di tag <canvas> kamu ya!
            const canvas = document.getElementById('radarChart'); 

            if (canvas) {
                const base64Image = canvas.toDataURL('image/png');
                
                // NAMA ID SUDAH DISAMAKAN: chart_image_input
                document.getElementById('chart_image_input').value = base64Image;
                
                document.getElementById('exportPdfForm').submit();
            } else {
                alert('Grafik belum termuat sempurna, silakan tunggu sebentar.');
            }
        }
        

        // ==========================================
        // 2. EKSEKUSI SAAT HALAMAN SELESAI DIMUAT
        // ==========================================
        document.addEventListener('DOMContentLoaded', function() {
            
            // A. Panggil filter default (Putri)
            showUKM('putri');

            // B. Render Radar Chart
            const detailSkor = @json($detailSkor);
            
            // Memisahkan nama kategori dan nilainya untuk grafik
            const labels = Object.keys(detailSkor);
            const dataSkor = Object.values(detailSkor);

            const ctx = document.getElementById('radarChart').getContext('2d');
            new Chart(ctx, {
                type: 'radar',
                data: {
                    labels: {!! json_encode(array_keys($chartSkor)) !!},
                    datasets: [{
                        // label: 'Skor Bakat (%)',
                        data: {!! json_encode(array_values($chartSkor)) !!},
                        backgroundColor: 'rgba(59, 130, 246, 0.2)', // Warna bg-blue-500 transparan
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 2,
                        pointBackgroundColor: 'rgba(59, 130, 246, 1)'
                    }]
                },
                options: {
                    // 1. TAMBAHKAN PADDING DI SINI 👇
                    layout: {
                        padding: 40 // Memberikan jarak 40px di sekeliling chart biar teks aman
                    },
                    plugins: {
                        legend: {
                            display: false 
                        }
                    },
                    scales: {
                        r: {
                            min: 0,
                            max: 100,
                            ticks: { 
                                stepSize: 50,
                                display: false
                            },
                            // 2. PASTIKAN TYPO 'poinLabels' SUDAH DIUBAH JADI 'pointLabels' 👇
                            pointLabels: {
                                font: {
                                    size: 11 // Kita kecilin dikit dari 14 ke 11 biar lebih rapi dan elegan
                                },
                                color: '#4b5563'
                            }
                        }
                    }
                }
            });
        });
    </script>


</x-layouts.app>