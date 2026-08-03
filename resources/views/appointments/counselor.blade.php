<x-layouts.app>
    <x-partials.breadcrumbs :items="$breadcrumbs" />

    <x-partials.header title="Permintaan Appointment"
        description="Terima atau Tolak permintaan janji temu dengan pasien" />

    <x-tables.table-main :headers="$tableHeaders" :rows="$pendingMeetings->map(function ($meeting, $index) use ($pendingMeetings) {
        return [
            'no' => $index + 1 + ($pendingMeetings->currentPage() - 1) * $pendingMeetings->perPage(),
            'pasien' => $meeting->student->name ?? 'N/A',
            'No. Telp' => $meeting->student->phone ?? '-',
            'layanan' => $meeting->counselingType->name ?? 'N/A',
            'jadwal diajukan' => \Carbon\Carbon::parse($meeting->meeting_time)->format('d M Y, H:i'),
            'topics' => $meeting->topics,
            // 'catatan' => $meeting->student_notes ?: '-',
            'actions' => view('appointments.partials._actions', compact('meeting'))->render(),
        ];
    })" />

    <div class="mt-6">
        {{ $pendingMeetings->links() }}
    </div>

</x-layouts.app>
