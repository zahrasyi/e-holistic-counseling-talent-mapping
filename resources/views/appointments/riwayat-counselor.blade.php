<x-layouts.app>
    <x-partials.breadcrumbs :items="$breadcrumbs" />

    <x-partials.header title="Riwayat Pengajuan Konseling" description="Riwayat Pengajuan Konseling disini." />

    <x-tables.table-filter :fields="[
        'student_name',
        'counselor_name',
        'status',
        'meeting_time',
        'topics',
        'counseling_type',
        'counselor_proposed_time',
    ]" :action="route('appointments.riwayatCounselor')" />

    <x-tables.table-main :headers="$tableHeaders" :rows="$meetings->map(function ($meeting, $index) use ($meetings) {
        return [
            'no' => $index + 1 + ($meetings->currentPage() - 1) * $meetings->perPage(),
            'pasient' => $meeting->student->name ?? 'N/A',
            'No. Telp' => $meeting->student->phone ?? '-',
            'service' => $meeting->counselingType->name ?? 'N/A',
            'schedule' => \Carbon\Carbon::parse($meeting->meeting_time)->format('d M Y, H:i'),
            'Jadwal Reschedule' => \Carbon\Carbon::parse($meeting->counselor_proposed_time)->format('d M Y, H:i'),
            'status' => view('appointments.partials._status-badge', compact('meeting')),
            'actions' => view('summary.partials._actions', compact('meeting'))->render(),
        ];
    })" />

    <div class="mt-6">
        {{ $meetings->links() }}
    </div>

</x-layouts.app>
