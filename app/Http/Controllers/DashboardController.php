<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class DashboardController extends Controller
{
    public function adminDashboard(Request $request)
    {
        // pasien
        $totalPasien = User::role('mahasiswa')->count();
        $newPasienBulanIni = User::role('mahasiswa')->whereMonth('created_at', now()->month())->count();
        $newPasienTerakhirBulanIni = User::role('mahasiswa')->whereMonth('created_at', now()->subMonth())->count();

        $presentasePasienTumbuh = 0;
        if ($newPasienTerakhirBulanIni > 0) {
            $presentasePasienTumbuh = (($newPasienBulanIni - $newPasienTerakhirBulanIni) / $newPasienTerakhirBulanIni) * 100;
        }

        //appointment
        $appointmentSelesaiBulanIni = Meeting::where('status', 'completed')->whereMonth('meeting_time', now()->month)->count();
        $appointmentSelesaiBulanLalu = Meeting::where('status', 'completed')->whereMonth('meeting_time', now()->subMonth()->month)->count();

        $presentasiAppointmentTumbuh = 0;
        if ($appointmentSelesaiBulanLalu > 0) {
            $presentasiAppointmentTumbuh = 
                (($appointmentSelesaiBulanIni - $appointmentSelesaiBulanLalu) / $appointmentSelesaiBulanLalu) * 100;
        }

        // konselor, (Average Sesi per Konselor)
        $totalKonselor = User::role('konselor')->count();
        $sessionsThisMonth = Meeting::whereMonth('meeting_time', now()->month)->whereYear('meeting_time', now()->year)->count();
        $activeCounselorsThisMonth = Meeting::whereMonth('meeting_time', now()->month)->whereYear('meeting_time', now()->year)->distinct('counselor_id')->count('counselor_id');

        $presentasiKonselorAktif = $activeCounselorsThisMonth > 0 ? $sessionsThisMonth / $activeCounselorsThisMonth : 0;

        // konselor teraktif
        $konselorTeraktif = Meeting::query()
            ->where('status', 'completed')
            ->where('meeting_time', '>=', now()->subDays(30))
            ->select('counselor_id', DB::raw('count(*) as completed_sessions'))
            ->groupBy('counselor_id')
            ->orderBy('completed_sessions', 'desc')
            ->limit(5)
            ->with('counselor.specializations')
            ->get();

        // recent appointment
        $recentAppointments = Meeting::query()
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->with(['student', 'counselor'])
            ->get();

        return view('dashboard.admin-dashboard', compact(
            'totalPasien',
            'presentasePasienTumbuh',
            'appointmentSelesaiBulanIni',
            'presentasiAppointmentTumbuh',
            'totalKonselor',
            'presentasiKonselorAktif',
            'konselorTeraktif',
            'recentAppointments',
        ));
    }

    public function adminChartDashboard(Request $request)
    {
        $type = $request->query('type', 'daily_activity');
        $data = [];

        switch ($type) {
            case 'status_distribution':
                $stats = Meeting::query()
                    ->select('status', DB::raw('count(*) as count'))
                    // ->where('status', 'completed')
                    ->groupBy('status')
                    ->get();
                $data['series'] = $stats->pluck('count');
                $data['labels'] = $stats->pluck('status');

                // dd($data);
                break;
            case 'counselor_workload':
                $stats = Meeting::query()
                    ->select('counselor_id', DB::raw('count(*) as count'))
                    ->where('status', 'completed')
                    ->groupBy('counselor_id')
                    ->with('counselor:id,name')
                    ->get();
                $data['series'] = $stats->pluck('count');
                $data['labels'] = $stats->pluck('counselor.name');
                break;
            case 'daily_activity':
            default:
                $stats = Meeting::query()
                    ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
                    ->where('created_at', '>=', now()->subDays(30))
                    ->groupBy('date')
                    ->orderBy('date', 'asc')
                    ->get();
                $data['series'] = $stats->pluck('count');
                $data['labels'] = $stats->pluck('date');
                break;
        }

        return response()->json($data);
    }

    public function counselorDashboard()
    {
        $counselorId = Auth::id();

        // permintaan baru 
        $newRequestsCount = Meeting::where('counselor_id', $counselorId)
            ->where('status', 'pending')
            ->count();

        // sesi selesai bulan ini
        $completedSessionsThisMonth = Meeting::where('counselor_id', $counselorId)
            ->where('status', 'completed')
            ->whereMonth('meeting_time', now())
            ->whereYear('meeting_time', now())
            ->count();

        $completedSesionsLastMonth = Meeting::where('counselor_id', $counselorId)
            ->where('status', 'completed')
            ->whereMonth('meeting_time', now()->subMonth())
            ->whereYear('meeting_time', now()->subMonth())
            ->count();

        $sessionGrowthPercentage = 0;
        if ($completedSesionsLastMonth > 0) {
            $sessionGrowthPercentage = (($completedSessionsThisMonth - $completedSesionsLastMonth) / $completedSesionsLastMonth) * 100;
        }

        // total pasien
        $totalUniquePatients = Meeting::where('counselor_id', $counselorId)
                ->distinct('student_id')
                ->count('student_id');

        $newPatientsThisMonth = Meeting::where('counselor_id', $counselorId)->whereMonth('created_at', now())->distinct('student_id')->count();
        $newPatientsLastMonth = Meeting::where('counselor_id', $counselorId)->whereMonth('created_at', now()->subMonth())->distinct('student_id')->count();
        
        $patientGrowthPercentage = 0;
        if ($newPatientsLastMonth > 0) {
            $patientGrowthPercentage = (($newPatientsThisMonth - $newPatientsLastMonth) / $newPatientsLastMonth) * 100;
        }

        return view('dashboard.counselor-dashboard', compact(
            'newRequestsCount',
            'completedSessionsThisMonth',
            'sessionGrowthPercentage',
            'totalUniquePatients',
            'patientGrowthPercentage'
        ));
    }

    public function counselorChartDashboard(Request $request)
    {
        $counselorId = Auth::id();
        $type = $request->query('type', 'session_activity');
        $data = [];

        switch ($type) {
            // jenis layanan
            case 'service_distribution':
                $stats = Meeting::query()
                    ->select('counseling_type_id', DB::raw('count(*) as count'))
                    ->where('counselor_id', $counselorId)
                    ->where('status', 'completed') // Hitung hanya sesi yang selesai
                    ->groupBy('counseling_type_id')
                    ->with('counselingType:id,name') // Ambil nama layanannya
                    ->get();
                
                $data['series'] = $stats->pluck('count')->toArray();
                $data['labels'] = $stats->pluck('counselingType.name')->toArray();
                break;

            // appointment saya
            case 'status_pipeline':
                $stats = Meeting::query()
                    ->select('status', DB::raw('count(*) as count'))
                    ->where('counselor_id', $counselorId)
                    ->groupBy('status')
                    ->get();

                $data['series'] = $stats->pluck('count')->toArray();
                $data['labels'] = $stats->pluck('status')->map(fn($status) => ucfirst($status))->toArray();
                break;

            // semua
            case 'session_activity':
            default:
                $stats = Meeting::query()
                    ->select(DB::raw('DATE(meeting_time) as date'), DB::raw('count(*) as count'))
                    ->where('counselor_id', $counselorId)
                    ->where('status', 'completed')
                    ->where('meeting_time', '>=', now()->subDays(30))
                    ->groupBy('date')
                    ->orderBy('date', 'asc')
                    ->get();

                $data['series'] = $stats->pluck('count')->toArray();
                $data['labels'] = $stats->pluck('date')->toArray();
                break;
        }

        return response()->json($data);
    }

    public function userDashboard()
    {
        $studentId = Auth::id();

        // appointment yuan akan datang
        $upcomingAppointmentsCount = Meeting::where('student_id', $studentId)
            ->where('status', 'approved')
            ->where('meeting_time', '>', now())
            ->count();

        // permintaan menunggu
        $pendingRequestsCount = Meeting::where('student_id', $studentId)
            ->where('status', ['pending', 'counselor_reschedule'])
            ->count();

        // total appointment selesai
        $completedSessionsCount = Meeting::where('student_id', $studentId)
            ->where('status', 'completed')
            ->count();

        return view('dashboard.user-dashboard', compact(
            'upcomingAppointmentsCount',
            'pendingRequestsCount',
            'completedSessionsCount',
        ));
    }

    public function userChartDashboard(Request $request)
    {
        $studentId = Auth::id();
        $type = $request->query('type', 'session_frequency');
        $data = [];

        switch ($type) {
            // Data untuk Tab 2: "Jenis Layanan Digunakan"
            case 'service_distribution':
                $stats = Meeting::query()
                    ->select('counseling_type_id', DB::raw('count(*) as count'))
                    ->where('student_id', $studentId)
                    ->groupBy('counseling_type_id')
                    ->with('counselingType:id,name')
                    ->get();
                
                $data['series'] = $stats->pluck('count')->toArray();
                $data['labels'] = $stats->pluck('counselingType.name')->toArray();
                break;

            // Data untuk Tab 3: "Sesi per Konselor"
            case 'sessions_per_counselor':
                $stats = Meeting::query()
                    ->select('counselor_id', DB::raw('count(*) as count'))
                    ->where('student_id', $studentId)
                    ->where('status', 'completed')
                    ->groupBy('counselor_id')
                    ->with('counselor:id,name')
                    ->get();

                $data['series'] = $stats->pluck('count')->toArray();
                $data['labels'] = $stats->pluck('counselor.name')->toArray();
                break;

            // Data untuk Tab 1: "Frekuensi Sesi Saya" (Default)
            case 'session_frequency':
            default:
                $stats = Meeting::query()
                    ->select(DB::raw('YEAR(meeting_time) as year, MONTH(meeting_time) as month'), DB::raw('count(*) as count'))
                    ->where('student_id', $studentId)
                    ->where('status', 'completed')
                    ->where('meeting_time', '>=', now()->subMonths(6))
                    ->groupBy('year', 'month')
                    ->orderBy('year', 'asc')->orderBy('month', 'asc')
                    ->get();
                
                $data['series'] = $stats->pluck('count')->toArray();
                // Format label menjadi "Nama Bulan Tahun"
                $data['labels'] = $stats->map(function ($item) {
                    return Carbon::createFromDate($item->year, $item->month)->format('M Y');
                })->toArray();
                break;
        }

        return response()->json($data);
    }
}
