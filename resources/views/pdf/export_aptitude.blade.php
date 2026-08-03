<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Hasil Aptitude</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; color: #333; line-height: 1.4; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { color: #2c448e; margin: 0; text-transform: uppercase; font-size: 16px;}
        .layout-table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        .layout-table td { vertical-align: top; }
        .chart-col { width: 50%; text-align: center; padding-right: 15px; }
        .score-col { width: 50%; padding-left: 15px; }
        .chart-image { width: 100%; max-width: 280px; height: auto; }
        .score-table { width: 100%; border-collapse: collapse; font-size: 10px; }
        .score-table th, .score-table td { border: 1px solid #ddd; padding: 5px; text-align: left; }
        .score-table th { background-color: #2c448e; color: white; text-align: center; }
        .score-table td.center { text-align: center; font-weight: bold; }
        
        .section-title { font-size: 13px; color: #2c448e; border-bottom: 2px solid #2c448e; padding-bottom: 4px; margin-top: 15px; margin-bottom: 10px; font-weight: bold; }
        
        .box { background-color: #f8faff; border: 1px solid #cdd8f6; padding: 10px; margin-bottom: 10px; border-radius: 5px; }
        .porto-box { background-color: #f0fdf4; border: 1px solid #bbf7d0; padding: 10px; border-radius: 5px; margin-top: 10px;}
    </style>
</head>
<body>

    <div class="header">
        <h2>Laporan Hasil Tes Aptitude</h2>
        <p style="margin: 3px 0;">Pengembangan Kompetensi Dasar</p>
        <hr style="border: 0; border-top: 2px solid #2c448e; width: 60%; margin: 8px auto;">
        <p style="text-align: left; margin-top: 15px; font-size: 12px;">
            <strong>Nama Mahasiswa:</strong> {{ $nama_user }}
        </p>
    </div>

    <!-- BAGIAN 1: GRAFIK & TABEL -->
    <table class="layout-table">
        <tr>
            <td class="chart-col">
                @if(!empty($chart_image))
                    <img src="{{ $chart_image }}" class="chart-image" alt="Grafik Radar">
                @else
                    <div style="padding: 50px; border: 1px dashed #ccc; margin-top: 30px;">Grafik belum dimuat</div>
                @endif
            </td>
            <td class="score-col">
                <table class="score-table">
                    <thead>
                        <tr>
                            <th>Domain Aptitude</th>
                            <th width="25%">Persentase</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($domainScores as $kategori => $skor)
                        <tr>
                            <td>{{ $kategori }}</td>
                            <td class="center">{{ $skor }}%</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td style="text-align: right; font-weight: bold;">TOTAL SKOR:</td>
                            <td class="center" style="background-color: #f1f5f9;">{{ $totalSkor }}</td>
                        </tr>
                    </tfoot>
                </table>
            </td>
        </tr>
    </table>

    <!-- BAGIAN 2: INTERPRETASI -->
    <div class="section-title">Kesimpulan & Interpretasi</div>
    <div class="box">
        <strong style="color: #2c448e; font-size: 12px;">Status: {{ $status }}</strong>
        <p style="margin-top: 5px;">{{ $makna }}</p>
        
        <p style="margin-top: 10px; margin-bottom: 0;">
            Kekuatan dominan Anda terletak pada <strong>{{ $kategori_dominan }}</strong> dengan tingkat keyakinan <strong>{{ $skor_tertinggi }}%</strong>.
        </p>
    </div>

    <!-- BAGIAN 3: PORTOFOLIO -->
    <div class="section-title">Status Portofolio Pendukung</div>
    <div class="porto-box">
        <strong style="color: #166534;">{{ $portoCategory }}</strong>
    </div>

</body>
</html>