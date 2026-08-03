<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\SessionSummary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SummaryController extends Controller
{
    /**
     * menampilkan form untuk isi resume appointment
     */
    public function create(Meeting $meeting)
    {

        // dd($meeting);
        if ($meeting->counselor_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403);
        }

        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => dashboardRoute()],
            ['name' => 'Appointment', 'url' => route('appointments.counselor')],
            ['name' => 'Create Summary', 'url' => null],
        ];

        if ($meeting->counselor_id !== Auth::id() && $meeting->status !== 'approved' && $meeting->summary && !Auth::user()->hasRole('admin')) {
            abort(403, 'Aksi Tidak Diizinkan');
        }

        // $summary = $meeting->summary;
        $summary = $meeting->summary;
        if ($meeting->kuesioner_id != '') {
            $linkKuesioner = '<a href="/detail-questionnaire/' . $meeting->kuesioner_id . '" class="text-blue-500 hover:text-blue-600">Lihat Data</a>';
        } else {
            $linkKuesioner = '-';
        }
        $fieldsMeetings = [
            ['label' => 'Pasien', 'value' => $meeting->student->name],
            ['label' => 'Topics', 'value' => $meeting->topics],
            ['label' => 'Jenis Konseling', 'value' => $meeting->counselingType->name],
            ['label' => 'Data Tambahan (Kuesioner)', 'value' => $linkKuesioner],
            ['label' => 'Status', 'value' => $meeting->status],
            ['label' => 'Student Notes', 'value' => $meeting->student_notes],
        ];

        return view('summary.create', compact('meeting', 'breadcrumbs', 'fieldsMeetings'));
    }

    /**
     * untuk menyimpan create summary
     */
    public function store(Request $request, Meeting $meeting)
    {
        if ($meeting->counselor_id !== Auth::id() || $meeting->status !== 'approved' || $meeting->summary) {
            abort(403, 'Aksi tidak diizinkan');
        }

        $validated = $request->validate([
            'summary' => 'required|string|min:10',
            'recommendations' => 'required|string|min:10',
        ]);

        $meeting->summary()->create([
            'counselor_id' => Auth::id(),
            'student_id' => $meeting->student_id,
            'summary' => $validated['summary'],
            'recommendations' => $validated['recommendations'],
        ]);

        $meeting->update([
            'status' => 'completed',
        ]);

        return redirect()->route('appointments.riwayatCounselor')->with('success', 'Resume sesi berhasil dibuat.');
    }

    /**
     * show hasil summary untuk mahasiswa
     */
    public function show(Meeting $meeting)
    {
        // dd([
        //     'Meeting Counselor ID' => $meeting->counselor_id,
        //     'Meeting Student ID'   => $meeting->student_id,
        //     'Logged-in User ID'  => Auth::id()
        // ]);

        if ($meeting->counselor_id !== Auth::id() && $meeting->student_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403);
        }

        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => dashboardRoute()],
            ['name' => 'Appointment', 'url' => route('appointments.counselor')],
            ['name' => 'Show Summary', 'url' => null],
        ];

        $summary = $meeting->summary;
        if (!$summary) {
            abort(404, 'Data meeting tidak ditemukan');
        }
        if ($meeting->kuesioner_id != '') {
            $linkKuesioner = '<a href="/detail-questionnaire/' . $meeting->kuesioner_id . '" class="text-blue-500 hover:text-blue-600">Lihat Data</a>';
        } else {
            $linkKuesioner = '-';
        }
        $fieldsMeetings = [
            ['label' => 'Pasien', 'value' => $summary->student->name ?? '-'],
            ['label' => 'Topics', 'value' => $summary->meeting->topics ?? '-'],
            ['label' => 'Jenis Konseling', 'value' => $summary->meeting->counselingType->name ?? '-'],
            ['label' => 'Data Tambahan (Kuesioner)', 'value' => $linkKuesioner ?? '-'],
            ['label' => 'Status', 'value' => $summary->meeting->status ?? '-'],
            ['label' => 'Student Notes', 'value' => $summary->meeting->student_notes ?? '-'],
        ];

        $fieldsSummary = [
            ['label' => 'Rangkuman Sesi', 'value' => $summary->summary ?? '-'],
            ['label' => 'Saran', 'value' => $summary->recommendations ?? '-']
        ];

        return view('summary.show', compact('meeting', 'breadcrumbs', 'summary', 'fieldsSummary', 'fieldsMeetings'));
    }

    /**
     * edit hasil summary
     */
    public function edit(Meeting $meeting)
    {
        if ($meeting->counselor_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403);
        }

        $meeting->load('student', 'summary');

        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => dashboardRoute()],
            ['name' => 'Appointment', 'url' => route('appointments.counselor')],
            ['name' => 'Edit Summary', 'url' => null],
        ];

        // dd($meeting);
        return view('summary.edit', compact('breadcrumbs', 'meeting'));
    }

    /**
     * untuk menyimpan update
     */
    public function updateSummary(Request $request, Meeting $meeting)
    {
        if ($meeting->counselor_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403);
        }

        $validated = $request->validate([
            'summary' => 'required|string|min:10',
            'recommendations' => 'required|string|min:10',
        ]);

        $meeting->summary()->updateOrCreate([], $validated);

        return redirect("/appointments/{$meeting->id}/summary")->with('success', 'Catatan berhasil diperbarui');
    }
}
