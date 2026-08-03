<x-layouts.app>
    <x-partials.breadcrumbs :items="$breadcrumbs" />

    <x-partials.header title="Permintaan Appointment" description="List pengajuan anda yang masih belum di approved" />

    <x-tables.table-main :headers="$tableHeaders" :rows="$pendingMeetings->map(function ($meeting, $index) use ($pendingMeetings) {
        return [
            'no' => $index + 1 + ($pendingMeetings->currentPage() - 1) * $pendingMeetings->perPage(),
            'konselor' => $meeting->counselor->name ?? 'N/A',
            'No. Telp' => $meeting->counselor->phone ?? '-',
            'layanan' => $meeting->counselingType->name ?? 'N/A',
            'jadwal diajukan' => \Carbon\Carbon::parse($meeting->meeting_time)->format('d M Y, H:i'),
            'topics' => $meeting->topics ?? 'N/A',
            'status' => view('appointments.partials._status-badge', compact('meeting')),
            // 'catatan' => $meeting->student_notes ?: '-',
            // 'actions' => view('appointments.partials._actions', compact('meeting'))->render(),
        ];
    })" />

    <div class="mt-6">
        {{ $pendingMeetings->links() }}
    </div>

</x-layouts.app>
