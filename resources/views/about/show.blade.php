<x-home.app>
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-8 md:p-12">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                    {{-- Kolom Foto --}}
                    <div class="md:col-span-1 text-center">
                        <img class="w-48 h-48 rounded-full mx-auto object-cover shadow-xl"
                            src="{{ optional($user->counselor)->profile_photo_path ? Storage::url($user->counselor->profile_photo_path) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random&size=256' }}"
                            alt="Photo of {{ $user->name }}">
                    </div>

                    {{-- Kolom Nama dan Spesialisasi --}}
                    <div class="md:col-span-2 text-center md:text-left">
                        <h1 class="text-4xl font-bold text-gray-900">{{ $user->name }}</h1>
                        <p class="text-unida-blue font-semibold mt-2">
                            {{ $user->specializations->pluck('name')->join(' • ') ?: 'Professional Counselor' }}
                        </p>
                    </div>
                </div>

                <hr class="my-8">

                {{-- Kolom Bio --}}
                <div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">About</h3>
                    <div class="prose max-w-none text-gray-600">
                        {!! nl2br(e(optional($user->counselor)->bio)) ?: 'No biography available yet.' !!}
                    </div>
                </div>

                {{-- Kolom Riwayat Pendidikan --}}
                @if (optional($user->counselor)->education_history)
                    <div class="mt-8">
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Education History</h3>
                        <ul class="list-disc list-inside space-y-2">
                            @foreach ($user->counselor->education_history as $edu)
                                <li class="text-gray-600">
                                    <span class="font-semibold">{{ $edu['gelar'] }}</span> - {{ $edu['universitas'] }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </section>

</x-home.app>
