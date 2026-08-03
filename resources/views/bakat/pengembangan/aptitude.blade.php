<x-layouts.app>
    <div class="max-w-7xl mx-auto py-8 px-6">
    
        @if($page == 1)
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 mb-6">
                <h3 class="text-xl font-bold mb-2" style="color: #345593">
                    Tes Aptitude & Potensi Bakat
                </h3>
                <p class="text-sm text-gray-700">
                    Petunjuk: Bacalah setiap pernyataan dengan saksama dan pilih jawaban yang paling sesuai dengan diri Anda. Tidak ada jawaban benar atau salah, sehingga isilah sesuai dengan kondisi yang sebenarnya. 
                </p>
            </div>
        @endif

        <div class=" p-6 mb-6 text-center">
            @php
                // Daftar nama domain sesuai halaman
                $domainTitles = [
                    1 => 'Verbal Aptitude (Kemampuan Bahasa & Komunikasi)',
                    2 => 'Numerik Aptitude (Kemampuan Berpikir Angka & Logika Matematis)',
                    3 => 'Spasial Aptitude (Kemampuan Visual & Imajinasi Ruang)',
                    4 => 'Logika, Kreativitas, & Analisis (Kognitif & Problem Solving)',
                    5 => 'Sosial, Moral, & Kepemimpinan (Soft Skill & Nilai Islami)',
                    6 => 'Kemandirian, Ketahanan Mental & Keseimbangan Diri (Self-Management)'
                ];
                $currentTitle = $domainTitles[$page] ?? 'Tes Aptitude';
            @endphp
    
            <h2 class="text-xl font-bold" style="color: #345593;">
               Halaman {{ $page }} dari {{ $totalPages }} Tes: {{ $currentTitle }}
            </h2>
            
        </div>
    
        <!-- Ubah route action sesuai dengan nama route simpan di web.php nanti -->
        <form action="{{ route('talent.pengembangan.save') }}" method="POST">
            @csrf
            
            <input type="hidden" name="page" value="{{ $page }}">
        
            <!-- Pindahkan style ke luar loop agar lebih ringan dimuat (best practice) -->
            <style>
                /* Efek saat kotak radio dipilih (checked) */
                .radio-input:checked + .radio-label {
                    border-color: #5b75a6;
                    background-color: #eff6ff; /* Ini sama dengan bg-blue-50 */
                }
                .radio-input:checked + .radio-label .radio-circle {
                    border-color: #5b75a6;
                }
                .radio-input:checked + .radio-label .radio-dot {
                    display: block; /* Memunculkan titik biru */
                }
                .radio-input:checked + .radio-label .radio-text {
                    color: #5b75a6;
                    font-weight: 500;
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
        
            @foreach($currentQuestions as $index => $question)
        
                @php
                    $number = $offset + $loop->iteration;
                    // Mengubah pencarian session berdasarkan ID database
                    $savedAnswer = session('answers')[$question->id] ?? null;
                @endphp
        
                <div class="question-card bg-white rounded-2xl border border-gray-200 shadow-sm p-6 mb-6">
        
                    <p class="font-medium mb-4">
                        <!-- Memanggil kolom 'pernyataan' dari database -->
                        {{ $number }}. {{ $question->pernyataan }}
                    </p>
        
                    @php
                        $options = [
                            1 => 'Sangat Tidak Setuju',
                            2 => 'Tidak Setuju',
                            3 => 'Ragu-ragu',
                            4 => 'Setuju',
                            5 => 'Sangat Setuju',
                        ];
                    @endphp
        
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-3 mt-4">
        
                        @foreach($options as $value => $label)
                            
                            @php
                                // Membuat ID unik menggunakan ID soal dari database
                                $uniqueId = 'q' . $question->id . '_' . $value;
                            @endphp
        
                            <div>
                                <input
                                    type="radio"
                                    id="{{ $uniqueId }}"
                                    name="jawaban[{{ $question->id }}]" 
                                    value="{{ $value }}"
                                    required
                                    class="radio-input sr-only"
                                    {{ $savedAnswer == $value ? 'checked' : '' }}>
        
                                <label
                                    for="{{ $uniqueId }}"
                                    class="radio-label relative flex items-center px-4 gap-3
                                        w-full h-14
                                        rounded-full
                                        border border-gray-300
                                        bg-white
                                        cursor-pointer
                                        transition-all duration-200">
        
                                    <div
                                        class="radio-circle w-5 h-5 rounded-full border-2 border-gray-400
                                            flex items-center justify-center shrink-0
                                            transition-colors duration-200">
        
                                        <div
                                            class="radio-dot hidden
                                                w-2.5 h-2.5 rounded-full bg-blue-700">
                                        </div>
        
                                    </div>
        
                                    <span class="radio-text text-gray-700 whitespace-nowrap transition-colors duration-200">
                                        {{ $value }}. {{ $label }}
                                    </span>
        
                                </label>
                            </div>
        
                        @endforeach
                    </div>
        
                </div>
        
            @endforeach
        
            <div class="flex justify-between mt-8">
        
                @if($page > 1)
                    <a
                        href="{{ route('talent.development',['page'=>$page-1]) }}"
                        class="bg-gray-500 text-white px-6 py-3 rounded-xl">
                        Sebelumnya
                    </a>
                @else
                    <div></div>
                @endif
            
                <button
                    type="submit"
                    class="text-white bg-blue-700 px-8 py-3 rounded-xl transition-opacity hover:opacity-90">
                    {{ $page == 6 ? 'Simpan & Lihat Hasil' : 'Selanjutnya' }}
                </button>
            
            </div>
        </form>
    </div>

    <script>
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