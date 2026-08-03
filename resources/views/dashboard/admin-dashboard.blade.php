<x-layouts.app>
    <div class="p-4 md:p-6">

        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Selamat Datang, Admin!</h1>
            <p class="text-gray-500 dark:text-gray-400">Berikut adalah ringkasan aktivitas sistem hari ini,
                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}.</p>
        </div>

        {{-- metric group  --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            @include('dashboard.partials._metric-group-1')
            @include('dashboard.partials._metric-group-2')
            @include('dashboard.partials._metric-group-3')
            @include('dashboard.partials._metric-group-4')
        </div>

        {{-- chart --}}
        <div class="mb-6">
            @include('dashboard.partials._chart-1')
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div>
                @include('dashboard.partials._table-1')
            </div>
            <div>
                @include('dashboard.partials._table-2')
            </div>
        </div>

    </div>
</x-layouts.app>
