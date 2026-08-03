<?php

namespace App\Http\Controllers;

use App\Filters\MeetingFilter;
use App\Models\CounselingType;
use App\Models\Meeting;
use App\Models\Questionnaire;
use App\Models\User;
use App\Notifications\AppointmentConfirmedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\GeminiService;
use App\Notifications\NewAppointmentNotification;

class AppointmentController extends Controller
{
    protected $gemini;

    public function __construct(GeminiService $gemini)
    {
        $this->gemini = $gemini;
    }

    public function selectType()
    {
        $counselingTypes = CounselingType::all();

        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => dashboardRoute()],
            ['name' => 'Appointment', 'url' => route('appointments.riwayatMahasiswa')],
            ['name' => 'Types', 'url' => null],
        ];

        return view('appointments.select-type', compact('counselingTypes', 'breadcrumbs'));
    }

    public function create(CounselingType $counselingType)
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => dashboardRoute()],
            ['name' => 'Appointment', 'url' => route('appointments.riwayatMahasiswa')],
            ['name' => 'Create', 'url' => null],
        ];

        $counselors = User::role('konselor')->get(); //ambil dari spatie
        $kuesioners = Questionnaire::where('user_id', Auth::id())->latest()->get();

        return view('appointments.create', compact('counselingType', 'counselors', 'breadcrumbs', 'kuesioners'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'counseling_type_id' => 'required|exists:counseling_types,id',
            'counselor_id' => 'required|exists:users,id',
            'meeting_time' => 'required|date|after:now',
            'student_notes' => 'nullable|string|max:1000',
            'topics' => 'required|string',
            'kuesioner_id' => 'nullable|exists:questionnaires,id',
        ]);

        $validated['student_id'] = Auth::id();
        $validated['status'] = 'pending';
        $meeting = Meeting::create($validated);

        // notification
        $counselor = User::find($validated['counselor_id']);
        if ($counselor) {
            $counselor->notify(new NewAppointmentNotification($meeting));
        }  

        return redirect()->route('appointments.pasien')->with('success', 'Janji temu berhasil dibuat');
    }

    public function riwayatMahasiswa()
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => dashboardRoute()],
            ['name' => 'Appointment', 'url' => null],
            ['name' => 'riwayat', 'url' => route('appointments.riwayatMahasiswa')],
        ];

        $tableHeaders = [
            ['label' => 'No', 'class' => 'w-12 text-center'],
            ['label' => 'Konselor', 'class' => 'w-2/6'],
            ['label' => 'Jenis Layanan', 'class' => 'w-1/6'],
            ['label' => 'Jadwal', 'class' => 'w-1/6'],
            ['label' => 'Jadwal Reschedule', 'class' => 'w-1/6'],
            ['label' => 'Status', 'class' => 'w-1/12 text-center'],
            ['label' => 'Resume', 'class' => 'w-1/12 text-center'],
        ];


        $meetings = Meeting::query()
            ->where('student_id', Auth::id())
            ->with(['counselor', 'counselingType'])
            ->filter(MeetingFilter::class)
            ->orderBy('meeting_time', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('appointments.riwayat-mahasiswa', compact('meetings', 'tableHeaders', 'breadcrumbs'));
    }

    public function riwayatCounselor()
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => dashboardRoute()],
            ['name' => 'Appointment', 'url' => null],
            ['name' => 'index', 'url' => route('appointments.riwayatCounselor')],
        ];

        $tableHeaders = [
            ['label' => 'No', 'class' => 'w-16 text-center'],
            ['label' => 'Pasien', 'class' => 'flex-1'],
            ['label' => 'No. Telp', 'class' => ''],
            ['label' => 'Jenis Layanan', 'class' => 'w-56'],
            ['label' => 'Jadwal', 'class' => 'w-56'],
            ['label' => 'Jadwal Reschedule', 'class' => 'w-56'],
            ['label' => 'Status', 'class' => 'w-40 text-center'],
            ['label' => 'Action', 'class' => 'w-40 text-center'],
        ];

        $meetings = Meeting::query()
            ->where('counselor_id', Auth::id())
            ->with(['student', 'counselingType'])
            ->filter(MeetingFilter::class)
            ->orderBy('meeting_time', 'desc')
            ->paginate(10)
            ->withQueryString();

        // dd($meetings->toArray());

        return view('appointments.riwayat-counselor', compact('meetings', 'tableHeaders', 'breadcrumbs'));
    }

    /**
     * untuk menampilkan appointment yang approved untuk mahasiswa 
     */
    public function approvedPasien()
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => dashboardRoute()],
            ['name' => 'Appointment', 'url' => null],
            ['name' => 'Approved', 'url' => null],
        ];

        $tableHeaders = [
            ['label' => 'No', 'class' => 'w-16 text-center'],
            ['label' => 'Konselor', 'class' => 'flex-1'],
            ['label' => 'No. Telp', 'class' => ''],
            ['label' => 'Jenis Layanan', 'class' => 'w-56'],
            ['label' => 'Jadwal', 'class' => 'w-56'],
            ['label' => 'Jadwal Reschedule', 'class' => 'w-56'],
            ['label' => 'Status', 'class' => 'w-40 text-center'],
        ];

        $approvedMeetings = Meeting::where('student_id', Auth::id())
            ->where('status', 'approved')
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        return view('appointments.approved-pasien', compact('breadcrumbs', 'tableHeaders', 'approvedMeetings'));
    }

    /**
     * untuk menampilkan appointment yang completed untuk mahasiswa
     */
    public function CompletedPasien()
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => dashboardRoute()],
            ['name' => 'Appointment', 'url' => null],
            ['name' => 'Approved', 'url' => null],
        ];

        $tableHeaders = [
            ['label' => 'No', 'class' => 'w-16 text-center'],
            ['label' => 'Konselor', 'class' => 'flex-1'],
            ['label' => 'No. Telp', 'class' => ''],
            ['label' => 'Jenis Layanan', 'class' => 'w-56'],
            ['label' => 'Jadwal', 'class' => 'w-56'],
            ['label' => 'Jadwal Reschedule', 'class' => 'w-56'],
            ['label' => 'Status', 'class' => 'w-40 text-center'],
            ['label' => 'Action', 'class' => 'w-40 text-center'],
        ];

        $completedMeetings = Meeting::where('student_id', Auth::id())
            ->where('status', 'completed')
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        return view('appointments.completed-pasien', compact('breadcrumbs', 'tableHeaders', 'completedMeetings'));
    }


    /**
     * untuk menampilkan appointment yang approved
     */
    public function approvedCounselor()
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => dashboardRoute()],
            ['name' => 'Appointment', 'url' => null],
            ['name' => 'Approved', 'url' => route('appointments.counselor')],
        ];

        $tableHeaders = [
            ['label' => 'No', 'class' => 'w-16 text-center'],
            ['label' => 'Pasien', 'class' => 'flex-1'],
            ['label' => 'No. Telp', 'class' => ''],
            ['label' => 'Jenis Layanan', 'class' => 'w-56'],
            ['label' => 'Jadwal', 'class' => 'w-56'],
            ['label' => 'Jadwal Reschedule', 'class' => 'w-56'],
            ['label' => 'Status', 'class' => 'w-40 text-center'],
            ['label' => 'Action', 'class' => 'w-40 text-center'],
        ];

        $approvedMeetings = Meeting::where('counselor_id', Auth::id())
            ->where('status', 'approved')
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        return view('appointments.approved-counselor', compact('breadcrumbs', 'tableHeaders', 'approvedMeetings'));
    }

    /**
     * halaman pengajuan appointment counselor
     */
    public function pasien() {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => dashboardRoute()],
            ['name' => 'Appointment', 'url' => null],
            ['name' => 'Patient', 'url' => null],
        ];

        $tableHeaders = [
            ['label' => 'No', 'class' => 'w-16 text-center'],
            ['label' => 'Konselor', 'class' => 'w-48'],
            ['label' => 'No. Telp', 'class' => ''],
            ['label' => 'Layanan', 'class' => 'w-48'],
            ['label' => 'Jadwal Diajukan', 'class' => 'w-64'],
            ['label' => 'Topics', 'class' => 'w-[40%] text-center'],
            ['label' => 'Status', 'class' => 'w-40 text-center'],
            // ['label' => 'Action', 'class' => 'w-32 text-center'],
        ];

        $pendingMeetings = Meeting::where('student_id', Auth::id())
            ->whereIn('status', ['pending', 'reschedule_pending'])
            ->with(['counselor', 'counselingType'])
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        return view('appointments.pasien', compact('pendingMeetings', 'tableHeaders', 'breadcrumbs'));
    }

    /**
     * halaman pengajuan appointment counselor
     */
    public function counselor()
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => dashboardRoute()],
            ['name' => 'Appointment', 'url' => null],
            ['name' => 'counselor', 'url' => route('appointments.counselor')],
        ];

        $tableHeaders = [
            ['label' => 'No', 'class' => 'w-16 text-center'],
            ['label' => 'Pasien', 'class' => 'w-48'],
            ['label' => 'No. Telp', 'class' => ''],
            ['label' => 'Layanan', 'class' => 'w-48'],
            ['label' => 'Jadwal Diajukan', 'class' => 'w-64'],
            ['label' => 'Topics', 'class' => 'w-[40%]'],
            ['label' => 'Action', 'class' => 'w-32 text-center'],
        ];


        $pendingMeetings = Meeting::where('counselor_id', Auth::id())
            ->whereIn('status', ['pending', 'reschedule_pending'])
            ->with(['student', 'counselingType'])
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        return view('appointments.counselor', compact('pendingMeetings', 'tableHeaders', 'breadcrumbs'));
    }

    /**
     * fuction untuk persetujuan atau penolakan appoinments
     */
    public function updateStatus(Request $request, Meeting $meeting)
    {
        if ($meeting->counselor_id !== Auth::id()) {
            abort(403, 'anda tidak memiliki izin mengubah appointment ini');
        }

        $validated = $request->validate([
            'action' => 'required|in:approve,propose_new_time,reject',
            'counselor_proposed_time' => 'nullable|date|after:now',
        ]);

        if ($validated['action'] === 'approve') {
            $meeting->status = 'approved';
            $meeting->approved_by = Auth::id();
            $alertType = 'success';
            $alertMessage = 'Appointment berhasil disetujui';
        } elseif ($validated['action'] === 'propose_new_time') {
            $meeting->status = 'approved';
            $meeting->counselor_proposed_time = $validated['counselor_proposed_time'];
            $alertType = 'warning';
            $alertMessage = 'Jadwal Baru berhasil dibuat';
        } elseif ($validated['action'] === 'reject') {
            $meeting->status = 'rejected';
            $meeting->approved_by = Auth::id();
            $alertType = 'error';
            $alertMessage = 'Appointment ditolak';
        }

        $meeting->save();

        // notification
        $student = $meeting->student;
        $student->notify(new AppointmentConfirmedNotification($meeting));

        // $alertType = $validated['status'] === 'approved' ? 'success' : 'warning';
        // $alertMessage  = $validated['status'] === 'approved' ? 'Appointment berhasil disetujui' : 'Appointment ditolak';

        return redirect()->route('appointments.approvedCounselor')->with($alertType, $alertMessage);
    }

    /**
     * untuk melihat riwayat semua appointment
     */
    public function riwayat(Request $request)
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => dashboardRoute()],
            ['name' => 'Appointment', 'url' => null],
            ['name' => 'Riwayat', 'url' => null],
        ];

        $tableHeaders = [
            ['label' => 'No', 'class' => 'w-1/12 text-center'],
            ['label' => 'Mahasiswa', 'class' => 'w-4/12'],
            ['label' => 'Konselor', 'class' => 'w-3/12'],
            ['label' => 'Jadwal', 'class' => 'w-2/12'],
            ['label' => 'Status', 'class' => 'w-2/12 text-center'],
            ['label' => 'Action', 'class' => 'w-40 text-center'],
        ];


        $meetings = Meeting::query()
            ->with(['student', 'counselor', 'counselingType'])
            ->filter(MeetingFilter::class)
            ->orderBy('meeting_time', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('appointments.riwayat', compact('meetings', 'breadcrumbs', 'tableHeaders'));
    }

    /**
     * untuk show appointment untuk konselor
     */
    public function showAppointment(Meeting $meeting)
    {
        if($meeting->counselor_id !== Auth::id()) {
            abort(403);
        } 

        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => dashboardRoute()],
            ['name' => 'Appointment', 'url' => route('appointments.counselor')],
            ['name' => 'Show Appointment', 'url' => null],
        ];
        if ($meeting->kuesioner_id != '') {
            $linkKuesioner = '<a href="/detail-questionnaire/' . $meeting->kuesioner_id . '" class="text-blue-500 hover:text-blue-600">Lihat Data</a>';
        } else {
            $linkKuesioner = '-';
        }
        $fieldsMeetings = [
            ['label' => 'Pasien', 'value' => $meeting->student->name],
            ['label' => 'Topics', 'value' => $meeting->topics],
            ['label' => 'Jenis Konseling', 'value' => $meeting->counselingType->name],
            ['label' => 'Status', 'value' => $meeting->status],
            ['label' => 'No. Telp', 'value' => $meeting->student->phone],
            ['label' => 'Student Notes', 'value' => $meeting->student_notes],
            ['label' => 'Data Tambahan (Kuesioner)', 'value' => $linkKuesioner],
            ['label' => 'Appointment Time', 'value' => $meeting->meeting_time],
            ['label' => 'Created At', 'value' => $meeting->created_at],
            ['label' => 'Updated At', 'value' => $meeting->updated_at],
        ];

        return view('appointments.show-appointment', compact('breadcrumbs', 'fieldsMeetings', 'meeting'));
    }
    public function refleksiDiri(Meeting $meeting)
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => dashboardRoute()],
            ['name' => 'Appointment', 'url' => null],
            ['name' => 'Reflection', 'url' => null],
        ];
        // if ($meeting->id) {
        //     // Cek apakah Auth::id sama dengan $kuesioner->user_id
        //     $kuesionerId = $request->kuesionerId;
        //     $kuesioner = Questionnaire::find($kuesionerId);
        //     if ($kuesioner->user_id !== Auth::id()) {
        //         return redirect()->route('appointments.select-type')->with('error', 'Dilarang Mengakses ID Kuesioner Orang Lain !!!');
        //     } else {
        //         $kuesionerId = $request->kuesionerId;
        //         return view('questionnaire.refleksi', compact('kuesionerId'));
        //     }
        // } else {
        //     return redirect()->route('appointments.select-type')->with('error', 'Isi Kuesioner Terlebih Dahulu!');
        // }
        $meetingId = $meeting->id;
        return view('appointments.refleksiDiri', compact('meetingId', 'breadcrumbs'));
    }
    public function storeRefleksiDiri(Request $request, Meeting $meeting)
    {
        ini_set('max_execution_time', 180); // 2 menit // for development only
        // dd($request->all());
        $meeting = Meeting::findOrFail($meeting->id);

        // Pastikan datanya ketemu
        if (!$meeting) {
            return back()->with('error', 'Data meeting tidak ditemukan.');
        }

        $refleksis = $request->input('refleksiDiri'); // array refleksi 1–10

        // untuk Hasil nantinya
        $results = [];
        $totalScore = 0;

        $analysis = $this->gemini->analyzeRefleksiBatch($refleksis);
        // Hitung total skor dari semua refleksi
        $totalScore = collect($analysis)->sum('score');

        $meeting->update([
            'reflections' => $refleksis,
            'reflection_results' => $analysis,
            'total_score_reflection' => $totalScore,
        ]);

        return redirect()
            ->route('appointments.refleksiResult', $meeting->id)
            ->with('success', 'Berhasil menambahkan refleksi pribadi..');
    }

    public function refleksiResult(Meeting $meeting)
    {
        $user = Auth::user();
        if ($meeting->student_id !== $user->id) {
            return redirect()->route('dashboard.userDashboard')->with('error', 'Data yang anda akses bukan milik anda.');
        } else {
            $refleksis = $meeting->reflections;
            if (empty($refleksis)) {
                return redirect()->route('summary.show', $meeting->id)->with('error', 'Tidak ada data refleksi.');
            } else {
                $reflectionResults = $meeting->reflection_results;
                return view('appointments.refleksiResult', compact('refleksis', 'reflectionResults'));
            }
        }
    }
}
