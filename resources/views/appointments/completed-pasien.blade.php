<x-layouts.app>
    <x-partials.breadcrumbs :items="$breadcrumbs" />

    <x-partials.header title="Approved Pengajuan Konseling" description="Pengajuan konseling yang sudah di approved" />

    <x-tables.table-main :headers="$tableHeaders" :rows="$completedMeetings->map(function ($meeting, $index) use ($completedMeetings) {
        return [
            'no' => $index + 1 + ($completedMeetings->currentPage() - 1) * $completedMeetings->perPage(),
            'konselor' => $meeting->counselor->name ?? 'N/A',
            'No. Telp' => $meeting->counselor->phone ?? '-',
            'service' => $meeting->counselingType->name ?? 'N/A',
            'schedule' => \Carbon\Carbon::parse($meeting->meeting_time)->format('d M Y, H:i'),
            'Jadwal Reschedule' => \Carbon\Carbon::parse($meeting->counselor_proposed_time)->format('d M Y, H:i'),
            'status' => view('appointments.partials._status-badge', compact('meeting')),
            'actions' => view('summary.partials._actions', compact('meeting'))->render(),
        ];
    })" />

    <div class="mt-6">
        {{ $completedMeetings->links() }}
    </div>

</x-layouts.app>
