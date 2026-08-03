<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name', 'HolisticCounseling') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('asset/homepage/logo-unida.png') }}">
    {{-- Tailwind & Flowbite --}}
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <!-- Wrapper: Navbar + Main -->
        <div class="flex flex-1 flex-col">
            <!-- Navbar -->
            <nav
                class="bg-tertiary dark:bg-gray-800 shadow px-4 py-3 flex items-center justify-between border-b border-slate-300">
                <div class="flex items-center space-x-2">
                    <!-- Toggle Sidebar Mobile -->
                    <button data-drawer-target="sidebar" data-drawer-toggle="sidebar" aria-controls="sidebar"
                        class="md:hidden p-2 text-gray-500 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                        ☰
                    </button>

                    <a href="{{ route('dashboard.userDashboard') }}"
                        class="ms-5 text-lg font-semibold text-gray-700 dark:text-gray-200 hover:text-blue-500">
                        &leftarrow; Dashboard </a>
                </div>

                <div class="flex items-center space-x-4">
                    <button id="theme-toggle" type="button"
                        class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                        <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                fill-rule="evenodd" clip-rule="evenodd"></path>
                        </svg>
                    </button>

                    <!-- Profile Dropdown -->
                    <div x-data="{ open: false }" @click.away="open = false" class="relative">

                        <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random"
                                class="w-8 h-8 rounded-full" alt="{{ Auth::user()->name }}">
                            <span class="hidden md:block">{{ Auth::user()->name }}</span>

                            <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div x-show="open" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-700 rounded-md shadow-lg py-1 z-50"
                            style="display: none;" @click="open = false"> {{-- <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">Profile</a>
                            --}}

                            <a href="{{ route('profile.edit') }}" @click="open = false"
                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">
                                Profile
                            </a>

                            <a href="{{ route('home') }}" @click="open = false"
                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">
                                Home
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">
                                    Log Out
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="flex-1 p-6 bg-gray-50 dark:bg-gray-900">

                <x-partials.header title="Refleksi"
                    description="isi refleksi dibawah agar kamu dapat merenungi apa yang terjadi pada dirimu" />
                @php
                $steps = [
                [
                'slug' => 'refleksiBiologi',
                'title' => '(1/4) Kesehatan Biologis Islami',
                'questions' => [
                '1. Bagaimana saya memaknai tubuh saya sebagai amanah dari Allah?',
                '2. Kebiasaan buruk apa yang masih saya lakukan dan perlu saya tinggalkan demi kesehatan?',
                '3. Sudahkah saya menjaga kebersihan dan gaya hidup sehat sesuai tuntunan Islam?',
                '4. Apa hubungan antara tubuh yang sehat dengan semangat ibadah saya?',
                '5. Apa langkah pertama yang bisa saya lakukan untuk memperbaiki gaya hidup saya?',
                ],
                ],
                [
                'slug' => 'refleksiPsikologi',
                'title' => '(2/4) Kesehatan Psikologis Islami',
                'questions' => [
                '1. Perasaan apa yang paling sering saya rasakan akhir-akhir ini? Mengapa?',
                '2. Bagaimana saya mengelola stres atau tekanan batin? Apakah saya melibatkan Allah?',
                '3. Apa doa yang paling sering saya panjatkan dalam kondisi sulit?',
                '4. Sikap negatif apa yang ingin saya ubah agar lebih sehat secara psikologis dan Islami?',
                '5. Langkah kecil apa yang bisa saya lakukan untuk menenangkan hati saya hari ini?',
                ],
                ],
                [
                'slug' => 'refleksiSosial',
                'title' => '(3/4) Kesehatan Sosial Islami',
                'questions' => [
                '1. Bagian terbaik dari hubungan sosial saya adalah...',
                '2. Hal yang ingin saya perbaiki dalam pergaulan sosial saya adalah...',
                '3. Adakah seseorang yang pernah tersakiti karena saya? Apa yang bisa saya lakukan?',
                '4. Apa arti ukhuwah Islamiyah bagi saya dalam kehidupan sosial sehari-hari?',
                '5. Satu langkah kecil yang bisa saya lakukan minggu ini untuk memperbaiki hubungan sosial saya...',
                ],
                ],
                [
                'slug' => 'refleksiSpiritual',
                'title' => '(4/4) Kesehatan Spiritual Islami',
                'questions' => [
                '1. Kapan terakhir kali saya merasakan kedekatan mendalam dengan Allah?',
                '2. Apa yang paling sering membuat saya lalai dalam menjaga hubungan spiritual dengan Allah?',
                '3. Ibadah apa yang paling membantu saya menenangkan hati?',
                '4. Apa satu langkah konkrit yang bisa saya lakukan pekan ini untuk meningkatkan kesehatan spiritual
                saya?',
                '5. Siapa sosok atau kisah inspiratif yang memotivasi saya untuk mendekatkan diri pada Allah?',
                ],
                ],
                ];
                @endphp
                <form id="refleksi12Form" action="{{ route('questionnaire.storeRefleksi', $kuesionerId) }}"
                    method="POST">
                    @csrf
                    <input type="hidden" name="kuesionerId" value={{ $kuesionerId }}>
                    @foreach ($steps as $step)
                    <div class="step hidden">
                        <h2 class="text-xl font-semibold mb-4">{{ $step['title'] }}</h2>
                        @foreach ($step['questions'] as $q)
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-medium">{{ $q }}</label>
                            <textarea rows="2" name="{{ $step['slug'] }}[{{ $loop->iteration }}]"
                                placeholder="Tuliskan refleksimu..."
                                class="w-full p-2 rounded-lg border border-gray-300 bg-gray-50 dark:bg-gray-700 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500"></textarea>
                        </div>
                        @endforeach
                    </div>
                    @endforeach

                    <div class="mt-6 flex justify-center items-center">
                        <button type="button" id="prevBtn"
                            class="hidden mx-2 px-4 py-2 bg-gray-300 dark:bg-gray-700 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-600 active:scale-95 transition-all">Kembali</button>

                        <button type="button" id="nextBtn"
                            class="mx-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 dark:hover:bg-blue-500 active:scale-95 transition-all">Lanjut</button>

                        <button type="submit" id="submitBtn"
                            class="hidden mx-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 dark:hover:bg-green-500 active:scale-95 transition-all">Kirim</button>
                    </div>
                </form>

            </main>
        </div>
    </div>

    {{-- Flowbite JS --}}
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    {{-- Script Navigasi Halaman --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {
        const steps = document.querySelectorAll(".step");
        const prevBtn = document.getElementById("prevBtn");
        const nextBtn = document.getElementById("nextBtn");
        const submitBtn = document.getElementById("submitBtn");
        let current = 0;

        function showStep(index) {
            steps.forEach((s, i) => s.classList.toggle("hidden", i !== index));
            prevBtn.classList.toggle("hidden", index === 0);
            nextBtn.classList.toggle("hidden", index === steps.length - 1);
            submitBtn.classList.toggle("hidden", index !== steps.length - 1);
            window.scrollTo({ top: 0, behavior: "smooth" });
        }

        nextBtn.addEventListener("click", () => {
            if (current < steps.length - 1) {
                current++;
                showStep(current);
            }
        });

        prevBtn.addEventListener("click", () => {
            if (current > 0) {
                current--;
                showStep(current);
            }
        });

        showStep(current);
    });
    </script>

    {{-- navbar script --}}
    <script>
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        // Change the icons inside the button based on previous settings
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        themeToggleBtn.addEventListener('click', function() {

            // toggle icons inside button
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            // if set via local storage previously
            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }

                // if NOT set via local storage previously
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }

        });
    </script>

    {{-- Dark mode toggle script --}}
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>

</body>

</html>