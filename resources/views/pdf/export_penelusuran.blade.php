<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Hasil Tes Bakat</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; color: #333; line-height: 1.4; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { color: #2c448e; margin: 0; text-transform: uppercase; font-size: 16px;}
        .layout-table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        .layout-table td { vertical-align: top; }
        .chart-col { width: 50%; text-align: center; padding-right: 15px; }
        .score-col { width: 50%; padding-left: 15px; }
        .chart-image { width: 100%; max-width: 280px; height: auto; }
        .score-table { width: 100%; border-collapse: collapse; font-size: 9px; }
        .score-table th, .score-table td { border: 1px solid #ddd; padding: 3px 5px; text-align: left; }
        .score-table th { background-color: #2c448e; color: white; text-align: center; }
        .score-table td.center { text-align: center; font-weight: bold; }
        
        .section-title { font-size: 13px; color: #2c448e; border-bottom: 2px solid #2c448e; padding-bottom: 4px; margin-top: 10px; margin-bottom: 8px; font-weight: bold; }
        
        /* Box Interpretasi */
        .interpret-box { background-color: #f8faff; border: 1px solid #cdd8f6; padding: 8px; margin-bottom: 15px; border-radius: 5px; }
        .interpret-table { width: 100%; border-collapse: collapse; }
        .interpret-table td { vertical-align: top; width: 50%; padding: 5px; }
        .list-bakat { margin: 5px 0 0 0; padding-left: 20px; font-size: 10px; }
        .list-bakat li { margin-bottom: 3px; }
        
        /* Box UKM */
        .ukm-table { width: 100%; border-collapse: collapse; }
        .ukm-table td { vertical-align: top; width: 50%; }
        .ukm-col-left { padding-right: 8px; border-right: 1px dashed #ccc; }
        .ukm-col-right { padding-left: 8px; }
        
        .ukm-box { border: 1px solid #ddd; padding: 8px; margin-bottom: 8px; background-color: #fafafa; border-left: 3px solid #2c448e; }
        .ukm-title { font-weight: bold; font-size: 11px; color: #1a1a1a; margin-bottom: 3px; }
        .ukm-match { font-weight: bold; color: #059669; float: right; font-size: 10px; }
        .ukm-desc { font-size: 9px; color: #555; text-align: justify; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Laporan Hasil Tes Bakat</h2>
        <p style="margin: 3px 0;">Penelusuran Kognitif & Sikap</p>
        <hr style="border: 0; border-top: 2px solid #2c448e; width: 60%; margin: 8px auto;">
        <p style="text-align: left; margin-top: 10px; font-size: 12px;">
            <strong>Nama Mahasiswa:</strong> {{ $nama_user }}
        </p>
    </div>

    <!-- BAGIAN 1: GRAFIK & TABEL SKOR -->
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
                            <th>Kategori Bakat</th>
                            <th width="20%">Persen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($detailSkor as $kategori => $skor)
                        <tr>
                            <td>{{ $kategori }}</td>
                            <td class="center">{{ $skor }}%</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

    <!-- BAGIAN 2: INTERPRETASI -->
    <div class="section-title">Interpretasi Peta Bakat</div>
    <div class="interpret-box">
        <table class="interpret-table">
            <tr>
                <td style="border-right: 1px dashed #cdd8f6; padding-right: 10px;">
                    <strong style="color: #059669; font-size: 11px;">3 Bakat Paling Dominan</strong>
                    <ul class="list-bakat">
                        @foreach($top3Bakat as $nama => $skor)
                            <li><strong>{{ $nama }}</strong> ({{ $skor }}%)</li>
                        @endforeach
                    </ul>
                </td>
                <td style="padding-left: 10px;">
                    <strong style="color: #dc2626; font-size: 11px;">3 Bakat Area Eksplorasi</strong>
                    <ul class="list-bakat">
                        @foreach($bottom3Bakat as $nama => $skor)
                            <li><strong>{{ $nama }}</strong> ({{ $skor }}%)</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        </table>
    </div>

    <!-- BAGIAN 3: REKOMENDASI UKM (PUTRA & PUTRI) -->
    <div class="section-title">Top 3 Rekomendasi UKM (Berdasarkan Gender)</div>
    <table class="ukm-table">
        <tr>
            <!-- Kolom Putra -->
            <td class="ukm-col-left">
                <div style="text-align: center; font-weight: bold; margin-bottom: 10px; color: #2563eb;">Opsi UKM Putra</div>
                @foreach($rekomendasiPutra as $ukm)
                <div class="ukm-box" style="border-left-color: #2563eb;">
                    <div class="ukm-title">
                        {{ $ukm['nama_ukm'] }}
                        <span class="ukm-match">{{ $ukm['persen'] }}%</span>
                    </div>
                    <div class="ukm-desc">
                        {{ Str::limit($ukm['deskripsi'], 100) }}
                    </div>
                </div>
                @endforeach
            </td>

            <!-- Kolom Putri -->
            <td class="ukm-col-right">
                <div style="text-align: center; font-weight: bold; margin-bottom: 10px; color: #db2777;">Opsi UKM Putri</div>
                @foreach($rekomendasiPutri as $ukm)
                <div class="ukm-box" style="border-left-color: #db2777;">
                    <div class="ukm-title">
                        {{ $ukm['nama_ukm'] }}
                        <span class="ukm-match">{{ $ukm['persen'] }}%</span>
                    </div>
                    <div class="ukm-desc">
                        {{ Str::limit($ukm['deskripsi'], 100) }}
                    </div>
                </div>
                @endforeach
            </td>
        </tr>
    </table>

</body>
</html>