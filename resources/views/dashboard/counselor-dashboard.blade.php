<x-layouts.app>
    <div class="p-4 md:p-6">
        @if (session('error'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                {{ session('error') }}
            </div>
        @endif
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Selamat Datang,
                <span class="font-bold">{{ Auth::user()->name }}</span>
            </h1>
            <p class="text-gray-500 dark:text-gray-400">Berikut adalah ringkasan aktivitas sistem hari ini,
                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}.</p>
        </div>

        {{-- metric group --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            @include('dashboard.partials._metric-group-1')
            @include('dashboard.partials._metric-group-2')
            @include('dashboard.partials._metric-group-3')
        </div>

        {{-- chart --}}
        <div class="mb-6">
            {{-- @role('admin|super admin')
            @include('dashboard.partials._chart-1')
            @endrole --}}

            @role('konselor')
                @include('dashboard.partials._chart-2')
            @endrole
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div>
                {{-- @include('dashboard.partials._table-1') --}}
            </div>
            <div>
                {{-- @include('dashboard.partials._table-2') --}}
            </div>
        </div>

    </div>
</x-layouts.app>
