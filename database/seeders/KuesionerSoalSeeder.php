<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KuesionerSoal;

class KuesionerSoalSeeder extends Seeder
{
    public function run(): void
    {
        $soal = [
            // ==========================================
            // A. KUESIONER PENELUSURAN (G001 - G060)
            // ==========================================
            
            // 1. Bakat Kepemimpinan
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Kepemimpinan', 'kode' => 'G001', 'pernyataan' => 'Saya mampu memimpin kelompok dengan tanggung jawab dan keteladanan.', 'mb' => 0.8, 'md' => 0.0, 'cfp' => 0.8], // Inti
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Kepemimpinan', 'kode' => 'G002', 'pernyataan' => 'Saya dapat menggerakkan orang lain untuk mencapai tujuan bersama.', 'mb' => 0.6, 'md' => 0.0, 'cfp' => 0.6], // Pendukung
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Kepemimpinan', 'kode' => 'G003', 'pernyataan' => 'Saya cepat mengambil inisiatif dalam situasi penting.', 'mb' => 0.6, 'md' => 0.0, 'cfp' => 0.6], // Pendukung
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Kepemimpinan', 'kode' => 'G004', 'pernyataan' => 'Saya mampu menjaga semangat tim di tengah kesulitan.', 'mb' => 0.4, 'md' => 0.0, 'cfp' => 0.4], // Pelengkap

            // 2. Bakat Akademik & Intelektual
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Akademik & Intelektual', 'kode' => 'G005', 'pernyataan' => 'Saya cepat memahami konsep-konsep baru dalam pelajaran.', 'mb' => 0.6, 'md' => 0.0, 'cfp' => 0.6],
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Akademik & Intelektual', 'kode' => 'G006', 'pernyataan' => 'Saya suka meneliti dan menganalisis fenomena ilmiah.', 'mb' => 0.8, 'md' => 0.0, 'cfp' => 0.8], // Inti
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Akademik & Intelektual', 'kode' => 'G007', 'pernyataan' => 'Saya dapat menjelaskan ide kompleks dengan jelas.', 'mb' => 0.6, 'md' => 0.0, 'cfp' => 0.6],
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Akademik & Intelektual', 'kode' => 'G008', 'pernyataan' => 'Saya tertarik memperdalam bidang keilmuan tertentu.', 'mb' => 0.4, 'md' => 0.0, 'cfp' => 0.4],

            // 3. Bakat Seni & Estetika
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Seni & Estetika', 'kode' => 'G009', 'pernyataan' => 'Saya memiliki kepekaan terhadap keindahan (seni, warna, suara).', 'mb' => 0.6, 'md' => 0.0, 'cfp' => 0.6],
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Seni & Estetika', 'kode' => 'G010', 'pernyataan' => 'Saya mudah mengekspresikan ide melalui seni, musik, atau desain.', 'mb' => 0.8, 'md' => 0.0, 'cfp' => 0.8], // Inti
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Seni & Estetika', 'kode' => 'G011', 'pernyataan' => 'Saya gemar menciptakan karya dengan nilai estetika tinggi.', 'mb' => 0.6, 'md' => 0.0, 'cfp' => 0.6],
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Seni & Estetika', 'kode' => 'G012', 'pernyataan' => 'Saya menghargai harmoni dan keindahan dalam ciptaan Allah.', 'mb' => 0.4, 'md' => 0.0, 'cfp' => 0.4],

            // 4. Bakat Bahasa & Komunikasi
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Bahasa & Komunikasi', 'kode' => 'G013', 'pernyataan' => 'Saya mudah berbicara dan menulis dengan jelas.', 'mb' => 0.8, 'md' => 0.0, 'cfp' => 0.8], // Inti
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Bahasa & Komunikasi', 'kode' => 'G014', 'pernyataan' => 'Saya senang berdiskusi dan berbagi ide.', 'mb' => 0.4, 'md' => 0.0, 'cfp' => 0.4],
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Bahasa & Komunikasi', 'kode' => 'G015', 'pernyataan' => 'Saya cepat menyesuaikan bahasa dengan lawan bicara.', 'mb' => 0.6, 'md' => 0.0, 'cfp' => 0.6],
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Bahasa & Komunikasi', 'kode' => 'G016', 'pernyataan' => 'Saya mampu mempengaruhi orang dengan tutur kata yang baik.', 'mb' => 0.6, 'md' => 0.0, 'cfp' => 0.6],

            // 5. Bakat Organisasi & Manajerial
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Organisasi & Manajerial', 'kode' => 'G017', 'pernyataan' => 'Saya mampu mengatur kegiatan dan waktu secara efektif.', 'mb' => 0.6, 'md' => 0.0, 'cfp' => 0.6],
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Organisasi & Manajerial', 'kode' => 'G018', 'pernyataan' => 'Saya terampil membagi tugas dalam kelompok.', 'mb' => 0.6, 'md' => 0.0, 'cfp' => 0.6],
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Organisasi & Manajerial', 'kode' => 'G019', 'pernyataan' => 'Saya cepat membuat rencana kerja yang efisien.', 'mb' => 0.8, 'md' => 0.0, 'cfp' => 0.8], // Inti
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Organisasi & Manajerial', 'kode' => 'G020', 'pernyataan' => 'Saya mampu memantau kemajuan suatu program dengan baik.', 'mb' => 0.4, 'md' => 0.0, 'cfp' => 0.4],

            // 6. Bakat Sosial & Pelayanan
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Sosial & Pelayanan', 'kode' => 'G021', 'pernyataan' => 'Saya senang membantu orang lain tanpa diminta.', 'mb' => 0.6, 'md' => 0.0, 'cfp' => 0.6],
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Sosial & Pelayanan', 'kode' => 'G022', 'pernyataan' => 'Saya mudah berempati terhadap kesulitan orang lain.', 'mb' => 0.4, 'md' => 0.0, 'cfp' => 0.4],
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Sosial & Pelayanan', 'kode' => 'G023', 'pernyataan' => 'Saya merasa bahagia saat terlibat dalam kegiatan sosial.', 'mb' => 0.6, 'md' => 0.0, 'cfp' => 0.6],
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Sosial & Pelayanan', 'kode' => 'G024', 'pernyataan' => 'Saya senang melayani masyarakat dengan niat ibadah.', 'mb' => 0.8, 'md' => 0.0, 'cfp' => 0.8], // Inti

            // 7. Bakat Olahraga & Kesehatan Jasmani
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Olahraga & Kesehatan Jasmani', 'kode' => 'G025', 'pernyataan' => 'Saya cepat menguasai gerakan fisik atau keterampilan olahraga.', 'mb' => 0.8, 'md' => 0.0, 'cfp' => 0.8], // Inti
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Olahraga & Kesehatan Jasmani', 'kode' => 'G026', 'pernyataan' => 'Saya memiliki ketahanan fisik yang baik.', 'mb' => 0.6, 'md' => 0.0, 'cfp' => 0.6],
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Olahraga & Kesehatan Jasmani', 'kode' => 'G027', 'pernyataan' => 'Saya menikmati aktivitas yang melibatkan energi tubuh.', 'mb' => 0.4, 'md' => 0.0, 'cfp' => 0.4],
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Olahraga & Kesehatan Jasmani', 'kode' => 'G028', 'pernyataan' => 'Saya berkomitmen menjaga kesehatan dan kebugaran.', 'mb' => 0.6, 'md' => 0.0, 'cfp' => 0.6],

            // 8. Bakat Teknologi & Digital
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Teknologi & Digital', 'kode' => 'G029', 'pernyataan' => 'Saya cepat mempelajari teknologi baru.', 'mb' => 0.6, 'md' => 0.0, 'cfp' => 0.6],
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Teknologi & Digital', 'kode' => 'G030', 'pernyataan' => 'Saya suka bereksperimen dengan perangkat digital.', 'mb' => 0.4, 'md' => 0.0, 'cfp' => 0.4],
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Teknologi & Digital', 'kode' => 'G031', 'pernyataan' => 'Saya memahami logika sistem dan pemrograman.', 'mb' => 0.8, 'md' => 0.0, 'cfp' => 0.8], // Inti
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Teknologi & Digital', 'kode' => 'G032', 'pernyataan' => 'Saya tertarik membuat solusi digital yang bermanfaat.', 'mb' => 0.6, 'md' => 0.0, 'cfp' => 0.6],

            // 9. Bakat Negosiasi & Diplomasi
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Negosiasi & Diplomasi', 'kode' => 'G033', 'pernyataan' => 'Saya pandai menjaga hubungan baik dengan berbagai pihak.', 'mb' => 0.6, 'md' => 0.0, 'cfp' => 0.6],
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Negosiasi & Diplomasi', 'kode' => 'G034', 'pernyataan' => 'Saya bisa menyampaikan pendapat tanpa menyinggung orang lain.', 'mb' => 0.6, 'md' => 0.0, 'cfp' => 0.6],
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Negosiasi & Diplomasi', 'kode' => 'G035', 'pernyataan' => 'Saya sabar dan bijak dalam menghadapi perbedaan.', 'mb' => 0.4, 'md' => 0.0, 'cfp' => 0.4],
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Negosiasi & Diplomasi', 'kode' => 'G036', 'pernyataan' => 'Saya mampu mencari jalan tengah dalam perbedaan pendapat.', 'mb' => 0.8, 'md' => 0.0, 'cfp' => 0.8], // Inti

            // 10. Bakat Spiritual & Dakwah
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Spiritual & Dakwah', 'kode' => 'G037', 'pernyataan' => 'Saya tertarik menyampaikan pesan Islam dengan cara bijak.', 'mb' => 0.6, 'md' => 0.0, 'cfp' => 0.6],
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Spiritual & Dakwah', 'kode' => 'G038', 'pernyataan' => 'Saya memiliki keteguhan iman dalam bertindak.', 'mb' => 0.4, 'md' => 0.0, 'cfp' => 0.4],
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Spiritual & Dakwah', 'kode' => 'G039', 'pernyataan' => 'Saya bersemangat berdakwah melalui perbuatan nyata.', 'mb' => 0.8, 'md' => 0.0, 'cfp' => 0.8], // Inti
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Spiritual & Dakwah', 'kode' => 'G040', 'pernyataan' => 'Saya ingin menjadi teladan dalam akhlak dan ibadah.', 'mb' => 0.6, 'md' => 0.0, 'cfp' => 0.6],

            // 11. Bakat Inovasi & Teknokratik
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Inovasi & Teknokratik', 'kode' => 'G041', 'pernyataan' => 'Saya gemar mencari cara baru untuk menyelesaikan masalah.', 'mb' => 0.6, 'md' => 0.0, 'cfp' => 0.6],
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Inovasi & Teknokratik', 'kode' => 'G042', 'pernyataan' => 'Saya suka menciptakan produk atau sistem yang efisien.', 'mb' => 0.8, 'md' => 0.0, 'cfp' => 0.8], // Inti
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Inovasi & Teknokratik', 'kode' => 'G043', 'pernyataan' => 'Saya memiliki naluri memperbaiki sesuatu agar lebih baik.', 'mb' => 0.6, 'md' => 0.0, 'cfp' => 0.6],
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Inovasi & Teknokratik', 'kode' => 'G044', 'pernyataan' => 'Saya berpikir kreatif namun terukur.', 'mb' => 0.4, 'md' => 0.0, 'cfp' => 0.4],

            // 12. Bakat Penelitian & Keilmuan
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Penelitian & Keilmuan', 'kode' => 'G045', 'pernyataan' => 'Saya tertarik mengumpulkan data dan melakukan riset.', 'mb' => 0.6, 'md' => 0.0, 'cfp' => 0.6],
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Penelitian & Keilmuan', 'kode' => 'G046', 'pernyataan' => 'Saya tekun dalam mengamati gejala alam dan sosial.', 'mb' => 0.4, 'md' => 0.0, 'cfp' => 0.4],
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Penelitian & Keilmuan', 'kode' => 'G047', 'pernyataan' => 'Saya menyukai proses menemukan kebenaran ilmiah.', 'mb' => 0.8, 'md' => 0.0, 'cfp' => 0.8], // Inti
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Penelitian & Keilmuan', 'kode' => 'G048', 'pernyataan' => 'Saya dapat menulis hasil pemikiran dengan sistematis.', 'mb' => 0.6, 'md' => 0.0, 'cfp' => 0.6],

            // 13. Bakat Kepedulian Sosial & Kemanusiaan
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Kepedulian Sosial & Kemanusiaan', 'kode' => 'G049', 'pernyataan' => 'Saya peka terhadap penderitaan orang lain.', 'mb' => 0.4, 'md' => 0.0, 'cfp' => 0.4],
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Kepedulian Sosial & Kemanusiaan', 'kode' => 'G050', 'pernyataan' => 'Saya merasa terpanggil membantu mereka yang membutuhkan.', 'mb' => 0.6, 'md' => 0.0, 'cfp' => 0.6],
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Kepedulian Sosial & Kemanusiaan', 'kode' => 'G051', 'pernyataan' => 'Saya ingin bekerja di bidang kemanusiaan.', 'mb' => 0.8, 'md' => 0.0, 'cfp' => 0.8], // Inti
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Kepedulian Sosial & Kemanusiaan', 'kode' => 'G052', 'pernyataan' => 'Saya menganggap membantu sesama sebagai ibadah.', 'mb' => 0.6, 'md' => 0.0, 'cfp' => 0.6],

            // 14. Bakat Bisnis & Kewirausahaan
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Bisnis & Kewirausahaan', 'kode' => 'G053', 'pernyataan' => 'Saya tertarik menciptakan peluang usaha.', 'mb' => 0.8, 'md' => 0.0, 'cfp' => 0.8], // Inti
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Bisnis & Kewirausahaan', 'kode' => 'G054', 'pernyataan' => 'Saya mampu menghitung risiko dan peluang dengan tepat.', 'mb' => 0.6, 'md' => 0.0, 'cfp' => 0.6],
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Bisnis & Kewirausahaan', 'kode' => 'G055', 'pernyataan' => 'Saya suka mengatur keuangan dengan strategi.', 'mb' => 0.6, 'md' => 0.0, 'cfp' => 0.6],
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Bisnis & Kewirausahaan', 'kode' => 'G056', 'pernyataan' => 'Saya berpikir kreatif mencari nilai tambah ekonomi.', 'mb' => 0.4, 'md' => 0.0, 'cfp' => 0.4],

            // 15. Bakat Mandiri & Ketahanan Diri
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Mandiri & Ketahanan Diri', 'kode' => 'G057', 'pernyataan' => 'Saya dapat bekerja tanpa harus selalu diawasi.', 'mb' => 0.6, 'md' => 0.0, 'cfp' => 0.6],
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Mandiri & Ketahanan Diri', 'kode' => 'G058', 'pernyataan' => 'Saya memiliki keteguhan menghadapi tekanan.', 'mb' => 0.6, 'md' => 0.0, 'cfp' => 0.6],
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Mandiri & Ketahanan Diri', 'kode' => 'G059', 'pernyataan' => 'Saya bertanggung jawab atas hasil pekerjaan saya.', 'mb' => 0.8, 'md' => 0.0, 'cfp' => 0.8], // Inti
            ['tipe_kuesioner' => 'penelusuran', 'kategori_bakat' => 'Bakat Mandiri & Ketahanan Diri', 'kode' => 'G060', 'pernyataan' => 'Saya tidak mudah menyerah dalam situasi sulit.', 'mb' => 0.4, 'md' => 0.0, 'cfp' => 0.4],


            // ==========================================
            // B. KUESIONER PENGEMBANGAN / APTITUDE (G101 - G160)
            // ==========================================

            // 1. Verbal Aptitude
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Verbal Aptitude', 'kode' => 'G101', 'pernyataan' => 'Saya mudah memahami makna kata-kata yang baru saya dengar.', 'mb' => 0.2, 'md' => 0.0, 'cfp' => 0.2],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Verbal Aptitude', 'kode' => 'G102', 'pernyataan' => 'Saya senang menulis atau berbicara di depan umum.', 'mb' => 0.5, 'md' => 0.0, 'cfp' => 0.5], // Inti
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Verbal Aptitude', 'kode' => 'G103', 'pernyataan' => 'Saya mampu menjelaskan ide secara sistematis kepada orang lain.', 'mb' => 0.4, 'md' => 0.0, 'cfp' => 0.4], // Inti
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Verbal Aptitude', 'kode' => 'G104', 'pernyataan' => 'Saya senang membaca artikel, buku, atau berita setiap hari.', 'mb' => 0.2, 'md' => 0.0, 'cfp' => 0.2],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Verbal Aptitude', 'kode' => 'G105', 'pernyataan' => 'Saya dapat menulis dengan gaya bahasa yang menarik dan jelas.', 'mb' => 0.3, 'md' => 0.0, 'cfp' => 0.3],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Verbal Aptitude', 'kode' => 'G106', 'pernyataan' => 'Saya bisa menyusun argumen logis dalam diskusi.', 'mb' => 0.3, 'md' => 0.0, 'cfp' => 0.3],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Verbal Aptitude', 'kode' => 'G107', 'pernyataan' => 'Saya cepat menangkap inti pembicaraan orang lain.', 'mb' => 0.2, 'md' => 0.0, 'cfp' => 0.2],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Verbal Aptitude', 'kode' => 'G108', 'pernyataan' => 'Saya suka berdebat dengan cara yang santun dan rasional.', 'mb' => 0.2, 'md' => 0.0, 'cfp' => 0.2],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Verbal Aptitude', 'kode' => 'G109', 'pernyataan' => 'Saya sering menulis catatan, jurnal, atau refleksi pribadi.', 'mb' => 0.2, 'md' => 0.0, 'cfp' => 0.2],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Verbal Aptitude', 'kode' => 'G110', 'pernyataan' => 'Saya mampu menjadi juru bicara atau moderator dalam kegiatan kampus.', 'mb' => 0.4, 'md' => 0.0, 'cfp' => 0.4], // Inti

            // 2. Numerik Aptitude
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Numerik Aptitude', 'kode' => 'G111', 'pernyataan' => 'Saya senang memecahkan soal yang melibatkan angka.', 'mb' => 0.3, 'md' => 0.0, 'cfp' => 0.3],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Numerik Aptitude', 'kode' => 'G112', 'pernyataan' => 'Saya cepat memahami pola dalam data angka.', 'mb' => 0.4, 'md' => 0.0, 'cfp' => 0.4], // Inti
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Numerik Aptitude', 'kode' => 'G113', 'pernyataan' => 'Saya terbiasa menghitung secara mental tanpa alat bantu.', 'mb' => 0.5, 'md' => 0.0, 'cfp' => 0.5], // Inti
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Numerik Aptitude', 'kode' => 'G114', 'pernyataan' => 'Saya tertarik pada analisis statistik atau data penelitian.', 'mb' => 0.2, 'md' => 0.0, 'cfp' => 0.2],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Numerik Aptitude', 'kode' => 'G115', 'pernyataan' => 'Saya mampu memperkirakan hasil perhitungan tanpa kalkulator.', 'mb' => 0.3, 'md' => 0.0, 'cfp' => 0.3],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Numerik Aptitude', 'kode' => 'G116', 'pernyataan' => 'Saya menyukai permainan yang melibatkan strategi dan angka.', 'mb' => 0.2, 'md' => 0.0, 'cfp' => 0.2],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Numerik Aptitude', 'kode' => 'G117', 'pernyataan' => 'Saya mampu membaca grafik, tabel, dan diagram dengan cepat.', 'mb' => 0.2, 'md' => 0.0, 'cfp' => 0.2],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Numerik Aptitude', 'kode' => 'G118', 'pernyataan' => 'Saya sering menganalisis pengeluaran dan pemasukan secara mandiri.', 'mb' => 0.2, 'md' => 0.0, 'cfp' => 0.2],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Numerik Aptitude', 'kode' => 'G119', 'pernyataan' => 'Saya memahami hubungan sebab-akibat melalui perhitungan logis.', 'mb' => 0.3, 'md' => 0.0, 'cfp' => 0.3],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Numerik Aptitude', 'kode' => 'G120', 'pernyataan' => 'Saya mampu menilai keefektifan rencana berdasarkan data kuantitatif.', 'mb' => 0.4, 'md' => 0.0, 'cfp' => 0.4], // Inti

            // 3. Spasial Aptitude
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Spasial Aptitude', 'kode' => 'G121', 'pernyataan' => 'Saya dapat membayangkan bentuk tiga dimensi dari gambar dua dimensi.', 'mb' => 0.4, 'md' => 0.0, 'cfp' => 0.4], // Inti
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Spasial Aptitude', 'kode' => 'G122', 'pernyataan' => 'Saya tertarik pada desain, arsitektur, atau tata letak ruang.', 'mb' => 0.3, 'md' => 0.0, 'cfp' => 0.3],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Spasial Aptitude', 'kode' => 'G123', 'pernyataan' => 'Saya mudah memahami peta dan arah lokasi.', 'mb' => 0.2, 'md' => 0.0, 'cfp' => 0.2],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Spasial Aptitude', 'kode' => 'G124', 'pernyataan' => 'Saya suka menggambar, mendesain, atau membuat sketsa.', 'mb' => 0.4, 'md' => 0.0, 'cfp' => 0.4], // Inti
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Spasial Aptitude', 'kode' => 'G125', 'pernyataan' => 'Saya memiliki kemampuan memperkirakan ukuran dan proporsi.', 'mb' => 0.2, 'md' => 0.0, 'cfp' => 0.2],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Spasial Aptitude', 'kode' => 'G126', 'pernyataan' => 'Saya cepat mengenali pola dan bentuk visual yang berulang.', 'mb' => 0.3, 'md' => 0.0, 'cfp' => 0.3],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Spasial Aptitude', 'kode' => 'G127', 'pernyataan' => 'Saya mampu memperkirakan jarak dan posisi benda secara akurat.', 'mb' => 0.2, 'md' => 0.0, 'cfp' => 0.2],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Spasial Aptitude', 'kode' => 'G128', 'pernyataan' => 'Saya tertarik dengan seni rupa, fotografi, atau desain grafis.', 'mb' => 0.2, 'md' => 0.0, 'cfp' => 0.2],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Spasial Aptitude', 'kode' => 'G129', 'pernyataan' => 'Saya bisa memvisualisasikan ide sebelum diwujudkan.', 'mb' => 0.5, 'md' => 0.0, 'cfp' => 0.5], // Inti
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Spasial Aptitude', 'kode' => 'G130', 'pernyataan' => 'Saya memahami konsep arah dan posisi dengan mudah.', 'mb' => 0.2, 'md' => 0.0, 'cfp' => 0.2],

            // 4. Logika & Kreativitas
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Logika & Kreativitas', 'kode' => 'G131', 'pernyataan' => 'Saya suka mencari solusi berbeda dari orang lain.', 'mb' => 0.2, 'md' => 0.0, 'cfp' => 0.2],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Logika & Kreativitas', 'kode' => 'G132', 'pernyataan' => 'Saya mudah menemukan ide baru dalam suatu permasalahan.', 'mb' => 0.3, 'md' => 0.0, 'cfp' => 0.3],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Logika & Kreativitas', 'kode' => 'G133', 'pernyataan' => 'Saya mampu melihat masalah dari berbagai sudut pandang.', 'mb' => 0.4, 'md' => 0.0, 'cfp' => 0.4], // Inti
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Logika & Kreativitas', 'kode' => 'G134', 'pernyataan' => 'Saya senang menantang diri dengan teka-teki atau puzzle.', 'mb' => 0.2, 'md' => 0.0, 'cfp' => 0.2],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Logika & Kreativitas', 'kode' => 'G135', 'pernyataan' => 'Saya berpikir sebelum bertindak dalam situasi sulit.', 'mb' => 0.3, 'md' => 0.0, 'cfp' => 0.3],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Logika & Kreativitas', 'kode' => 'G136', 'pernyataan' => 'Saya mampu mengambil keputusan berdasarkan analisis logis.', 'mb' => 0.5, 'md' => 0.0, 'cfp' => 0.5], // Inti
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Logika & Kreativitas', 'kode' => 'G137', 'pernyataan' => 'Saya tidak cepat puas dengan jawaban yang sederhana.', 'mb' => 0.2, 'md' => 0.0, 'cfp' => 0.2],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Logika & Kreativitas', 'kode' => 'G138', 'pernyataan' => 'Saya mampu memperbaiki kesalahan dengan cara yang kreatif.', 'mb' => 0.4, 'md' => 0.0, 'cfp' => 0.4], // Inti
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Logika & Kreativitas', 'kode' => 'G139', 'pernyataan' => 'Saya dapat memprediksi kemungkinan hasil dari suatu tindakan.', 'mb' => 0.2, 'md' => 0.0, 'cfp' => 0.2],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Logika & Kreativitas', 'kode' => 'G140', 'pernyataan' => 'Saya mampu membuat strategi untuk mencapai tujuan tertentu.', 'mb' => 0.2, 'md' => 0.0, 'cfp' => 0.2],

            // 5. Sosial-Moral
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Sosial-Moral', 'kode' => 'G141', 'pernyataan' => 'Saya menghormati dan mendengarkan pendapat orang lain.', 'mb' => 0.2, 'md' => 0.0, 'cfp' => 0.2],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Sosial-Moral', 'kode' => 'G142', 'pernyataan' => 'Saya senang bekerja sama dalam tim.', 'mb' => 0.3, 'md' => 0.0, 'cfp' => 0.3],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Sosial-Moral', 'kode' => 'G143', 'pernyataan' => 'Saya mampu mengatur dan mengarahkan kegiatan kelompok.', 'mb' => 0.5, 'md' => 0.0, 'cfp' => 0.5], // Inti
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Sosial-Moral', 'kode' => 'G144', 'pernyataan' => 'Saya menjaga kejujuran dalam setiap tugas yang saya emban.', 'mb' => 0.3, 'md' => 0.0, 'cfp' => 0.3],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Sosial-Moral', 'kode' => 'G145', 'pernyataan' => 'Saya memiliki semangat melayani sesama dengan ikhlas.', 'mb' => 0.2, 'md' => 0.0, 'cfp' => 0.2],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Sosial-Moral', 'kode' => 'G146', 'pernyataan' => 'Saya berkomitmen pada nilai moral Islam dalam setiap pekerjaan.', 'mb' => 0.2, 'md' => 0.0, 'cfp' => 0.2],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Sosial-Moral', 'kode' => 'G147', 'pernyataan' => 'Saya mampu memotivasi teman ketika mereka menghadapi kesulitan.', 'mb' => 0.4, 'md' => 0.0, 'cfp' => 0.4], // Inti
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Sosial-Moral', 'kode' => 'G148', 'pernyataan' => 'Saya berani mengambil keputusan penting secara adil dan bijak.', 'mb' => 0.2, 'md' => 0.0, 'cfp' => 0.2],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Sosial-Moral', 'kode' => 'G149', 'pernyataan' => 'Saya senang memimpin kegiatan atau proyek sosial.', 'mb' => 0.2, 'md' => 0.0, 'cfp' => 0.2],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Sosial-Moral', 'kode' => 'G150', 'pernyataan' => 'Saya mengedepankan ukhuwah Islamiyah dalam bekerja sama.', 'mb' => 0.4, 'md' => 0.0, 'cfp' => 0.4], // Inti

            // 6. Kemandirian & Spiritualitas
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Kemandirian & Spiritualitas', 'kode' => 'G151', 'pernyataan' => 'Saya dapat bekerja tanpa harus selalu diawasi.', 'mb' => 0.3, 'md' => 0.0, 'cfp' => 0.3],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Kemandirian & Spiritualitas', 'kode' => 'G152', 'pernyataan' => 'Saya mampu mengatur waktu dengan baik.', 'mb' => 0.2, 'md' => 0.0, 'cfp' => 0.2],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Kemandirian & Spiritualitas', 'kode' => 'G153', 'pernyataan' => 'Saya tetap tenang ketika menghadapi tekanan.', 'mb' => 0.4, 'md' => 0.0, 'cfp' => 0.4], // Inti
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Kemandirian & Spiritualitas', 'kode' => 'G154', 'pernyataan' => 'Saya berani menghadapi tantangan baru.', 'mb' => 0.2, 'md' => 0.0, 'cfp' => 0.2],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Kemandirian & Spiritualitas', 'kode' => 'G155', 'pernyataan' => 'Saya memiliki tekad kuat untuk mencapai tujuan hidup.', 'mb' => 0.5, 'md' => 0.0, 'cfp' => 0.5], // Inti
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Kemandirian & Spiritualitas', 'kode' => 'G156', 'pernyataan' => 'Saya belajar dari kesalahan tanpa menyalahkan orang lain.', 'mb' => 0.2, 'md' => 0.0, 'cfp' => 0.2],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Kemandirian & Spiritualitas', 'kode' => 'G157', 'pernyataan' => 'Saya menjaga keseimbangan antara belajar, ibadah, dan sosial.', 'mb' => 0.2, 'md' => 0.0, 'cfp' => 0.2],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Kemandirian & Spiritualitas', 'kode' => 'G158', 'pernyataan' => 'Saya yakin setiap kesulitan adalah ujian untuk naik tingkat iman.', 'mb' => 0.3, 'md' => 0.0, 'cfp' => 0.3],
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Kemandirian & Spiritualitas', 'kode' => 'G159', 'pernyataan' => 'Saya mampu mengatur prioritas hidup dengan bijak.', 'mb' => 0.4, 'md' => 0.0, 'cfp' => 0.4], // Inti
            ['tipe_kuesioner' => 'aptitude', 'kategori_bakat' => 'Kemandirian & Spiritualitas', 'kode' => 'G160', 'pernyataan' => 'Saya percaya bakat adalah amanah Allah yang harus dikembangkan.', 'mb' => 0.2, 'md' => 0.0, 'cfp' => 0.2],
            ];

        foreach ($soal as $data) {
            KuesionerSoal::create($data);
        }
    }
}