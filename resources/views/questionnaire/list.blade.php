<x-layouts.app>

    <x-partials.breadcrumbs :items="$breadcrumbs" />

    <x-partials.header title="Daftar Kuesioner" description="Riwayat Kuesioner yang sudah pernah anda isi sebelumnya." />

    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            {{ session('success') }}
        </div>
    @endif

    <x-tables.table-main :headers="$tableHeaders" :rows="$kuesioners->map(function ($kuesioner, $index) use ($kuesioners) {
        return [
            'no' => $index + 1 + ($kuesioners->currentPage() - 1) * $kuesioners->perPage(),
            'Attempted Date' => $kuesioner->created_at,
            'actions' => view('questionnaire.partials._actions', compact('kuesioner'))->render(),
        ];
    })" />

    <div class="mt-5">
        {{ $kuesioners->links() }}
    </div>

</x-layouts.app>
