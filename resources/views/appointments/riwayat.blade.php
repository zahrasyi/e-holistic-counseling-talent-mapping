<x-layouts.app>

    <x-partials.breadcrumbs :items="$breadcrumbs" />

    <x-partials.header title="Riwayat Appointment" description="Table semua riwayat appointment." />

    <x-tables.table-filter :fields="['student_name', 'counselor_name', 'status', 'meeting_time', 'topics']" :action="route('appointments.riwayat')" />

    <x-tables.table-main :headers="$tableHeaders" :rows="$meetings->map(function ($meeting, $index) use ($meetings) {
        return [
            'no' => $index + 1 + ($meetings->currentPage() - 1) * $meetings->perPage(),
            'student' => $meeting->student->name ?? 'N/A',
            'counselor' => $meeting->counselor->name ?? 'N/A',
            'schedule' => \Carbon\Carbon::parse($meeting->meeting_time)->format('d M Y, H:i'),
            'status' => view('appointments.partials._status-badge', compact('meeting')),
            'actions' => view('summary.partials._actions', compact('meeting'))->render(),
        ];
    })" />

    <div class="mt-6">
        {{ $meetings->links() }}
    </div>

</x-layouts.app>
