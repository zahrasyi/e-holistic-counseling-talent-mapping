<x-layouts.app>
    <div class="p-8 min-h-[70vh]">
        <div class="max-w-6xl mx-auto">
            
            <!-- Header Halaman -->
            <div class="mb-10 text-center md:text-left">
                <h2 class="text-2xl font-bold mb-2" style="color: #34538c">
                    <i class="fas fa-history mr-2"></i> Riwayat & Hasil
                </h2>
                <p class="text-slate-500 text-sm">Pilih kategori di bawah ini untuk melihat seluruh riwayat pengisian dan perkembangan Anda.</p>
            </div>

            <!-- Grid 4 Card -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- CARD 1: PENELUSURAN -->
                <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 relative overflow-hidden group">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white font-bold text-xl" style="background-color: #34538c;">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3 class="text-xl font-bold ml-4 text-slate-800">Penelusuran</h3>
                    </div>
                    <p class="text-slate-500 mb-6 text-sm">Lihat riwayat hasil tes penelusuran bakat yang pernah Anda kerjakan.</p>
                    <a href="{{ route('talent.history.penelusuran') }}" style="color: #34538c;" class="inline-block text-sm font-bold text-[#5b83d7] ...">
                        Lihat Riwayat <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>

                <!-- CARD 2: REFLEKSI -->
                <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 relative overflow-hidden group">
                   
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white font-bold text-xl bg-teal-600">
                            <i class="fas fa-brain"></i>
                        </div>
                        <h3 class="text-xl font-bold ml-4 text-slate-800">Refleksi</h3>
                    </div>
                    <p class="text-slate-500 mb-6 text-sm">Pantau riwayat catatan refleksi dan evaluasi diri Anda secara berkala.</p>
                    <a href="{{ route('talent.history.refleksi') }}" style="color: #0d9488;" class="inline-block text-sm font-bold hover:opacity-80 transition-opacity">
                        Lihat Riwayat <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>

                <!-- CARD 3: PENGEMBANGAN (APTITUDE) -->
                <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 relative overflow-hidden group">
                    
                    <div class="flex items-center mb-4">
                        <!-- Ganti bagian kotak icon Pengembangan yang kosong dengan ini -->
                        <div class="flex items-center justify-center w-12 h-12 rounded-lg" style="background-color: #8b5cf6; color: #ffffff;">
                            <i class="fas fa-chart-line text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold ml-4 text-slate-800">Pengembangan</h3>
                    </div>
                    <p class="text-slate-500 mb-6 text-sm">Cek kembali seluruh hasil tes pengembangan Aptitude Anda dari waktu ke waktu.</p>
                    <a href="{{ route('talent.history.pengembangan') }}" style="color: #8b5cf6;" class="inline-block text-sm font-bold hover:text-purple-800 transition-colors">
                        Lihat Riwayat <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>

                <!-- CARD 4: PORTOFOLIO -->
                <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 relative overflow-hidden group">
                   
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white font-bold text-xl bg-orange-500">
                            <i class="fas fa-folder-open"></i>
                        </div>
                        <h3 class="text-xl font-bold ml-4 text-slate-800">Portofolio</h3>
                    </div>
                    <p class="text-slate-500 mb-6 text-sm">Lihat arsip dan rekam jejak bukti karya yang pernah Anda unggah.</p>
                    <a href="{{ route('talent.history.portofolio') }}" style="color: #DD6B20;" class="inline-block text-sm font-bold hover:text-orange-700 transition-colors">
                        Lihat Riwayat <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>