<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PortofolioAnswer;
use App\Models\KuesionerSoal;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\TalentResult;
use App\Models\TalentAnswer;
use Illuminate\Support\Facades\Auth;


class TalentController extends Controller
{
    // penelusuran
    public function searchStage(Request $request)
    {
        // 1. Ambil nomor halaman dari URL (default halaman 1)
        $page = $request->query('page', 1);
        
        // 2. Karena ada 60 soal dan 4 halaman, berarti 15 soal per halaman
        $perPage = 15; 
        
        // 3. Hitung offset untuk penomoran
        $offset = ($page - 1) * $perPage;

        // 4. Hitung TOTAL HALAMAN secara dinamis
        $totalQuestions = KuesionerSoal::where('tipe_kuesioner', 'penelusuran')->count();
        $totalPages = ceil($totalQuestions / $perPage);

        // 5. Ambil soal dari database sesuai halamannya
        $currentQuestions = KuesionerSoal::where('tipe_kuesioner', 'penelusuran')
            ->skip($offset)
            ->take($perPage)
            ->get();

        // 6. Cek jika halaman tidak valid (misal user iseng ngetik page=5)
        if ($currentQuestions->isEmpty()) {
            return redirect()->route('talent.search', ['page' => 1]);
        }

        // 7. Lempar semua data ke halaman Blade (tambahkan 'totalPages' di sini)
        return view('bakat.penelusuran.penelusuran', compact('currentQuestions', 'page', 'offset', 'totalPages'));
    }
    
    public function showPenelusuran()
    {
        // Mengambil semua soal penelusuran dan mengelompokkannya berdasarkan kategori bakat
        $soals = KuesionerSoal::where('tipe_kuesioner', 'penelusuran')
                              ->get()
                              ->groupBy('kategori_bakat');

        // Mengirim data $soals ke halaman blade
        return view('bakat.penelusuran.penelusuran', compact('soals'));
    }

    public function saveStage(Request $request)
    {
        // 1. Ambil data dari form
        $page = $request->input('page');
        $jawabanBaru = $request->input('jawaban', []); // Isinya array: [id_soal => nilai]

        // 2. Ambil data jawaban lama dari Session (jika ada) dan gabungkan dengan jawaban baru
        $sessionAnswers = session('answers', []);
        foreach ($jawabanBaru as $id_soal => $nilai) {
            $sessionAnswers[$id_soal] = $nilai;
        }
        // Simpan kembali ke Session
        session(['answers' => $sessionAnswers]);

        // 3. Cek apakah ini belum halaman terakhir (Halaman 1-3)
        if ($page < 4) {
            // Arahkan ke halaman selanjutnya
            return redirect()->route('talent.search', ['page' => $page + 1]);
        } 
        
        // ==========================================
        // JIKA INI HALAMAN 4 (TERAKHIR), SIMPAN KE DATABASE!
        // ==========================================
        else {
            // A. Simpan ke Tabel Induk (TalentResult)
            // Note: kategori_dominan & skor_cf sementara kosong, nanti kita update setelah rumus CF jalan
            $result = \App\Models\TalentResult::create([
                'user_id' => auth::id(), // Mengambil ID Mahasiswa yang sedang login
                'tipe_kuesioner' => 'penelusuran',
            ]);

            // B. Simpan ke Tabel Anak (TalentAnswer)
            // Kita looping seluruh 60 jawaban yang ada di Session
            foreach ($sessionAnswers as $id_soal => $nilai) {
                
                // FILTERING: Pastikan id_soal benar-benar sebuah angka (bukan teks seperti 'page' atau '_token')
                if (is_numeric($id_soal)) {
                    \App\Models\TalentAnswer::create([
                        'talent_result_id' => $result->id,
                        'kuesioner_soal_id' => $id_soal,
                        'nilai_jawaban' => $nilai,
                    ]);
                }
                
            }

            // =========================================================
            // C. PROSES PERHITUNGAN CERTAINTY FACTOR (CF)
            // =========================================================
            
            $answers = \App\Models\TalentAnswer::with('soal')
                ->where('talent_result_id', $result->id)
                ->get();

            $semuaKategori = \App\Models\KuesionerSoal::where('tipe_kuesioner', 'penelusuran')
                ->select('kategori_bakat')
                ->distinct()
                ->pluck('kategori_bakat');

            $kategoriScores = [];
            foreach ($semuaKategori as $kategori) {
                $kategoriScores[$kategori] = 0; // Default 0
            }

            $groupedAnswers = $answers->groupBy(function($item) {
                return $item->soal->kategori_bakat;
            });

            foreach ($groupedAnswers as $kategori => $items) {
                $cfGabungan = 0;
                
                foreach ($items as $index => $item) {
                    $cfUser = 0;
                    switch ($item->nilai_jawaban) {
                        case 5: $cfUser = 1.0; break;
                        case 4: $cfUser = 0.8; break;
                        case 3: $cfUser = 0.5; break;
                        case 2: $cfUser = 0.2; break;
                        case 1: $cfUser = 0.0; break;
                    }

                    $cfGejala = $item->soal->cfp * $cfUser;

                    if ($index == 0) {
                        $cfGabungan = $cfGejala;
                    } else {
                        $cfGabungan = $cfGabungan + $cfGejala * (1 - $cfGabungan);
                    }
                }
                
                $kategoriScores[$kategori] = round($cfGabungan * 100, 2); 
            }
    
            arsort($kategoriScores); 
            $kategoriDominan = array_key_first($kategoriScores); 
            $skorTertinggi = $kategoriScores[$kategoriDominan]; 

            $result->update([
                'kategori_dominan' => $kategoriDominan,
                'skor_cf_tertinggi' => $skorTertinggi,
                'detail_skor' => json_encode($kategoriScores) 
            ]);

            // C. Bersihkan Session
            session()->forget('answers');

            return redirect()->route('talent.hasil')->with('success', 'Kuesioner berhasil diselesaikan!');
        }
    }

    // Tambahkan "Request $request" di dalam kurung
    public function hasil(Request $request) 
    {
        // 1. Ambil hasil tes (Cek apakah ada ID dari URL riwayat)
        if ($request->has('id') && $request->id != '') {
            // Jika diakses dari klik "Lihat" di halaman Riwayat
            $hasilTerbaru = \App\Models\TalentResult::where('id', $request->id)
                            ->where('user_id', Auth::id())
                            ->first();
        } else {
            // Jika diakses biasa dari menu (ambil Penelusuran paling terakhir)
            $hasilTerbaru = \App\Models\TalentResult::where('user_id', Auth::id())
                            ->where('tipe_kuesioner', 'penelusuran') // <-- Filter spesifik Penelusuran
                            ->latest()
                            ->first();
        }

        // Mencegah error jika data kosong
        if (!$hasilTerbaru) {
            return redirect()->back()->with('error', 'Data hasil penelusuran tidak ditemukan.');
        }
                        
        // 2. Ubah JSON detail skor kembali menjadi Array
        $detailSkor = [];
        if ($hasilTerbaru && $hasilTerbaru->detail_skor) {
            $detailSkor = json_decode($hasilTerbaru->detail_skor, true) ?? [];
        }

        $chartSkor = $detailSkor; 
        ksort($chartSkor); // ksort akan mengurutkan array berdasarkan abjad nama bakatnya

        // 3. Urutkan dari skor terbesar (Ini tetap dipertahankan untuk teks Juara/Ranking)
        if (!empty($detailSkor)) {
            arsort($detailSkor);
        }

        // 4. Data Top Bakat & Bakat Terendah
        $topBakat = $detailSkor; 
        $bakatTerendah = [];
        
        if (!empty($detailSkor)) {
            $namaTerendah = array_key_last($detailSkor);
            $skorTerendah = $detailSkor[$namaTerendah];
            
            $bakatTerendah = [
                'nama' => $namaTerendah,
                'skor' => $skorTerendah
            ];
        } else {
            $bakatTerendah = ['nama' => '-', 'skor' => 0];
        }

        // =========================================================
        // 5. PERHITUNGAN CF UNTUK REKOMENDASI UKM 
        // =========================================================
        
        $semuaUkm = \App\Models\Ukm::all();
        $rekomendasiPutra = [];
        $rekomendasiPutri = [];

        foreach ($semuaUkm as $ukm) {
            $cfKombinasi = [];

            // Memetakan nilai user ke bobot UKM berdasarkan urutan H01-H15
            $cfKombinasi[] = (($detailSkor['Bakat Kepemimpinan'] ?? 0) / 100) * $ukm->h01;
            $cfKombinasi[] = (($detailSkor['Bakat Akademik & Intelektual'] ?? 0) / 100) * $ukm->h02;
            $cfKombinasi[] = (($detailSkor['Bakat Seni & Estetika'] ?? 0) / 100) * $ukm->h03;
            $cfKombinasi[] = (($detailSkor['Bakat Bahasa & Komunikasi'] ?? 0) / 100) * $ukm->h04;
            $cfKombinasi[] = (($detailSkor['Bakat Organisasi & Manajerial'] ?? 0) / 100) * $ukm->h05;
            $cfKombinasi[] = (($detailSkor['Bakat Sosial & Pelayanan'] ?? 0) / 100) * $ukm->h06;
            $cfKombinasi[] = (($detailSkor['Bakat Olahraga & Kesehatan Jasmani'] ?? 0) / 100) * $ukm->h07;
            $cfKombinasi[] = (($detailSkor['Bakat Teknologi & Digital'] ?? 0) / 100) * $ukm->h08;
            $cfKombinasi[] = (($detailSkor['Bakat Negosiasi & Diplomasi'] ?? 0) / 100) * $ukm->h09;
            $cfKombinasi[] = (($detailSkor['Bakat Spiritual & Dakwah'] ?? 0) / 100) * $ukm->h10;
            $cfKombinasi[] = (($detailSkor['Bakat Inovasi & Teknokratik'] ?? 0) / 100) * $ukm->h11;
            $cfKombinasi[] = (($detailSkor['Bakat Penelitian & Keilmuan'] ?? 0) / 100) * $ukm->h12;
            $cfKombinasi[] = (($detailSkor['Bakat Kepedulian Sosial & Kemanusiaan'] ?? 0) / 100) * $ukm->h13;
            $cfKombinasi[] = (($detailSkor['Bakat Bisnis & Kewirausahaan'] ?? 0) / 100) * $ukm->h14;
            $cfKombinasi[] = (($detailSkor['Bakat Mandiri & Ketahanan Diri'] ?? 0) / 100) * $ukm->h15;

            // Rumus Gabungan CF UKM
            $cfAkhirUkm = 0;
            foreach ($cfKombinasi as $cfItem) {
                if ($cfItem > 0) { 
                    if ($cfAkhirUkm == 0) {
                        $cfAkhirUkm = $cfItem; 
                    } else {
                        $cfAkhirUkm = $cfAkhirUkm + ($cfItem * (1 - $cfAkhirUkm));
                    }
                }
            }

            // Ubah menjadi persentase untuk view
            $persentaseUkm = round($cfAkhirUkm * 100, 2);

            $gambarUkm = $ukm->gambar ? $ukm->gambar : 'img/default-ukm.png'; 

            $dataUkmView = [
                'UKM' => $ukm->nama_ukm,
                'deskripsi' => $ukm->deskripsi,
                'gambar' => $gambarUkm,
                'persen' => $persentaseUkm
            ];

            // Filter Kategori (Putri / Putra)
            $kategoriUkm = strtoupper($ukm->kategori);
            if (str_contains($kategoriUkm, 'PUTRI') && !str_contains($kategoriUkm, 'PUTRA')) {
                $rekomendasiPutri[] = $dataUkmView;
            } elseif (str_contains($kategoriUkm, 'PUTRA') && !str_contains($kategoriUkm, 'PUTRI')) {
                $rekomendasiPutra[] = $dataUkmView;
            } else { 
                $rekomendasiPutra[] = $dataUkmView;
                $rekomendasiPutri[] = $dataUkmView;
            }
        }

        // Urutkan dari persen kecocokan tertinggi
        usort($rekomendasiPutra, fn($a, $b) => $b['persen'] <=> $a['persen']);
        usort($rekomendasiPutri, fn($a, $b) => $b['persen'] <=> $a['persen']);

        // Ambil 3 UKM Teratas
        $rekomendasiPutra = array_slice($rekomendasiPutra, 0, 3);
        $rekomendasiPutri = array_slice($rekomendasiPutri, 0, 3);

        // 6. Lempar SEMUA variabel ke halaman Blade
        return view('bakat.penelusuran.hasil', compact(
            'hasilTerbaru', 
            'detailSkor', 
            'chartSkor',
            'topBakat', 
            'bakatTerendah', 
            'rekomendasiPutra', 
            'rekomendasiPutri'
        ));
    }

    public function exportPdf(Request $request, $id)
    {
        $hasilTes = \App\Models\TalentResult::findOrFail($id); 
        $userLogin = \Illuminate\Support\Facades\Auth::user();

        // 1. Ambil Skor dari Database & Urutkan dari Tertinggi
        $detailSkor = json_decode($hasilTes->detail_skor, true) ?? [];
        if (!empty($detailSkor)) {
            arsort($detailSkor); 
        }

        // 2. Ambil 3 Bakat Teratas dan 3 Bakat Terendah
        $top3Bakat = array_slice($detailSkor, 0, 3, true);
        
        $bottom3Bakat = array_slice($detailSkor, -3, 3, true);
        asort($bottom3Bakat);

        // 3. Hitung Rekomendasi UKM untuk Putra dan Putri
        $semuaUkm = \App\Models\Ukm::all();
        $rekomendasiPutra = [];
        $rekomendasiPutri = [];

        foreach ($semuaUkm as $ukm) {
            $cfKombinasi = [
                (($detailSkor['Bakat Kepemimpinan'] ?? 0) / 100) * $ukm->h01,
                (($detailSkor['Bakat Akademik & Intelektual'] ?? 0) / 100) * $ukm->h02,
                (($detailSkor['Bakat Seni & Estetika'] ?? 0) / 100) * $ukm->h03,
                (($detailSkor['Bakat Bahasa & Komunikasi'] ?? 0) / 100) * $ukm->h04,
                (($detailSkor['Bakat Organisasi & Manajerial'] ?? 0) / 100) * $ukm->h05,
                (($detailSkor['Bakat Sosial & Pelayanan'] ?? 0) / 100) * $ukm->h06,
                (($detailSkor['Bakat Olahraga & Kesehatan Jasmani'] ?? 0) / 100) * $ukm->h07,
                (($detailSkor['Bakat Teknologi & Digital'] ?? 0) / 100) * $ukm->h08,
                (($detailSkor['Bakat Negosiasi & Diplomasi'] ?? 0) / 100) * $ukm->h09,
                (($detailSkor['Bakat Spiritual & Dakwah'] ?? 0) / 100) * $ukm->h10,
                (($detailSkor['Bakat Inovasi & Teknokratik'] ?? 0) / 100) * $ukm->h11,
                (($detailSkor['Bakat Penelitian & Keilmuan'] ?? 0) / 100) * $ukm->h12,
                (($detailSkor['Bakat Kepedulian Sosial & Kemanusiaan'] ?? 0) / 100) * $ukm->h13,
                (($detailSkor['Bakat Bisnis & Kewirausahaan'] ?? 0) / 100) * $ukm->h14,
                (($detailSkor['Bakat Mandiri & Ketahanan Diri'] ?? 0) / 100) * $ukm->h15,
            ];

            $cfAkhirUkm = 0;
            foreach ($cfKombinasi as $cfItem) {
                if ($cfItem > 0) { 
                    if ($cfAkhirUkm == 0) {
                        $cfAkhirUkm = $cfItem; 
                    } else {
                        $cfAkhirUkm = $cfAkhirUkm + ($cfItem * (1 - $cfAkhirUkm));
                    }
                }
            }

            $persen = round($cfAkhirUkm * 100, 2);
            $dataUkm = [
                'nama_ukm' => $ukm->nama_ukm,
                'deskripsi' => $ukm->deskripsi,
                'persen' => $persen
            ];

            $kategoriUkm = strtoupper($ukm->kategori);
            
            if (str_contains($kategoriUkm, 'PUTRI') && !str_contains($kategoriUkm, 'PUTRA')) {
                $rekomendasiPutri[] = $dataUkm;
            } elseif (str_contains($kategoriUkm, 'PUTRA') && !str_contains($kategoriUkm, 'PUTRI')) {
                $rekomendasiPutra[] = $dataUkm;
            } else { 
                $rekomendasiPutra[] = $dataUkm;
                $rekomendasiPutri[] = $dataUkm;
            }
        }

        // Urutkan dan Ambil 3 Teratas
        usort($rekomendasiPutra, fn($a, $b) => $b['persen'] <=> $a['persen']);
        usort($rekomendasiPutri, fn($a, $b) => $b['persen'] <=> $a['persen']);
        
        $topUkmPutra = array_slice($rekomendasiPutra, 0, 3);
        $topUkmPutri = array_slice($rekomendasiPutri, 0, 3);

        // 4. CEK NAMA
        $namaPencetak = $userLogin->name ?? $userLogin->nama ?? $userLogin->nama_lengkap ?? 'Nama Tidak Terdeteksi';

        // 5. Gabungkan Semua Data
        $data = [
            'nama_user' => $namaPencetak,
            'chart_image' => $request->input('chart_image'),
            'detailSkor' => $detailSkor,
            'top3Bakat' => $top3Bakat,
            'bottom3Bakat' => $bottom3Bakat,
            'rekomendasiPutra' => $topUkmPutra,
            'rekomendasiPutri' => $topUkmPutri
        ];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.export_penelusuran', $data);
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('Hasil_Tes_Bakat.pdf');
    }

    public function refleksi()
    {
        // Memanggil halaman refleksi
        // Pastikan letak file refleksi.blade.php kamu ada di folder: resources/views/bakat/penelusuran/
        return view('bakat.penelusuran.refleksi');
    }

    public function hitungRefleksi(\Illuminate\Http\Request $request)
    {
        // 1. Ambil skor dari form (JavaScript)
        $skor = $request->input('total_skor');
        
        // 2. Wajib: Simpan dulu ke Database!
        $simpanRefleksi = \App\Models\TalentResult::create([
            'user_id'           => \Illuminate\Support\Facades\Auth::id(),
            'tipe_kuesioner'    => 'refleksi',
            'skor_cf_tertinggi' => $skor, // Kita titip total skor di kolom ini
            'kategori_dominan'  => 'Selesai Refleksi'
        ]);

        // 3. Lemparkan user ke halaman hasil, dan bawa ID riwayat yang baru saja dibuat
        return redirect('/talent/hasil-refleksi?id=' . $simpanRefleksi->id);
    }

    public function hasilRefleksi(\Illuminate\Http\Request $request)
    {
        // 1. Cek apakah ada ID dari URL riwayat (saat tombol mata diklik)
        if ($request->has('id') && $request->id != '') {
            $hasilTerbaru = \App\Models\TalentResult::where('id', $request->id)
                            ->where('user_id', \Illuminate\Support\Facades\Auth::id())
                            ->first();
        } else {
            // Jika tidak ada ID (biasanya langsung dilempar ke sini setelah klik Submit)
            $hasilTerbaru = \App\Models\TalentResult::where('user_id', \Illuminate\Support\Facades\Auth::id())
                            ->where('tipe_kuesioner', 'refleksi')
                            ->latest()
                            ->first();
        }

        // 2. Jika datanya tidak ada, kembalikan ke halaman sebelumnya
        if (!$hasilTerbaru) {
            return redirect()->back()->with('error', 'Data hasil refleksi tidak ditemukan.');
        }

        // 3. Ambil skor dari kolom yang tadi kita pakai buat nyimpen
        $skor = $hasilTerbaru->skor_cf_tertinggi;

        // 4. Lempar data skornya ke halaman view (menggunakan compact)
        return view('bakat.penelusuran.hasilrefleksi', compact('hasilTerbaru', 'skor'));
    }

    // pengembangan

    public function aptitudeStage(Request $request)
    {
        // 1. Ambil nomor halaman dari URL (default halaman 1)
        $page = $request->query('page', 1);
        
        // 2. Set 15 soal per halaman
        $perPage = 10; 
        
        // 3. Hitung offset untuk penomoran
        $offset = ($page - 1) * $perPage;

        // 4. Hitung TOTAL HALAMAN khusus 'aptitude'
        $totalQuestions = KuesionerSoal::where('tipe_kuesioner', 'aptitude')->count();
        $totalPages = ceil($totalQuestions / $perPage);

        // 5. Ambil soal 'aptitude' dari database
        $currentQuestions = KuesionerSoal::where('tipe_kuesioner', 'aptitude')
            ->skip($offset)
            ->take($perPage)
            ->get();

        // 6. Cek jika halaman tidak valid
        if ($currentQuestions->isEmpty() && $page > 1) {
            // NOTE: Sesuaikan nama route ini dengan route halaman aptitude kamu
            return redirect()->route('talent.pengembangan.hasil', ['page' => 1]); 
        }

        $domainTitles = [
            1 => 'Verbal Aptitude (Bahasa & Komunikasi)',
            2 => 'Numerik Aptitude (Angka & Logika)',
            3 => 'Spasial Aptitude (Visual & Imajinasi)',
            4 => 'Logika & Kreativitas (Problem Solving)',
            5 => 'Sosial, Moral, & Kepemimpinan',
            6 => 'Kemandirian & Ketahanan Diri'
        ];
        $judulDomain = $domainTitles[$page] ?? 'Domain Aptitude';

        // 7. Lempar data ke halaman Blade Aptitude
        return view('bakat.pengembangan.aptitude', compact('currentQuestions', 'page', 'offset', 'totalPages'));
    }

    public function saveAptitudePage(Request $request)
    {
        $page = $request->input('page');
        
        $jawabanBaru = $request->input('jawaban', []); 
        if (empty($jawabanBaru)) {
            $jawabanBaru = $request->except(['_token', 'page']);
        }

        $sessionAnswers = session('answers_aptitude', []);
        foreach ($jawabanBaru as $key => $nilai) {
            $id_soal = str_replace('q', '', $key); 
            $sessionAnswers[$id_soal] = $nilai;
        }
        session(['answers_aptitude' => $sessionAnswers]);

        // KEMBALIKAN KE 6 HALAMAN!
        if ($page < 6) {
            return redirect()->route('talent.development', ['page' => $page + 1]);
        }

        // ==========================================
        // HALAMAN 6 (TERAKHIR): SIMPAN & HITUNG CF
        // ==========================================
        
        $result = \App\Models\TalentResult::create([
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'tipe_kuesioner' => 'aptitude',
        ]);

        foreach ($sessionAnswers as $id_soal => $nilai) {
            if (is_numeric($id_soal)) {
                \App\Models\TalentAnswer::create([
                    'talent_result_id' => $result->id,
                    'kuesioner_soal_id' => $id_soal,
                    'nilai_jawaban' => $nilai,
                ]);
            }
        }

        $answers = \App\Models\TalentAnswer::with('soal')
            ->where('talent_result_id', $result->id)
            ->get();

        $semuaKategori = \App\Models\KuesionerSoal::where('tipe_kuesioner', 'aptitude')
            ->select('kategori_bakat')
            ->distinct()
            ->pluck('kategori_bakat');

        $kategoriScores = [];
        foreach ($semuaKategori as $kategori) {
            $kategoriScores[$kategori] = 0;
        }

        $groupedAnswers = $answers->groupBy(function($item) {
            return $item->soal->kategori_bakat ?? 'Unknown';
        });

        $totalSkorManual = 0; 

        foreach ($groupedAnswers as $kategori => $items) {
            $cfGabungan = 0;
            
            foreach ($items as $index => $item) {
                $cfUser = 0;
                $nilai_jawaban = (int)$item->nilai_jawaban;
                
                $totalSkorManual += $nilai_jawaban; 

                switch ($nilai_jawaban) {
                    case 5: $cfUser = 1.0; break;
                    case 4: $cfUser = 0.8; break;
                    case 3: $cfUser = 0.5; break;
                    case 2: $cfUser = 0.2; break;
                    case 1: $cfUser = 0.0; break;
                }

                $cfp = $item->soal->cfp ?? 0.2; 
                $cfGejala = $cfp * $cfUser;

                if ($index == 0) {
                    $cfGabungan = $cfGejala;
                } else {
                    $cfGabungan = $cfGabungan + $cfGejala * (1 - $cfGabungan);
                }
            }
            $kategoriScores[$kategori] = round($cfGabungan * 100, 2); 
        }

        arsort($kategoriScores); 
        $kategoriDominan = array_key_first($kategoriScores); 
        $skorTertinggi = $kategoriScores[$kategoriDominan] ?? 0; 

        $kategoriScores['TOTAL_RAW_SCORE'] = $totalSkorManual;

        $result->update([
            'kategori_dominan' => $kategoriDominan,
            'skor_cf_tertinggi' => $skorTertinggi,
            'detail_skor' => json_encode($kategoriScores) 
        ]);

        // HAPUS SESSION SETELAH SELESAI AGAR TES BERIKUTNYA MULAI DARI NOL
        session()->forget('answers_aptitude');
        
        return redirect()->route('talent.pengembangan.hasil');
    }

    public function hasilAptitude(\Illuminate\Http\Request $request)
    {
        // 1. Ambil hasil tes (Cek apakah ada ID dari URL riwayat)
        if ($request->has('id') && $request->id != '') {
            // Jika diakses dari klik "Lihat" di halaman Riwayat (berdasarkan ID)
            $hasilTerbaru = \App\Models\TalentResult::where('id', $request->id)
                            ->where('user_id', \Illuminate\Support\Facades\Auth::id())
                            ->first();
        } else {
            // Jika diakses biasa dari menu (ambil Aptitude paling terakhir)
            $hasilTerbaru = \App\Models\TalentResult::where('user_id', \Illuminate\Support\Facades\Auth::id())
                            ->where('tipe_kuesioner', 'aptitude') // Pastikan namanya sesuai dengan database kamu
                            ->latest()
                            ->first();
        }

        // Mencegah error jika data kosong
        if (!$hasilTerbaru) {
            return redirect()->back()->with('error', 'Data hasil pengembangan tidak ditemukan.');
        }

        $domainScores = [];
        $totalSkor = 0;
        $orderedDomains = [];
        $chartDataPercent = [];
        $labels = [];

        if ($hasilTerbaru && $hasilTerbaru->detail_skor) {
            // Decode JSON dari database
            $rawScores = json_decode($hasilTerbaru->detail_skor, true);
            
            // Ambil "titipan" Total Skor, lalu hapus dari array agar tidak ikut masuk tabel
            $totalSkor = $rawScores['TOTAL_RAW_SCORE'] ?? 0;
            unset($rawScores['TOTAL_RAW_SCORE']);

            // 2. LOGIKA BARU: Loop langsung dari data database agar namanya 100% cocok!
            foreach ($rawScores as $kategori => $skor) {
                $orderedDomains[] = $kategori;       // Masukkan ke urutan tabel
                $domainScores[$kategori] = $skor;    // Simpan nilai persentasenya
                
                // Untuk label di Radar Chart, kita ambil kata pertamanya saja (misal: "Spasial")
                $labels[] = explode(' ', trim($kategori))[0]; 
                $chartDataPercent[] = $skor;         // Nilai untuk Radar Chart
            }
        }

        // 3. Ambil data Dominan
        $dominantDomain = $hasilTerbaru->kategori_dominan ?? '-';
        $dominantScore = $hasilTerbaru->skor_cf_tertinggi ?? 0;

        // 4. Penentuan Status berdasarkan Total Skor (Tetap menggunakan Skala 300)
        if ($totalSkor >= 241) {
            $status = "SANGAT TINGGI (UNGGUL)";
            $makna = "Potensi bakat sangat kuat dan siap dikembangkan secara profesional dan spiritual.";
            $warna = "bg-blue-100 text-blue-800";
        } elseif ($totalSkor >= 181) {
            $status = "TINGGI (POTENSIAL)";
            $makna = "Potensi bakat baik, membutuhkan konsistensi latihan dan pembinaan yang terarah.";
            $warna = "bg-green-100 text-green-800";
        } elseif ($totalSkor >= 121) {
            $status = "CUKUP (KEMBANGKAN)";
            $makna = "Potensi mulai terlihat, namun masih memerlukan eksplorasi dan motivasi lebih lanjut.";
            $warna = "bg-yellow-100 text-yellow-800";
        } else {
            $status = "KURANG (EKSPLORASI)";
            $makna = "Perlu pendampingan intensif untuk menemukan dan memantik potensi yang terpendam.";
            $warna = "bg-red-100 text-red-800";
        }

        // 5. Cek Portofolio
        $hasPortfolio = false;
        $portoScore = 0;
        $portoCategory = '';
        
        if (Auth::check()) {
            $evidences = \App\Models\PortofolioAnswer::where('user_id', Auth::id())->get();
            $hasPortfolio = $evidences->count() > 0;

            if ($hasPortfolio) {
                $portoScore = $evidences->sum('skor'); 
                if ($portoScore >= 240) {
                    $portoCategory = "PORTOFOLIO PROFESIONAL ISLAMI";
                } elseif ($portoScore >= 180) {
                    $portoCategory = "PORTOFOLIO BERKEMBANG AKTIF";
                } elseif ($portoScore >= 120) {
                    $portoCategory = "PORTOFOLIO PERLU PENGUATAN";
                } else {
                    $portoCategory = "PERLU PENDAMPINGAN KHUSUS";
                }
            }
        }

        arsort($domainScores);
        
        // 6. Lempar ke View
        return view('bakat.pengembangan.hasil', compact(
            'hasilTerbaru',
            'totalSkor', 'domainScores', 'orderedDomains', 'dominantDomain', 'dominantScore', 
            'chartDataPercent', 'labels', 'status', 'makna', 'warna',
            'hasPortfolio', 'portoScore', 'portoCategory'
        ));
    }

    public function exportPdfAptitude(Request $request, $id)
    {
        $hasilTes = \App\Models\TalentResult::findOrFail($id); 
        $userLogin = \Illuminate\Support\Facades\Auth::user();
        $namaPencetak = $userLogin->name ?? $userLogin->nama ?? $userLogin->nama_lengkap ?? 'Mahasiswa';

        // ==========================================
        // 1. AMBIL DATA APTITUDE
        // ==========================================
        $rawScores = json_decode($hasilTes->detail_skor, true) ?? [];
        $totalSkorAptitude = $rawScores['TOTAL_RAW_SCORE'] ?? 0;
        unset($rawScores['TOTAL_RAW_SCORE']);

        $domainScores = $rawScores;
        arsort($domainScores);

        if ($totalSkorAptitude >= 241) {
            $statusApt = "SANGAT TINGGI (UNGGUL)";
            $maknaApt = "Potensi bakat sangat kuat dan siap dikembangkan secara profesional dan spiritual.";
        } elseif ($totalSkorAptitude >= 181) {
            $statusApt = "TINGGI (POTENSIAL)";
            $maknaApt = "Potensi bakat baik, membutuhkan konsistensi latihan dan pembinaan yang terarah.";
        } elseif ($totalSkorAptitude >= 121) {
            $statusApt = "CUKUP (KEMBANGKAN)";
            $maknaApt = "Potensi mulai terlihat, namun masih memerlukan eksplorasi dan motivasi lebih lanjut.";
        } else {
            $statusApt = "KURANG (EKSPLORASI)";
            $maknaApt = "Perlu pendampingan intensif untuk menemukan dan memantik potensi yang terpendam.";
        }

        // ==========================================
        // 2. AMBIL DATA PORTOFOLIO
        // ==========================================
        $answersPorto = \App\Models\PortofolioAnswer::where('user_id', $userLogin->id)->get();
        $totalScorePorto = $answersPorto->sum('skor');
        $skorAkhirPorto = round(($totalScorePorto / 300) * 100);

        $aspectNames = [
            "Kreativitas & Inovasi", "Analytical Thinking", "Komunikasi & Bahasa", "Numerik & Logika", 
            "Sosial & Kepemimpinan", "Moral & Spiritualitas", "Kemandirian & Self-Mgmt", "Kerjasama & Brotherhood", 
            "Teknologi & Digital", "Kecerdasan Emosional"
        ];
        
        $evidences = $answersPorto->whereNotNull('file_path')->sortBy('nomor_soal');

        if ($skorAkhirPorto >= 85) {
            $kategoriPorto = "SANGAT UNGGUL";
            $maknaPorto = "Potensi bakat sudah tampak nyata dalam karya dan moral; siap menjadi model insan Ilmu-Iman-Amal.";
        } elseif ($skorAkhirPorto >= 70) {
            $kategoriPorto = "BAIK";
            $maknaPorto = "Bakat dan keterampilan telah berkembang baik, butuh pendalaman spiritual dan akademik.";
        } elseif ($skorAkhirPorto >= 55) {
            $kategoriPorto = "CUKUP";
            $maknaPorto = "Sudah menunjukkan potensi, perlu bimbingan dan mentoring terarah.";
        } elseif ($skorAkhirPorto >= 40) {
            $kategoriPorto = "KURANG";
            $maknaPorto = "Perlu motivasi, refleksi diri, dan latihan konsisten berbasis nilai Islam.";
        } else {
            $kategoriPorto = "PERLU PEMBINAAN KHUSUS";
            $maknaPorto = "Perlu pendampingan intensif, motivasi, refleksi diri, dan latihan konsisten.";
        }

        // ==========================================
        // 3. LEMPAR SEMUA DATA KE PDF
        // ==========================================
        $data = [
            'nama_user' => $namaPencetak,
            // Tangkap 2 gambar sekaligus (Aptitude & Porto)
            'chart_aptitude' => $request->input('chart_aptitude'),
            'chart_portofolio' => $request->input('chart_portofolio'),
            
            // Data Aptitude
            'domainScores' => $domainScores,
            'totalSkorAptitude' => $totalSkorAptitude,
            'kategori_dominan_apt' => $hasilTes->kategori_dominan ?? '-',
            'skor_tertinggi_apt' => $hasilTes->skor_cf_tertinggi ?? 0,
            'statusApt' => $statusApt,
            'maknaApt' => $maknaApt,
            
            // Data Portofolio
            'totalScorePorto' => $totalScorePorto,
            'skorAkhirPorto' => $skorAkhirPorto,
            'kategoriPorto' => $kategoriPorto,
            'maknaPorto' => $maknaPorto,
            'evidences' => $evidences,
            'aspectNames' => $aspectNames
        ];

        // Kita pakai satu file blade gabungan
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.export_gabungan', $data);
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('Laporan_Lengkap_Talent.pdf');
    }


    // Kumpulan 60 Soal Portofolio
    private function getPortoQuestions()
    {
        return [
            1 => ['q' => "Saya pernah menciptakan karya baru (artikel, desain, media dakwah, produk kampus).", 'type' => "evidence"],
            2 => ['q' => "Saya menggabungkan ide lintas disiplin ilmu untuk solusi baru.", 'type' => "behavior"],
            3 => ['q' => "Saya memiliki hasil karya yang diakui atau dipublikasikan.", 'type' => "evidence"],
            4 => ['q' => "Saya aktif dalam lomba inovasi atau karya ilmiah.", 'type' => "evidence"],
            5 => ['q' => "Saya berani mencoba hal baru dalam kegiatan kampus.", 'type' => "behavior"],
            6 => ['q' => "Saya menularkan ide kreatif kepada tim atau teman sekelas.", 'type' => "behavior"],
            7 => ['q' => "Saya mampu menulis analisis atau ulasan yang tajam dan argumentatif.", 'type' => "evidence"],
            8 => ['q' => "Saya sering menjadi problem solver dalam kegiatan akademik.", 'type' => "behavior"],
            9 => ['q' => "Saya terbiasa melakukan refleksi atau riset kecil sebelum mengambil keputusan.", 'type' => "behavior"],
            10 => ['q' => "Saya menilai kebenaran informasi berdasarkan sumber ilmiah dan dalil.", 'type' => "behavior"],
            11 => ['q' => "Saya mampu berpikir logis di bawah tekanan.", 'type' => "behavior"],
            12 => ['q' => "Saya menulis gagasan di media ilmiah kampus.", 'type' => "evidence"],
            13 => ['q' => "Saya sering menjadi MC, moderator, atau pemateri.", 'type' => "evidence"],
            14 => ['q' => "Saya dapat berbicara dua bahasa (Arab, Inggris, Indonesia).", 'type' => "evidence"],
            15 => ['q' => "Saya menulis artikel atau konten dakwah berbahasa baik.", 'type' => "evidence"],
            16 => ['q' => "Saya pernah mengikuti lomba pidato, debat, atau menulis esai.", 'type' => "evidence"],
            17 => ['q' => "Saya memahami komunikasi efektif lintas budaya.", 'type' => "behavior"],
            18 => ['q' => "Saya menulis refleksi pribadi setiap pekan.", 'type' => "evidence"],
            19 => ['q' => "Saya melakukan analisis data kuantitatif (penelitian, laporan keuangan, statistik).", 'type' => "evidence"],
            20 => ['q' => "Saya suka permainan atau kegiatan berbasis angka dan strategi.", 'type' => "behavior"],
            21 => ['q' => "Saya menggunakan logika matematis dalam merancang proyek.", 'type' => "behavior"],
            22 => ['q' => "Saya mampu membaca grafik dan tabel dengan cepat.", 'type' => "behavior"],
            23 => ['q' => "Saya membantu teman dalam tugas numerik atau ekonomi.", 'type' => "behavior"],
            24 => ['q' => "Saya memiliki catatan rencana keuangan pribadi.", 'type' => "evidence"],
            25 => ['q' => "Saya memimpin organisasi atau panitia kampus.", 'type' => "evidence"],
            26 => ['q' => "Saya terlibat dalam kegiatan sosial masyarakat.", 'type' => "evidence"],
            27 => ['q' => "Saya menjadi teladan dalam disiplin dan tanggung jawab.", 'type' => "behavior"],
            28 => ['q' => "Saya berpartisipasi aktif dalam kerja tim.", 'type' => "behavior"],
            29 => ['q' => "Saya mampu menyelesaikan konflik secara adil.", 'type' => "behavior"],
            30 => ['q' => "Saya menjadi motivator bagi rekan mahasiswa.", 'type' => "behavior"],
            31 => ['q' => "Saya menjaga kejujuran dalam setiap tugas.", 'type' => "behavior"],
            32 => ['q' => "Saya mengintegrasikan nilai Islam dalam karya ilmiah.", 'type' => "evidence"],
            33 => ['q' => "Saya menjadi panitia kegiatan keagamaan kampus.", 'type' => "evidence"],
            34 => ['q' => "Saya berinovasi dalam bidang dakwah atau layanan masyarakat.", 'type' => "evidence"],
            35 => ['q' => "Saya melakukan muhasabah dan menulis nilai hidup Islami.", 'type' => "behavior"],
            36 => ['q' => "Saya membaca dan mengkaji tafsir atau hadis secara rutin.", 'type' => "behavior"],
            37 => ['q' => "Saya membuat jadwal belajar pribadi dan menepatinya.", 'type' => "evidence"],
            38 => ['q' => "Saya berani mengambil keputusan hidup sendiri.", 'type' => "behavior"],
            39 => ['q' => "Saya konsisten dalam target akademik dan ibadah.", 'type' => "behavior"],
            40 => ['q' => "Saya memiliki portofolio karya individu (video, artikel, desain).", 'type' => "evidence"],
            41 => ['q' => "Saya mampu menyeimbangkan antara belajar dan ibadah.", 'type' => "behavior"],
            42 => ['q' => "Saya mampu beradaptasi di lingkungan baru.", 'type' => "behavior"],
            43 => ['q' => "Saya aktif dalam kegiatan ukhuwah dan silaturahmi mahasiswa.", 'type' => "evidence"],
            44 => ['q' => "Saya terbiasa menolong teman tanpa pamrih.", 'type' => "behavior"],
            45 => ['q' => "Saya menulis pesan motivasi Islami di grup atau media sosial.", 'type' => "evidence"],
            46 => ['q' => "Saya menjadi mediator ketika terjadi konflik di kelompok.", 'type' => "behavior"],
            47 => ['q' => "Saya ikut serta dalam program bakti sosial kampus.", 'type' => "evidence"],
            48 => ['q' => "Saya membangun hubungan lintas prodi dan angkatan.", 'type' => "behavior"],
            49 => ['q' => "Saya mampu menggunakan AI atau aplikasi digital dalam pembelajaran.", 'type' => "evidence"],
            50 => ['q' => "Saya pernah membuat media digital (video, desain, e-book Islami).", 'type' => "evidence"],
            51 => ['q' => "Saya memahami etika penggunaan teknologi dalam Islam.", 'type' => "behavior"],
            52 => ['q' => "Saya membantu dosen/teman dalam proyek berbasis teknologi.", 'type' => "evidence"],
            53 => ['q' => "Saya belajar mandiri melalui platform digital.", 'type' => "behavior"],
            54 => ['q' => "Saya memiliki akun akademik digital dengan hasil karya.", 'type' => "evidence"],
            55 => ['q' => "Saya mampu mengendalikan emosi dalam perbedaan pendapat.", 'type' => "behavior"],
            56 => ['q' => "Saya berempati terhadap kesulitan orang lain.", 'type' => "behavior"],
            57 => ['q' => "Saya menerima kritik dengan lapang dada.", 'type' => "behavior"],
            58 => ['q' => "Saya menjaga ketenangan ketika ditekan.", 'type' => "behavior"],
            59 => ['q' => "Saya memahami perasaan orang lain dengan bijak.", 'type' => "behavior"],
            60 => ['q' => "Saya membiasakan doa sebelum dan sesudah aktivitas.", 'type' => "behavior"]
        ];
    }

    // Menampilkan Halaman Kuesioner Portofolio
    // Memanggil Halaman Kuesioner Portofolio
    public function portofolioStage(Request $request)
    {
        $page = $request->query('page', 1);
        $perPage = 12;
        $allQuestions = $this->getPortoQuestions();
        
        // Ambil 12 soal sesuai halaman saat ini
        $offset = ($page - 1) * $perPage;
        $questions = array_slice($allQuestions, $offset, $perPage, true); // true = pertahankan nomor kunci (key)

        // Ambil jawaban sebelumnya dari database (jika user pernah mengisi lalu menekan 'kembali')
        $existingAnswers = PortofolioAnswer::where('user_id', $request->user()->id)
                            ->whereIn('nomor_soal', array_keys($questions))
                            ->get()
                            ->keyBy('nomor_soal');

        return view('bakat.pengembangan.portofolio', compact('page', 'questions', 'existingAnswers'));
    }

    // Menyimpan Jawaban per Halaman
    public function savePortofolioPage(Request $request)
    {
        $page = $request->input('page');
        $answers = $request->input('answers', []); // Ambil array jawaban
        $allQuestions = $this->getPortoQuestions();

        foreach ($answers as $nomorSoal => $data) {
            $skor = $data['skor'] ?? null;
            if (!$skor) continue; // Skip jika kosong

            $kategori = $allQuestions[$nomorSoal]['type'];
            $filePath = null;

            // Jika kategori Evidence dan skor >= 2, cek apakah ada file yang diupload
            if ($kategori == 'evidence' && $skor >= 2) {
                if ($request->hasFile("answers.{$nomorSoal}.file")) {
                    $file = $request->file("answers.{$nomorSoal}.file");
                    // Simpan file ke folder storage/app/public/portofolio_bukti
                    $filePath = $file->store('portofolio_bukti', 'public');
                } else {
                    // Coba cek apa sudah ada file lama di DB jika user tidak upload ulang
                    $oldAnswer = PortofolioAnswer::where('user_id', $request->user()->id)->where('nomor_soal', $nomorSoal)->first();
                    if ($oldAnswer) {
                        $filePath = $oldAnswer->file_path;
                    }
                }
            }

            // Simpan atau Update ke Database (Satu baris per soal)
            PortofolioAnswer::updateOrCreate(
                [
                    'user_id' => $request->user()->id,
                    'nomor_soal' => $nomorSoal
                ],
                [
                    'kategori' => $kategori,
                    'skor' => $skor,
                    'file_path' => $filePath
                ]
            );
        }

        // Lanjut ke halaman berikutnya atau ke halaman hasil
        if ($page < 5) {
            return redirect()->route('talent.portofolio', ['page' => $page + 1]);
        }

        return redirect()->route('talent.portofolio.hasil');
    }

    // Menampilkan Hasil & Evaluasi Portofolio
    public function hasilPortofolio(Request $request)
    {
        // Ambil semua jawaban user ini
        $answers = PortofolioAnswer::where('user_id', $request->user()->id)->get();
        
        // 1. Hitung Total Skor
        $totalScore = $answers->sum('skor');

        // 2. Daftar 10 Aspek
        $aspectNames = [
            "Kreativitas & Inovasi", "Analytical Thinking", "Komunikasi & Bahasa", "Numerik & Logika", 
            "Sosial & Kepemimpinan", "Moral & Spiritualitas", "Kemandirian & Self-Mgmt", "Kerjasama & Brotherhood", 
            "Teknologi & Digital", "Kecerdasan Emosional"
        ];

        // 3. Hitung Skor per Aspek (Karena 1 aspek = 6 soal)
        $aspectScores = array_fill(0, 10, 0); 
        foreach ($answers as $ans) {
            $index = (int) floor(($ans->nomor_soal - 1) / 6);
            if(isset($aspectScores[$index])) {
                $aspectScores[$index] += $ans->skor;
            }
        }

        // 4. Ambil khusus jawaban yang ada file upload-nya
        $evidences = $answers->whereNotNull('file_path')->sortBy('nomor_soal');

        // 5. Tentukan Kategori Berdasarkan Skor
        $skorAkhir = round(($totalScore / 300) * 100);

        if ($skorAkhir >= 85) {
            $kategori = "SANGAT UNGGUL";
            $makna = "Potensi bakat sudah tampak nyata dalam karya dan moral; siap menjadi model insan Ilmu-Iman-Amal.";
        } elseif ($skorAkhir >= 70) {
            $kategori = "BAIK";
            $makna = "Bakat dan keterampilan telah berkembang baik, butuh pendalaman spiritual dan akademik.";
        } elseif ($skorAkhir >= 55) {
            $kategori = "CUKUP";
            $makna = "Sudah menunjukkan potensi, perlu bimbingan dan mentoring terarah.";
        } elseif ($skorAkhir >= 40) {
            $kategori = "KURANG";
            $makna = "Perlu motivasi, refleksi diri, dan latihan konsisten berbasis nilai Islam.";
        } else {
            $kategori = "PERLU PEMBINAAN KHUSUS";
            $makna = "Perlu pendampingan intensif, motivasi, refleksi diri, dan latihan konsisten.";
        }

        return view('bakat.pengembangan.hasilporto', compact(
            'totalScore', 'skorAkhir', 'aspectNames', 'aspectScores', 'evidences', 'kategori', 'makna'
        ));
    }

    // Fungsi untuk menampilkan halaman utama History (4 Card)
    public function history()
    {
        return view('bakat.history.index');
    }

    public function historyPenelusuran(Request $request)
    {
        // Menggunakan model TalentResult dan filter kolom tipe_kuesioner
        $query = \App\Models\TalentResult::where('user_id', Auth::id())
                                        ->where('tipe_kuesioner', 'penelusuran');

        // Filter berdasarkan tanggal jika ada input dari user
        if ($request->has('tanggal') && $request->tanggal != '') {
            $query->whereDate('created_at', $request->tanggal);
        }

        $riwayat = $query->latest()->get();

        return view('bakat.history.penelusuran', compact('riwayat'));
    }

    public function historyRefleksi(\Illuminate\Http\Request $request)
    {
        // 1. Kita ambil data milik user yang sedang login, khusus tipe 'refleksi'
        $query = \App\Models\TalentResult::where('user_id', \Illuminate\Support\Facades\Auth::id())
                                         ->where('tipe_kuesioner', 'refleksi'); 

        // 2. Filter tanggal (kalau user nyari lewat kotak filter)
        if ($request->has('tanggal') && $request->tanggal != '') {
            $query->whereDate('created_at', $request->tanggal);
        }

        // 3. Ambil datanya dan urutkan dari yang paling baru (latest)
        $riwayat = $query->latest()->get();

        // 4. Lempar data $riwayat ini ke halaman tabel
        return view('bakat.history.refleksi', compact('riwayat'));
    }

    public function historyPengembangan(Request $request)
    {
        // Ganti 'pengembangan' dengan nama yang sesuai di kolom tipe_kuesioner database-mu
        $query = \App\Models\TalentResult::where('user_id', Auth::id())
                                         ->where('tipe_kuesioner', 'aptitude'); 

        // Filter berdasarkan tanggal jika ada input dari user
        if ($request->has('tanggal') && $request->tanggal != '') {
            $query->whereDate('created_at', $request->tanggal);
        }

        $riwayat = $query->latest()->get();

        return view('bakat.history.pengembangan', compact('riwayat'));
    }

    public function historyPortofolio(Request $request)
    {
        // Ambil semua jawaban portofolio milik user yang sedang login
        $answers = PortofolioAnswer::where('user_id', $request->user()->id)->get();
        $riwayat = collect(); // Siapkan wadah kosong

        if ($answers->count() > 0) {
            // Ambil tanggal kapan terakhir kali user submit portofolio
            $latestUpdate = $answers->max('updated_at');

            // Hitung total skor untuk menentukan Kategori (Sama seperti di hasilPortofolio)
            $totalScore = $answers->sum('skor');
            $skorAkhir = round(($totalScore / 300) * 100);

            if ($skorAkhir >= 85) {
                $kategori = "SANGAT UNGGUL";
            } elseif ($skorAkhir >= 70) {
                $kategori = "BAIK";
            } elseif ($skorAkhir >= 55) {
                $kategori = "CUKUP";
            } elseif ($skorAkhir >= 40) {
                $kategori = "KURANG";
            } else {
                $kategori = "PERLU PEMBINAAN KHUSUS";
            }

            // Logika untuk tombol Filter Tanggal
            $tampil = true;
            if ($request->has('tanggal') && $request->tanggal != '') {
                $filterDate = \Carbon\Carbon::parse($request->tanggal)->format('Y-m-d');
                $recordDate = \Carbon\Carbon::parse($latestUpdate)->format('Y-m-d');
                if ($filterDate !== $recordDate) {
                    $tampil = false;
                }
            }

            // Masukkan datanya ke dalam wadah jika lolos filter
            if ($tampil) {
                $riwayat->push([
                    'tanggal' => \Carbon\Carbon::parse($latestUpdate)->format('d M Y, H:i'),
                    'kategori' => 'Portofolio Kategori: ' . $kategori
                ]);
            }
        }

        return view('bakat.history.portofolio', compact('riwayat'));
    }


}