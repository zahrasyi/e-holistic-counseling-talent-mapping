<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UkmSeeder extends Seeder
{
    public function run()
    {
        // 1. Kosongkan tabel ukms terlebih dahulu agar tidak dobel
        DB::table('ukms')->truncate();

        // 2. Ambil path file CSV yang tadi kamu taruh di folder seeder
        $csvFile = database_path('seeders/ukm_data.csv');
        $fileHandle = fopen($csvFile, 'r');

        // 3. Lewati baris pertama (header Excel: NO, UKM, KATEGORI, dst)
        $header = fgetcsv($fileHandle, 1000, ";");
        
        // Cek jika baris pertama gagal dibaca dengan titik koma, coba pakai koma
        if (count($header) == 1) {
            rewind($fileHandle);
            $header = fgetcsv($fileHandle, 1000, ",");
            $separator = ",";
        } else {
            $separator = ";";
        }

        // ... (kode atasnya biarkan sama)

        while (($row = fgetcsv($fileHandle, 1000, $separator)) !== FALSE) {
            // Abaikan jika baris kosong
            if (empty($row[0])) continue; 

            // Fungsi helper untuk desimal
            $fixDecimal = function($val) {
                return (float) str_replace(',', '.', $val);
            };

            // Masukkan data dengan index yang sudah DISESUAIKAN dengan CSV barumu
            DB::table('ukms')->insert([
                'nama_ukm'   => $row[0], // Kolom ke-1 di CSV (Nama UKM)
                'kategori'   => $row[1], // Kolom ke-2 di CSV (PUTRA/PUTRI)
                'gambar'     => $row[2] !== '' ? $row[2] : null, // Kolom ke-3
                'deskripsi'  => $row[3] !== '' ? $row[3] : 'UKM ' . $row[0], // Kolom ke-4
                'h01'        => $fixDecimal($row[4]),  // Kolom ke-5 (H01)
                'h02'        => $fixDecimal($row[5]),  
                'h03'        => $fixDecimal($row[6]),  
                'h04'        => $fixDecimal($row[7]),  
                'h05'        => $fixDecimal($row[8]),  
                'h06'        => $fixDecimal($row[9]),  
                'h07'        => $fixDecimal($row[10]), 
                'h08'        => $fixDecimal($row[11]), 
                'h09'        => $fixDecimal($row[12]), 
                'h10'        => $fixDecimal($row[13]), 
                'h11'        => $fixDecimal($row[14]), 
                'h12'        => $fixDecimal($row[15]), 
                'h13'        => $fixDecimal($row[16]), 
                'h14'        => $fixDecimal($row[17]), 
                'h15'        => $fixDecimal($row[18]), // Kolom ke-19 (H15)
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        fclose($fileHandle);
    }
}