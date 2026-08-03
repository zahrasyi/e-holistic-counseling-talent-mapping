<x-layouts.app>
    <style>
        /* Efek saat kotak radio dipilih (checked) */
        .radio-input:checked + .radio-label {
            border-color: #5b75a6;
            background-color: #eff6ff; 
        }
        .radio-input:checked + .radio-label .radio-circle {
            border-color: #5b75a6;
        }
        .radio-input:checked + .radio-label .radio-dot {
            display: block; 
        }
        .radio-input:checked + .radio-label .radio-text {
            color: #5b75a6;
            /* font-weight: 700; Font jadi bold saat dipilih */
        }
    
        /* Efek saat kotak radio disorot mouse (hover) */
        .radio-label:hover {
            border-color: #5b75a6;
            background-color: #eff6ff;
        }
        .radio-label:hover .radio-circle {
            border-color: #5b75a6;
        }
        .radio-label:hover .radio-text {
            color: #5b75a6;
        }
    </style>
   
    <div id="view-portofolio" class="p-8">
        @if($page==1)
            <div class="text-sm text-[#5b75a6] mb-6 flex items-center space-x-1 font-medium">
                <a href="#" class="hover:underline">Talent</a>
                <i class="fas fa-chevron-right text-[10px] mx-1"></i>
                <a href="{{ route('talent.development') }}" class="hover:underline">Development Stage</a>
                <i class="fas fa-chevron-right text-[10px] mx-1"></i>
                <a href="#" class="hover:underline">Portofolio</a>
            </div>
            
            <div class="bg-white rounded-3xl border border-gray-200 p-8 mb-8 shadow-sm">
                <h2 class="text-xl font-bold" style="color: #345593;"><i class="fas fa-folder-open mr-2"></i> Penilaian Portofolio Bakat</h2>
                <p class="text-sm text-slate-700">Tahap ini dirancang untuk mendokumentasikan riwayat pengalaman nyata Anda. <b>Catatan Penting:</b> Pertanyaan yang membutuhkan bukti (evidence) akan memunculkan tombol upload jika Anda menjawab dengan skor (2-5).</p>
                <p class="text-sm text-slate-700 mt-3 font-semibold bg-yellow-50 border-yellow-200 p-4 rounded-2xl">
                    <i class="fas fa-info-circle text-yellow-600 mr-2"></i>Petunjuk: Isi kolom sesuai pengalaman, bukti karya, dan tingkat penguasaan (skala 1–5). 
                </p>
            </div>
        @endif    
    
        <div id="mulai-kuesioner" class="text-center mb-6 pt-4">
            <h3 class="text-xl font-bold" style="color: #345593;"><span class="text-[#345593]">({{ $page }} dari 5)</span> Kuesioner Portofolio</h3>
        </div>
    
        <form action="{{ route('talent.portofolio.save') }}" method="POST" enctype="multipart/form-data" class="max-w-5xl mx-auto mb-8">
            @csrf
            <input type="hidden" name="page" value="{{ $page }}">
    
            <div class="space-y-6">
                @foreach($questions as $nomorSoal => $data)
                    @php
                        $isEvidence = $data['type'] == 'evidence';
                        $existingScore = isset($existingAnswers[$nomorSoal]) ? $existingAnswers[$nomorSoal]->skor : null;
                        $existingFile = isset($existingAnswers[$nomorSoal]) ? $existingAnswers[$nomorSoal]->file_path : null;
                    @endphp
    
                    <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-6 md:p-8 question-card transition-all hover:shadow-md">
                        <div class="flex justify-between items-start mb-5">
                            <p class="text-slate-800 text-base leading-relaxed pr-4"><span class="text-[#5b75a6] mr-1">{{ $nomorSoal }}.</span> {{ $data['q'] }}</p>
                            
                            @if($isEvidence)
                                <span class="bg-yellow-50 text-yellow-700 border border-yellow-200 text-xs font-bold px-4 py-1.5 rounded-full whitespace-nowrap shadow-sm">
                                    <i class="fas fa-paperclip mr-1"></i> Butuh Bukti
                                </span>
                            @else
                                <span class="bg-green-50 text-green-700 border border-green-200 text-xs font-bold px-4 py-1.5 rounded-full whitespace-nowrap shadow-sm">
                                    <i class="fas fa-user-check mr-1"></i> Perilaku
                                </span>
                            @endif
                        </div>
    
                        <div class="flex flex-wrap gap-4 mt-5">
                            @php
                                $labels = ['Belum Pernah', 'Pernah sekali', 'Cukup sering', 'Sering dan aktif', 'Sangat sering'];
                            @endphp
                            
                            @foreach(range(1, 5) as $val)
                                @php
                                    $uniqueId = 'q' . $nomorSoal . '_' . $val;
                                @endphp
    
                                <div class="w-fit">
                                    <input
                                        type="radio"
                                        id="{{ $uniqueId }}"
                                        name="answers[{{ $nomorSoal }}][skor]"
                                        value="{{ $val }}"
                                        required
                                        class="radio-input sr-only"
                                        {{ $existingScore == $val ? 'checked' : '' }}
                                        onchange="toggleUpload({{ $nomorSoal }}, {{ $val }}, '{{ $data['type'] }}')">
    
                                    <label
                                        for="{{ $uniqueId }}"
                                        class="radio-label relative flex items-center px-6 gap-3 h-14 rounded-full border border-gray-300 bg-white cursor-pointer transition-all duration-200 min-w-160 w-fit">
    
                                        <div class="radio-circle w-5 h-5 rounded-full border-2 border-gray-400 flex items-center justify-center shrink-0 transition-colors duration-200">
                                            <div class="radio-dot hidden w-2.5 h-2.5 rounded-full bg-[#5b75a6]"></div>
                                        </div>
    
                                        <span class="radio-text text-sm text-gray-700 whitespace-nowrap transition-colors duration-200">
                                            {{ $val }}. {{ $labels[$val-1] }}
                                        </span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
    
                        @if($isEvidence)
                            <div id="upload-div-{{ $nomorSoal }}" class="mt-5 p-5 bg-blue-50/50 border border-blue-100 rounded-2xl transition-all duration-300 {{ ($existingScore && $existingScore >= 2) ? '' : 'hidden' }}">
                                <label class="block text-sm font-bold text-[#455a82] mb-2">
                                    <i class="fas fa-cloud-upload-alt mr-1"></i> Upload Bukti Pendukung (Maks 2MB)
                                </label>
                                <input type="file" 
                                       name="answers[{{ $nomorSoal }}][file]" 
                                       accept="image/*,.pdf"
                                       class="block w-full text-sm text-slate-500
                                              file:mr-4 file:py-2.5 file:px-5
                                              file:rounded-full file:border-0
                                              file:text-sm file:font-bold
                                              file:bg-[#5b75a6] file:text-white
                                              hover:file:bg-[#455a82] transition-all cursor-pointer">
                                
                                @if($existingFile)
                                    <div class="mt-3 bg-green-50 text-green-700 border border-green-200 p-2.5 rounded-xl text-xs font-semibold inline-block">
                                        <i class="fas fa-check-circle mr-1"></i> File sudah tersimpan. (Pilih file baru jika ingin mengganti)
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
    
            <div class="flex justify-between items-center mt-10 pb-8 w-full">
    
                <div>
                    @if($page > 1)
                        <a href="{{ route('talent.portofolio', ['page' => $page - 1]) }}" 
                           class="inline-flex items-center bg-white border-2 border-gray-200 hover:bg-gray-50 text-slate-700 px-8 py-3 rounded-2xl text-sm font-bold transition-all shadow-sm">
                            <i class="fas fa-arrow-left mr-2"></i> Sebelumnya
                        </a>
                    @endif
                </div>
            
                <div>
                    @if($page < 5)
                        <button type="submit" class="inline-flex items-center bg-blue-700 hover:bg-blue-800 text-white px-10 py-3 p-4 rounded-2xl text-sm font-bold transition-all shadow-lg hover:shadow-xl hover:-translate-y-1">
                            Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    @else
                        <button type="submit" class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white px-10 py-3 p-4 rounded-2xl text-sm font-bold transition-all shadow-lg hover:shadow-xl hover:-translate-y-1">
                            Kirim & Evaluasi <i class="fas fa-paper-plane ml-2"></i>
                        </button>
                    @endif
                </div>
            </div>
        </form>
    </div>
    
    <script>
        // Logika buka-tutup upload (Hanya ngurusin tombol upload sekarang, warna sudah diurus CSS di atas)
        function toggleUpload(nomorSoal, skor, type) {
            if (type === 'evidence') {
                const uploadDiv = document.getElementById('upload-div-' + nomorSoal);
                if (uploadDiv) {
                    if (skor >= 2) {
                        uploadDiv.classList.remove('hidden');
                    } else {
                        uploadDiv.classList.add('hidden');
                    }
                }
            }
        }
    
        // Efek Auto-Scroll yang mulus
        document.addEventListener('DOMContentLoaded', function() {
            // Cari semua input radio
            const radioInputs = document.querySelectorAll('.radio-input');
            
            radioInputs.forEach(input => {
                input.addEventListener('change', function() {
                    // Cari kotak pertanyaan saat ini (ancestor terdekat dengan class 'question-card')
                    const currentCard = this.closest('.question-card');
                    
                    // Cari kotak pertanyaan berikutnya
                    const nextCard = currentCard.nextElementSibling;
                    
                    // Jika ada kotak pertanyaan berikutnya, scroll ke sana
                    if (nextCard && nextCard.classList.contains('question-card')) {
                        // Kasih jeda sedikit (300ms) biar user bisa lihat efek warna biru pas nge-klik
                        setTimeout(() => {
                            nextCard.scrollIntoView({ 
                                behavior: 'smooth', 
                                block: 'center' // Posisikan kotak di tengah layar
                            });
                        }, 300);
                    }
                });
            });
        });
    </script>
</x-layouts.app>