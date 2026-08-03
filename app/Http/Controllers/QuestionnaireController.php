<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;
use App\Models\Questionnaire;
use Illuminate\Support\Facades\Auth;

class QuestionnaireController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => dashboardRoute()],
            ['name' => 'Questionnaire', 'url' => null],
            ['name' => 'list Question', 'url' => null],
        ];

        return view('questionnaire.index', compact('breadcrumbs'));
    }
    public function listKuesioner()
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => dashboardRoute()],
            ['name' => 'Questionnaire', 'url' => null],
            ['name' => 'list Question', 'url' => null],
        ];

        return view('questionnaire.listKuesioner', compact('breadcrumbs'));
    }
    public function list()
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => dashboardRoute()],
            ['name' => 'Questionnaire', 'url' => null],
            ['name' => 'Riwayat', 'url' => null],
        ];

        $tableHeaders = [
            ['label' => 'No', 'class' => 'w-16 text-center'],
            ['label' => 'Attempted Date', 'class' => 'w-full'],
            ['label' => 'Action', 'class' => 'w-32 text-center'],
        ];

        $kuesioners = Questionnaire::where('user_id', Auth::id())->latest()->paginate(10);
        return view('questionnaire.list', compact('kuesioners', 'breadcrumbs', 'tableHeaders'));
    }
    public function refleksi(Request $request)
    {
        if ($request->kuesionerId) {
            // Cek apakah Auth::id sama dengan $kuesioner->user_id
            $kuesionerId = $request->kuesionerId;
            $kuesioner = Questionnaire::find($kuesionerId);
            if ($kuesioner->user_id !== Auth::id()) {
                return redirect()->route('appointments.select-type')->with('error', 'Dilarang Mengakses ID Kuesioner Orang Lain !!!');
            } else {
                $kuesionerId = $request->kuesionerId;
                return view('questionnaire.refleksi', compact('kuesionerId'));
            }
        } else {
            return redirect()->route('appointments.select-type')->with('error', 'Isi Kuesioner Terlebih Dahulu!');
        }
    }
    public function storeRefleksi(Request $request)
    {
        // dd($request->all());
        $refleksi = [
            'refleksiBiologi'   => $request->refleksiBiologi,
            'refleksiPsikologi' => $request->refleksiPsikologi,
            'refleksiSosial'    => $request->refleksiSosial,
            'refleksiSpiritual' => $request->refleksiSpiritual,
        ];

        $kuesioner = Questionnaire::find($request->kuesionerId);
        // Pastikan datanya ketemu
        if (!$kuesioner) {
            return back()->with('error', 'Data kuesioner tidak ditemukan.');
        }

        $kuesioner->update([
            'reflections' => $refleksi
        ]);

        return redirect()
            ->route('questionnaire.detail', $kuesioner->id)
            ->with('success', 'Berhasil menambahkan refleksi!');
    }

    public function detail($kuesionerId)
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => dashboardRoute()],
            ['name' => 'Questionnaire', 'url' => null],
            ['name' => 'Detail', 'url' => null],
        ];
        
        $refleksiSections = [
            [
                'slug' => 'refleksiBiologi',
                'title' => '(1/4) Kesehatan Biologis Islami',
                'questions' => [
                    '1. Bagaimana saya memaknai tubuh saya sebagai amanah dari Allah?',
                    '2. Kebiasaan buruk apa yang masih saya lakukan dan perlu saya tinggalkan demi kesehatan?',
                    '3. Sudahkah saya menjaga kebersihan dan gaya hidup sehat sesuai tuntunan Islam?',
                    '4. Apa hubungan antara tubuh yang sehat dengan semangat ibadah saya?',
                    '5. Apa langkah pertama yang bisa saya lakukan untuk memperbaiki gaya hidup saya?',
                ],
            ],
            [
                'slug' => 'refleksiPsikologi',
                'title' => '(2/4) Kesehatan Psikologis Islami',
                'questions' => [
                    '1. Perasaan apa yang paling sering saya rasakan akhir-akhir ini? Mengapa?',
                    '2. Bagaimana saya mengelola stres atau tekanan batin? Apakah saya melibatkan Allah?',
                    '3. Apa doa yang paling sering saya panjatkan dalam kondisi sulit?',
                    '4. Sikap negatif apa yang ingin saya ubah agar lebih sehat secara psikologis dan Islami?',
                    '5. Langkah kecil apa yang bisa saya lakukan untuk menenangkan hati saya hari ini?',
                ],
            ],
            [
                'slug' => 'refleksiSosial',
                'title' => '(3/4) Kesehatan Sosial Islami',
                'questions' => [
                    '1. Bagian terbaik dari hubungan sosial saya adalah...',
                    '2. Hal yang ingin saya perbaiki dalam pergaulan sosial saya adalah...',
                    '3. Adakah seseorang yang pernah tersakiti karena saya? Apa yang bisa saya lakukan?',
                    '4. Apa arti ukhuwah Islamiyah bagi saya dalam kehidupan sosial sehari-hari?',
                    '5. Satu langkah kecil yang bisa saya lakukan minggu ini untuk memperbaiki hubungan sosial saya...',
                ],
            ],
            [
                'slug' => 'refleksiSpiritual',
                'title' => '(4/4) Kesehatan Spiritual Islami',
                'questions' => [
                    '1. Kapan terakhir kali saya merasakan kedekatan mendalam dengan Allah?',
                    '2. Apa yang paling sering membuat saya lalai dalam menjaga hubungan spiritual dengan Allah?',
                    '3. Ibadah apa yang paling membantu saya menenangkan hati?',
                    '4. Apa satu langkah konkrit yang bisa saya lakukan pekan ini untuk meningkatkan kesehatan spiritual saya?',
                    '5. Siapa sosok atau kisah inspiratif yang memotivasi saya untuk mendekatkan diri pada Allah?',
                ],
            ],
        ];
        $kuesioner = Questionnaire::where('id', $kuesionerId)->first();
        if (!$kuesioner) {
            return back()->with('error', 'Data kuesioner tidak ditemukan.');
        }
        $user = Auth::user();

        if (Auth::user()->hasRole('mahasiswa')) {
            // Jika mahasiswa pastikan kuesioner->user_id sama dengan id user
            if ($kuesioner->user_id !== $user->id) {
                return redirect()->route('dashboard.userDashboard')->with('error', 'Data kuesioner yang anda akses bukan milik anda.');
            } else {
                return view('questionnaire.detail', compact('kuesioner', 'refleksiSections', 'breadcrumbs'));
            }
        } else if (Auth::user()->hasRole('konselor')) {
            // Jika counselor, pastikan kuesioner->user_id sama dengan id pasiennya
            // Supaya hanya bia melihat kuesioner milik pasien , 
            // cari apakah ada meeting dengan counselor_id user::id dan student_id = kuesioner->user_id
            $meeting = Meeting::where('student_id', $kuesioner->user_id)->where('counselor_id', $user->id)->first();
            if (empty($meeting)) {
                // jika kosong , tolak
                return redirect()->route('dashboard.counselorDashboard')->with('error', 'Data kuesioner yang anda akses bukan milik Pasien anda.');
            } else {
                return view('questionnaire.detail', compact('kuesioner', 'refleksiSections', 'breadcrumbs'));
            }
        }
    }

    public function submit(Request $request)
    {
        // dd($request->all());
        //
        $alternatif = [];
        $alternatif['biologi'] = $request->biologi;
        $alternatif['psikologi'] = $request->psikologi;
        $alternatif['sosial'] = $request->sosial;
        $alternatif['spiritual'] = $request->spiritual;
        // Mapping nilai → skala 0–1
        $skalaNormalisasi = [
            1 => 0,
            2 => 0.25,
            3 => 0.5,
            4 => 0.75,
            5 => 1
        ];
        $bobot = [];
        $bobot['biologi'] = [
            1 => 0.1,
            2 => 0.1,
            3 => 0.1,
            4 => 0.1,
            5 => 0.1,
            6 => 0.1,
            7 => 0.1,
            8 => 0.1,
            9 => 0.1,
            10 => 0.1,
        ]; // total harus 1.0 dan ada 10 angka
        $bobot['psikologi'] = [
            1 => 0.1,
            2 => 0.1,
            3 => 0.1,
            4 => 0.1,
            5 => 0.1,
            6 => 0.1,
            7 => 0.1,
            8 => 0.1,
            9 => 0.1,
            10 => 0.1,
        ]; // total harus 1.0 dan ada 10 angka
        $bobot['sosial'] = [
            1 => 0.1,
            2 => 0.1,
            3 => 0.1,
            4 => 0.1,
            5 => 0.1,
            6 => 0.1,
            7 => 0.1,
            8 => 0.1,
            9 => 0.1,
            10 => 0.1,
        ]; // total harus 1.0 dan ada 10 angka
        $bobot['spiritual'] = [
            1 => 0.1,
            2 => 0.1,
            3 => 0.1,
            4 => 0.1,
            5 => 0.1,
            6 => 0.1,
            7 => 0.1,
            8 => 0.1,
            9 => 0.1,
            10 => 0.1,
        ]; // total harus 1.0 dan ada 10 angka

        // Array untuk menyimpan skor akhir
        $hasil = [];

        // Hitung skor tiap alternatif
        foreach ($alternatif as $aspek => $nilai) {
            $total = 0;
            foreach ($nilai as $index => $v) {
                $total += $skalaNormalisasi[$v] * $bobot[$aspek][$index];
            }
            $hasil[$aspek] = round($total, 3);
        }
        // Urutkan dari skor tertinggi ke terendah
        arsort($hasil);

        $kuesioner = Questionnaire::create(
            [
                'user_id' => Auth::id(),
                'answers' => $alternatif,
                'scores' => $hasil,
            ]
        );
        if ($kuesioner) {
            $success =  'Kuesioner berhasil dikumpulkan';
        } else {
            $success =  null;
        }
        $kuesionerId = $kuesioner->id;
        // dd($hasil);
        return view('questionnaire.result', compact('kuesioner', 'success', 'kuesionerId'));
    }
}
