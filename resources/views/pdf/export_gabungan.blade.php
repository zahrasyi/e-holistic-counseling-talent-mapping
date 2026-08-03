<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Lengkap Pengembangan</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; color: #333; line-height: 1.4; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { color: #2c448e; margin: 0; text-transform: uppercase; font-size: 16px;}
        .page-break { page-break-after: always; } 
        
        .section-title { font-size: 13px; color: #2c448e; border-bottom: 2px solid #2c448e; padding-bottom: 4px; margin-top: 15px; margin-bottom: 10px; font-weight: bold; }
        
        /* CSS Aptitude */
        .layout-table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        .layout-table td { vertical-align: top; }
        .chart-col { width: 50%; text-align: center; padding-right: 15px; }
        .score-col { width: 50%; padding-left: 15px; }
        .chart-image { width: 100%; max-width: 280px; height: auto; }
        .score-table { width: 100%; border-collapse: collapse; font-size: 10px; }
        .score-table th, .score-table td { border: 1px solid #ddd; padding: 5px; text-align: left; }
        .score-table th { background-color: #2c448e; color: white; text-align: center; }
        .score-table td.center { text-align: center; }
        .box { background-color: #f8faff; border: 1px solid #cdd8f6; padding: 10px; margin-bottom: 10px; border-radius: 5px; }
        
        /* CSS Portofolio */
        .score-container { width: 100%; border-collapse: collapse; margin-bottom: 20px; text-align: center; }
        .score-container td { padding: 10px; vertical-align: middle; }
        .box-mentah, .box-akhir { border: 1px solid #cdd8f6; border-radius: 8px; padding: 15px; background-color: #fff; }
        .score-title { font-size: 10px; color: #64748b; font-weight: bold; text-transform: uppercase; }
        .score-number { font-size: 28px; font-weight: bold; color: #0f172a; margin: 5px 0; }
        .badge { display: inline-block; background-color: #e0e7ff; color: #3730a3; font-weight: bold; padding: 4px 10px; border-radius: 12px; font-size: 10px; margin-bottom: 5px; }
        .chart-box { border: 1px solid #cdd8f6; padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center;}
        
        /* CSS Badge PDF untuk Berkas */
        .pdf-badge { display: inline-block; background-color: #f8fafc; border: 1px solid #cbd5e1; color: #334155; padding: 4px 10px; border-radius: 15px; font-size: 9px; margin-right: 5px; margin-bottom: 5px; font-weight: bold;}
    </style>
</head>
<body>

    <!-- ============================================== -->
    <!-- HALAMAN 1: HASIL APTITUDE                      -->
    <!-- ============================================== -->
    <div class="header">
        <h2>Laporan Hasil Tes Aptitude</h2>
        <p style="margin: 3px 0;">Pengembangan Kompetensi Dasar</p>
        <hr style="border: 0; border-top: 2px solid #2c448e; width: 60%; margin: 8px auto;">
        <p style="text-align: left; margin-top: 15px; font-size: 12px;"><strong>Nama Mahasiswa:</strong> {{ $nama_user }}</p>
    </div>

    <table class="layout-table">
        <tr>
            <td class="chart-col">
                @if(!empty($chart_aptitude))
                    <img src="{{ $chart_aptitude }}" class="chart-image" alt="Grafik Aptitude">
                @else
                    <div style="padding: 50px; border: 1px dashed #ccc; margin-top: 30px;">Grafik belum dimuat</div>
                @endif
            </td>
            <td class="score-col">
                <table class="score-table">
                    <thead>
                        <tr>
                            <th>Domain Aptitude</th>
                            <th width="25%">Persen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            // Mengurutkan dan mencari nilai terendah
                            $sortedDomains = $domainScores;
                            arsort($sortedDomains);
                            $nilaiTerendah = min($sortedDomains);
                        @endphp

                        @foreach($sortedDomains as $domain => $skor)
                            @php
                                $isDominant = ($domain == $kategori_dominan_apt);
                                $isLowest = ($skor == $nilaiTerendah);
                                
                                // Warna & Style dsesuaikan
                                $color = $isDominant ? '#1d4ed8' : ($isLowest ? '#ef4444' : '#333');
                                $weight = ($isDominant || $isLowest) ? 'bold' : 'normal';
                                $bg = $isDominant ? '#eff6ff' : ($isLowest ? '#fef2f2' : '#fff');
                            @endphp
                            <tr style="background-color: {{ $bg }};">
                                <td style="color: {{ $color }}; font-weight: {{ $weight }};">{{ $domain }}</td>
                                <td class="center" style="color: {{ $color }}; font-weight: {{ $weight }};">{{ $skor }}%</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td style="text-align: right; font-weight: bold;">TOTAL SKOR:</td>
                            <td class="center" style="background-color: #f1f5f9; font-weight: bold;">{{ $totalSkorAptitude }}</td>
                        </tr>
                    </tfoot>
                </table>
            </td>
        </tr>
    </table>

    <div class="section-title">Kesimpulan & Interpretasi Aptitude</div>
    <div class="box">
        <strong style="color: #2c448e; font-size: 12px;">Status: {{ $statusApt }}</strong>
        <p style="margin-top: 5px;">{{ $maknaApt }}</p>
        <p style="margin-top: 10px; margin-bottom: 0;">Kekuatan dominan Anda terletak pada <strong>{{ $kategori_dominan_apt }}</strong>.</p>
    </div>

    <!-- ============================================== -->
    <!-- HALAMAN 2: HASIL PORTOFOLIO                    -->
    <!-- ============================================== -->

    <div class="header mb-2">
        <h2>Laporan Penilaian Portofolio</h2>
        <p style="margin: 3px 0;">Rekapitulasi Bukti Karya & Evaluasi</p>
        <hr style="border: 0; border-top: 2px solid #2c448e; width: 60%; margin: 8px auto;">
    </div>

    <!-- KITA GANTI SUSUNAN KOTAK SKORNYA JADI SEPERTI INI -->
    <table style="width: 100%; border-collapse: separate; border-spacing: 15px 0; margin-bottom: 20px; text-align: center;">
        <tr>
            <!-- KOTAK KIRI -->
            <td style="width: 35%; border: 1px solid #cdd8f6; border-radius: 8px; background-color: #fff; vertical-align: middle; padding: 15px;">
                <div class="score-title">Total Skor Mentah</div>
                <div class="score-number">{{ $totalScorePorto }}</div>
                <div style="font-size: 10px; color: #94a3b8;">Maksimal: 300 Poin</div>
            </td>
            
            <!-- KOTAK KANAN -->
            <td style="width: 65%; border: 1px solid #cdd8f6; border-radius: 8px; background-color: #fff; vertical-align: middle; padding: 15px;">
                <div class="score-title" style="color: #3b82f6;">Skor Akhir Validasi</div>
                <div class="score-number">{{ $skorAkhirPorto }}</div>
                <div class="badge">{{ $kategoriPorto }}</div>
                <div style="font-size: 10px; color: #475569; margin-top: 5px;">{{ $maknaPorto }}</div>
            </td>
        </tr>
    </table>

    <div class="chart-box">
        <div class="section-title" style="border: none; margin: 0 0 10px 0;">Grafik Distribusi Bukti per Aspek</div>
        @if(!empty($chart_portofolio))
        <img src="{{ $chart_portofolio }}" alt="Grafik Portofolio" width="460" style="display: block; margin: 0 auto;">
        @else
            <div style="padding: 20px; color: #94a3b8;">Grafik Portofolio tidak dilampirkan</div>
        @endif
    </div>
    <div class="page-break"></div>
    <div class="section-title">Rekap Bukti Karya (Evidence) yang Diunggah</div>
    
    @php
        // Mengelompokkan berkas seperti di tampilan web
        $groupedEvidences = [];
        foreach($evidences as $evidence) {
            $indexAspek = (int) floor(($evidence->nomor_soal - 1) / 6);
            $namaAspek = $aspectNames[$indexAspek] ?? 'Aspek Lainnya';
            $groupedEvidences[$namaAspek][] = $evidence;
        }
    @endphp

    <div style="margin-top: 10px;">
        @forelse($groupedEvidences as $aspek => $items)
            <div style="margin-bottom: 15px;">
                <div style="font-size: 10px; font-weight: bold; color: #475569; text-transform: uppercase; margin-bottom: 5px;">{{ $aspek }}</div>
                
                <!-- Teknik Float agar badge menyamping dengan rapi di PDF -->
                <div style="overflow: hidden;">
                    @foreach($items as $item)
                        <div style="float: left; background-color: #f8fafc; border: 1px solid #cbd5e1; color: #334155; padding: 4px 8px; border-radius: 8px; font-size: 9px; font-weight: bold; margin-right: 6px; margin-bottom: 6px;">
                            [PDF] Berkas No. {{ $item->nomor_soal }}
                        </div>
                    @endforeach
                    <!-- Clear float agar layout tidak berantakan -->
                    <div style="clear: both;"></div> 
                </div>

            </div>
        @empty
            <p style="text-align: center; color: #64748b; font-style: italic;">Belum ada berkas karya yang diunggah.</p>
        @endforelse
    </div>

</body>
</html>