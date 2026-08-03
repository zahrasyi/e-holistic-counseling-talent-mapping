<x-layouts.app>
    <x-partials.breadcrumbs :items="$breadcrumbs" />

    <x-partials.header title="Approved Pengajuan Konseling" description="Pengajuan konseling yang sudah di approved" />

    <x-tables.table-main :headers="$tableHeaders" :rows="$approvedMeetings->map(function ($meeting, $index) use ($approvedMeetings) {
        return [
            'no' => $index + 1 + ($approvedMeetings->currentPage() - 1) * $approvedMeetings->perPage(),
            'konselor' => $meeting->counselor->name ?? 'N/A',
            'No. Telp' => $meeting->counselor->phone ?? '-',
            'service' => $meeting->counselingType->name ?? 'N/A',
            'schedule' => \Carbon\Carbon::parse($meeting->meeting_time)->format('d M Y, H:i'),
            'Jadwal Reschedule' => \Carbon\Carbon::parse($meeting->counselor_proposed_time)->format('d M Y, H:i'),
            'status' => view('appointments.partials._status-badge', compact('meeting')),
        ];
    })" />

    <div class="mt-6">
        {{ $approvedMeetings->links() }}
    </div>

</x-layouts.app>
