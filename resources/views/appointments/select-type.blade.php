<x-layouts.app>

    <x-partials.breadcrumbs :items="$breadcrumbs" />


    <x-partials.header title="Layanan Konseling"
        description="Silakan pilih jenis layanan konseling yang Anda butuhkan." />

    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @php
        $kuesioners = auth()->user()->kuesioners;
        $countKuesioner = count($kuesioners);
    @endphp


    <p class="text-sm mb-6 ms-2 text-zinc-600 dark:text-zinc-400">Jika anda bingung dalam memilih jenis layanan,
        silahkan <a href="{{ route('questionnaire.index') }}" class="text-blue-400 hover:text-blue-600">isi
            Kuesioner</a>
        terlebih
        dahulu untuk membantu anda dalam memilih jenis layanan</p>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 w-full">
        @forelse ($counselingTypes as $type)
            @php
                $image = $type->image
                    ? (filter_var($type->image, FILTER_VALIDATE_URL)
                        ? $type->image
                        : asset('storage/' . $type->image))
                    : 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=800&q=80';
            @endphp


            <div
                class="bg-white border border-gray-200 rounded-2xl shadow-md overflow-hidden dark:bg-gray-800 dark:border-gray-700
                   transform transition-all duration-300 ease-in-out hover:shadow-xl hover:-translate-y-2">

                <a href="{{ route('appointments.create', $type) }}" class="block">
                    <img class="w-full h-56 object-cover transition duration-300 ease-in-out hover:opacity-90"
                        src="{{ $image }}" alt="{{ $type->name }}">
                </a>

                <div class="p-6 flex flex-col justify-between min-h-[220px]">
                    <div>
                        <a href="{{ route('appointments.create', $type) }}">
                            <h5
                                class="mb-2 text-xl font-semibold tracking-tight text-gray-900 dark:text-white line-clamp-1">
                                {{ $type->name }}
                            </h5>
                        </a>
                        <p class="mb-4 text-gray-700 dark:text-gray-400 text-sm line-clamp-3">
                            {{ $type->description ?? 'Deskripsi layanan belum tersedia.' }}
                        </p>
                    </div>

                    <a href="{{ route('appointments.create', $type) }}"
                        class="inline-flex items-center justify-center px-4 py-2 mt-auto text-sm font-medium text-white
                      bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none
                      focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800
                      transition duration-300 ease-in-out">
                        Lihat Detail
                        <svg class="w-4 h-4 ml-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>
            </div>

        @empty
            <div class="col-span-full text-center py-12 px-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-700 dark:text-white">Layanan Tidak Tersedia</h3>
                <p class="text-gray-500 dark:text-gray-400 mt-2">
                    Mohon maaf, saat ini belum ada jenis layanan konseling yang tersedia.
                </p>
            </div>
        @endforelse
    </div>

</x-layouts.app>
