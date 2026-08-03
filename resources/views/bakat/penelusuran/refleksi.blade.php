<x-layouts.app>
    <div class="min-h-screen bg-[#f4f7fc] py-10 px-4 sm:px-6 lg:px-8 font-sans">
        <div class="max-w-7xl mx-auto">
            
            {{-- Card Header & Petunjuk --}}
            <div class="bg-white rounded-2xl border-blue-100 p-6 md:p-8 mb-8 shadow-sm relative overflow-hidden">
                
                <div class="relative z-10">
                    <div class="flex items-center space-x-3 mb-3">
                        <h2 class="text-xl md:text-xl font-bold" style="color: #34538c">Kuesioner Refleksi Pribadi</h2>
                        {{-- <span id="refleksi-title" class="text-sm font-semibold text-blue-600 bg-blue-50 border border-blue-200 px-3 py-1 rounded-full"></span> --}}
                    </div>
                    </div>
                    <p class="text-slate-600 leading-relaxed text-sm md:text-base">
                        Petunjuk: Jawablah dengan jujur sesuai kondisi hati dan diri Anda saat ini. Tahap ini bertujuan memetakan kesadaran, niat ikhlas, dan orientasi spiritual Anda terhadap bakat yang dikaruniakan oleh Allah SWT. 
                    </p>
                </div>
            </div>

            {{-- Kontainer Pertanyaan --}}
            <div id="refleksi-container" class="space-y-5 mb-10">
                </div>

            {{-- Indikator Titik (Dots) --}}
            <div id="refleksi-dots" class="flex justify-center items-center space-x-2 mb-10">
                <div class="w-3 h-3 rounded-full bg-[#34538c] transition-all duration-300"></div>
                <div class="w-3 h-3 rounded-full bg-blue-200 transition-all duration-300"></div>
            </div>
            
            {{-- Tombol Navigasi --}}
            <div class="flex justify-between items-center border-t border-gray-200 pt-8">
                <button id="btn-prev-ref" onclick="prevRefleksiPage()" class="hidden bg-white border border-gray-300 hover:bg-gray-50 text-slate-700 px-6 py-3 rounded-xl text-sm font-bold transition-all shadow-sm">
                    <i class="fas fa-arrow-left mr-2"></i> Sebelumnya
                </button>
                
                <div class="grow"></div> <button id="btn-next-ref" onclick="nextRefleksiPage()" class="bg-blue-700 hover:bg-blue-400 text-white px-8 py-3 rounded-xl text-sm font-bold transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                </button>

                <button id="btn-submit-ref" onclick="submitRefleksi()" class="hidden bg-blue-700 hover:bg-blue-400 text-white px-8 py-3 rounded-xl text-sm font-bold transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    Kirim Refleksi 
                </button>
            </div>

        </div>
    </div>

    <style>
        /* Styling khusus agar sesuai dengan Kuesioner Penelusuran */
        .radio-pill input:checked + div {
            background-color: #eff6ff; /* blue-50 */
            border-color: #3b82f6; /* blue-500 */
           
        }
        
        .radio-pill input:checked + div .radio-circle {
            border-color: #3b82f6;
            background-color: white;
            position: relative;
        }
        
        .radio-pill input:checked + div .radio-circle::after {
            content: '';
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: #3b82f6;
            border-radius: 50%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    
        .radio-pill input:checked + div span {
            color: #1e40af; /* text-blue-800 */
            font-weight: 500;
        }
    </style>
    
    <script>
        // --- 20 Pertanyaan Refleksi Pribadi ---
        const pertanyaanRefleksi = [
        "Saya menyadari bidang yang paling saya kuasai (kesadaran potensi).",
        "Saya senang melakukan aktivitas di mana saya unggul (kenikmatan kompetensi).",
        "Saya terus mengasah kemampuan alami yang saya miliki (pengembangan diri).",
        "Saya mengenali bakat sebagai anugerah Allah yang harus disyukuri (syukur).",
        "Saya berusaha menjadikan bakat saya sebagai amal saleh (niat ikhlas).",
        "Saya mampu menyesuaikan bakat dengan kebutuhan umat (orientasi sosial).",
        "Saya tidak mudah putus asa saat bakat saya belum diakui (keteguhan).",
        "Saya sering merenung tentang tujuan bakat saya dalam hidup (refleksi spiritual).",
        "Saya mencari bimbingan agar bakat saya berkembang benar (tawadhu dan belajar).",
        "Saya berdoa agar Allah menuntun saya menggunakan bakat dengan benar (petunjuk Ilahi)."
        ];
    
        const questionsPerPage = 10;
        let currentPage = 1;
        let answers = {}; 
    
        const skalaTeks = [
            { nilai: 1, teks: "Tidak Pernah" },
            { nilai: 2, teks: "Jarang" },
            { nilai: 3, teks: "Kadang-kadang" },
            { nilai: 4, teks: "Sering" },
            { nilai: 5, teks: "Selalu" }
        ];
    
        function renderQuestions() {
            const container = document.getElementById('refleksi-container');
            container.innerHTML = ''; 

            const startIndex = (currentPage - 1) * questionsPerPage;
            const endIndex = Math.min(startIndex + questionsPerPage, pertanyaanRefleksi.length);

            for (let i = startIndex; i < endIndex; i++) {
                const questionNumber = i + 1;
                const questionText = pertanyaanRefleksi[i];
                
                const optionsHTML = skalaTeks.map(opsi => {
                    const isChecked = answers[i] === opsi.nilai ? 'checked' : '';
                    return `
                        <label class="radio-pill cursor-pointer flex-1">
                            <input type="radio" name="q${i}" value="${opsi.nilai}" class="hidden" onclick="saveAnswer(${i}, ${opsi.nilai})" ${isChecked}>
                            <div class="flex items-center border border-gray-200 rounded-full py-2 px-3 transition-all duration-200 hover:border-blue-300 hover:bg-slate-50 w-full h-full">
                                <div class="radio-circle w-4 h-4 border border-gray-300 rounded-full mr-2 flex-shrink-0 transition-colors"></div>
                                <span class="text-[14px] xl:text-sm text-slate-600 whitespace-nowrap">${opsi.nilai}. ${opsi.teks}</span>
                            </div>
                        </label>
                    `;
                }).join('');

                const questionCard = `
                    <div class="bg-white p-6 md:p-8 rounded-2xl border border-gray-100 shadow-sm mb-5">
                        <p class="font-semibold text-lg text-slate-800 mb-5">
                            ${questionNumber}. ${questionText}
                        </p>
                        
                        <div class="flex flex-col md:flex-row gap-2 lg:gap-3 overflow-x-auto pb-2">
                            ${optionsHTML}
                        </div>
                    </div>
                `;
                
                // Nah, baris di bawah ini yang kemungkinan tadi ikut terhapus!
                container.innerHTML += questionCard;
            }

            updateUI();
        }
        
    
        function saveAnswer(questionIndex, value) {
            answers[questionIndex] = value;
            
            // --- Tambahkan kode ini agar otomatis scroll ke pertanyaan berikutnya ---
            const nextIndex = questionIndex + 1;
            // Kita beri sedikit delay agar user sempat melihat jawaban mereka terpilih (warna biru berubah)
            setTimeout(() => {
                const nextElement = document.querySelector(`[name="q${nextIndex}"]`);
                if (nextElement) {
                    // Mencari card pembungkus pertanyaan berikutnya
                    nextElement.closest('.bg-white').scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'center' 
                    });
                }
            }, 300); // delay 300ms
        }
    
        function nextRefleksiPage() {
            if (currentPage * questionsPerPage < pertanyaanRefleksi.length) {
                currentPage++;
                window.scrollTo({ top: 0, behavior: 'smooth' });
                renderQuestions();
            }
        }
    
        function prevRefleksiPage() {
            if (currentPage > 1) {
                currentPage--;
                window.scrollTo({ top: 0, behavior: 'smooth' });
                renderQuestions();
            }
        }

        function updateUI() {
            const totalPages = Math.ceil(pertanyaanRefleksi.length / questionsPerPage);
            
            // Atur titik-titik indikator (dots)
            const dotsContainer = document.getElementById('refleksi-dots');
            if (dotsContainer) {
                dotsContainer.innerHTML = '';
                for (let i = 1; i <= totalPages; i++) {
                    const bgClass = (i === currentPage) ? 'bg-[#34538c] w-6' : 'bg-blue-200 w-3';
                    dotsContainer.innerHTML += `<div class="h-3 rounded-full transition-all duration-300 ${bgClass}"></div>`;
                }
            }
    
            // Ambil elemen tombol
            const btnPrev = document.getElementById('btn-prev-ref');
            const btnNext = document.getElementById('btn-next-ref');
            const btnSubmit = document.getElementById('btn-submit-ref');

            // Atur tombol Sebelumnya
            if (currentPage === 1) {
                btnPrev.classList.add('hidden');
            } else {
                btnPrev.classList.remove('hidden');
            }
            
            // Atur tombol Selanjutnya vs Kirim
            if (currentPage === totalPages) {
                btnNext.classList.add('hidden');
                btnSubmit.classList.remove('hidden');
            } else {
                btnNext.classList.remove('hidden');
                btnSubmit.classList.add('hidden');
            }
        }
    
        function submitRefleksi() {
            // 1. SATPAM VALIDASI: Cek apakah jumlah jawaban sudah pas 10
            const totalAnswers = Object.keys(answers).length;
            if(totalAnswers < pertanyaanRefleksi.length) {
                // Kalau kurang, munculkan peringatan dan STOP prosesnya di sini!
                alert('Eits, tunggu dulu! Mohon jawab seluruh pertanyaan sebelum mengirim refleksi Anda.');
                return; 
            }
    
            // 2. PROSES PENGIRIMAN: Kalau sudah lolos satpam, ubah tombol jadi loading
            const btn = document.getElementById('btn-submit-ref');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Mengirim...';
            
            // Hitung total skor
            let totalScore = 0;
            for (let key in answers) {
                totalScore += parseInt(answers[key]);
            }

            // Bikin form rahasia untuk ngirim data ke controller
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ url('/talent/hitung-refleksi') }}";

            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);

            const scoreInput = document.createElement('input');
            scoreInput.type = 'hidden';
            scoreInput.name = 'total_skor';
            scoreInput.value = totalScore;
            form.appendChild(scoreInput);

            // Langsung kirim! (Tanpa alert 'berhasil' karena Laravel yang akan mindahin halamannya)
            document.body.appendChild(form);
            form.submit(); 
        }
        
    
        document.addEventListener('DOMContentLoaded', () => {
            renderQuestions();
        });
    </script>
</x-layouts.app>