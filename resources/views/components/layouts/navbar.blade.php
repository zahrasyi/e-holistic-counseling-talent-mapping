<nav class="bg-tertiary dark:bg-gray-800 shadow px-4 py-3 flex items-center justify-between border-b border-slate-300">
    <div class="flex items-center space-x-2">
        <!-- Toggle Sidebar Mobile -->
        <button data-drawer-target="sidebar" data-drawer-toggle="sidebar" aria-controls="sidebar"
            class="md:hidden p-2 text-gray-500 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
            ☰
        </button>

        <h1 class="text-lg font-semibold text-gray-700 dark:text-gray-200">
            {{ $title ?? 'Dashboard' }}
        </h1>
    </div>

    <div class="flex items-center space-x-4">
        <div id="google_translate_element" class="hidden"></div>

        <div x-data="{ openLang: false }" class="relative">
            
            <button @click="openLang = !openLang" @click.away="openLang = false" 
                class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none rounded-lg text-sm p-2.5 transition-colors" title="Ubah Bahasa">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                </svg>
            </button>

            <div x-show="openLang" x-transition 
                class="absolute right-0 mt-2 w-40 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 z-50 border border-gray-100 dark:border-gray-700" style="display: none;">
                
                <button onclick="ubahBahasa('id')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">🇮🇩 Indonesia</button>
                <button onclick="ubahBahasa('en')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">🇬🇧 English</button>
                <button onclick="ubahBahasa('ar')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">🇸🇦 Arabic</button>
                <button onclick="ubahBahasa('ja')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">🇯🇵 Japanese</button>
                <button onclick="ubahBahasa('tr')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">🇹🇷 Turkish</button>
                <button onclick="ubahBahasa('ms')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">🇲🇾 Malay</button>
                <button onclick="ubahBahasa('zh-CN')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">🇨🇳 Chinese</button>
                <button onclick="ubahBahasa('es')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">🇪🇸 Spanish</button>
                <button onclick="ubahBahasa('th')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">🇹🇭 Thailand</button>
                
            </div>
        </div>

        {{-- notification --}}
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open"
                class="relative text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                    </path>
                </svg>
                @if ($unreadNotificationsCount > 0)
                    <span
                        class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                        {{ $unreadNotificationsCount }}
                    </span>
                @endif
            </button>

            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="absolute right-0 w-80 mt-2 origin-top-right bg-white dark:bg-gray-800 rounded-md shadow-lg z-50">

                <div class="py-2 px-4 border-b dark:border-gray-700">
                    <p class="font-semibold text-gray-800 dark:text-white">Notifikasi</p>
                </div>

                <div class="max-h-96 overflow-y-auto divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse ($unreadNotifications as $notification)
                        <a href="{{ route('notifications.read', $notification->id) }}"
                            class="block w-full p-4 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <div class="flex items-center">
                                {{-- Bagian Avatar (Sudah Diperbarui) --}}
                                <div class="relative inline-block shrink-0">

                                    {{-- GANTI DIV DENGAN IMG --}}
                                    <img class="w-12 h-12 rounded-full object-cover"
                                        src="{{ $notification->data['sender_photo_url']
                                            ? asset('storage/' . $notification->data['sender_photo_url'])
                                            : 'https://ui-avatars.com/api/?name=' . urlencode($notification->data['sender_name']) . '&background=random' }}"
                                        alt="{{ $notification->data['sender_name'] }} image" />

                                    <span
                                        class="absolute bottom-0 right-0 inline-flex items-center justify-center w-6 h-6 bg-blue-600 rounded-full">
                                        <svg class="w-3 h-3 text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 18" fill="currentColor">
                                            <path
                                                d="M18 4H16V9C16 10.0609 15.5786 11.0783 14.8284 11.8284C14.0783 12.5786 13.0609 13 12 13H9L6.846 14.615C7.17993 14.8628 7.58418 14.9977 8 15H11.667L15.4 17.8C15.5731 17.9298 15.7836 18 16 18C16.2652 18 16.5196 17.8946 16.7071 17.7071C16.8946 17.5196 17 17.2652 17 17V15H18C18.5304 15 19.0391 14.7893 19.4142 14.4142C19.7893 14.0391 20 13.5304 20 13V6C20 5.46957 19.7893 4.96086 19.4142 4.58579C19.0391 4.21071 18.5304 4 18 4Z"
                                                fill="currentColor" />
                                            <path
                                                d="M12 0H2C1.46957 0 0.960859 0.210714 0.585786 0.585786C0.210714 0.960859 0 1.46957 0 2V9C0 9.53043 0.210714 10.0391 0.585786 10.4142C0.960859 10.7893 1.46957 11 2 11H3V13C3 13.1857 3.05171 13.3678 3.14935 13.5257C3.24698 13.6837 3.38668 13.8114 3.55279 13.8944C3.71889 13.9775 3.90484 14.0126 4.08981 13.996C4.27477 13.9793 4.45143 13.9114 4.6 13.8L8.333 11H12C12.5304 11 13.0391 10.7893 13.4142 10.4142C13.7893 10.0391 14 9.53043 14 9V2C14 1.46957 13.7893 0.960859 13.4142 0.585786C13.0391 0.210714 12.5304 0 12 0Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                </div>

                                {{-- Bagian Teks Notifikasi --}}
                                <div class="ms-3 text-sm font-normal">
                                    <div class="text-sm font-semibold text-gray-900 dark:text-white">
                                        {{ $notification->data['sender_name'] }}</div>
                                    <div class="text-sm font-normal text-gray-600 dark:text-gray-400">
                                        {{ $notification->data['message'] }}</div>
                                    <span
                                        class="text-xs font-medium text-blue-600 dark:text-blue-500">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="px-4 py-8 text-center text-gray-500">
                            <p>Tidak ada notifikasi baru.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- toggle darkmode --}}
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

            @php
                $user = Auth::user();
                $photo = $user->counselor->profile_photo_path ?? null;

                if ($photo) {
                    $photoUrl = filter_var($photo, FILTER_VALIDATE_URL) ? $photo : asset('storage/' . $photo); // kalau file-nya disimpan di storage Laravel
                } else {
                    $photoUrl = 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random';
                }
            @endphp

            <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                <img src="{{ $photoUrl }}" alt="{{ $user->name }}"
                    class="w-8 h-8 rounded-full object-cover border border-gray-300 dark:border-gray-700">
                <span class="hidden md:block text-gray-800 dark:text-gray-200">{{ $user->name }}</span>

                <svg class="w-4 h-4 fill-current text-gray-600 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
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
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">
                        Log Out
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>

<style>
    /* Menyembunyikan widget asli Google */
    #google_translate_element { display: none !important; }
    
    /* Membasmi banner atas yang bikin navbar turun */
    .goog-te-banner-frame { display: none !important; }
    body { top: 0px !important; position: static !important; }
    
    /* Membasmi popup/tooltip bawaan Google pas kursor diarahkan ke teks */
    #goog-gt-tt, .goog-te-balloon-frame { display: none !important; }
    .goog-text-highlight { background-color: transparent !important; box-shadow: none !important; border: none !important; }
</style>


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

<script type="text/javascript">
    // 1. Inisialisasi Google Translate dengan 7 bahasa pilihan
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'id',
            includedLanguages: 'id,en,ar,ja,tr,zh-CN,es,ms,th',
            autoDisplay: false
        }, 'google_translate_element');
    }

    // 2. Fungsi sulap untuk memicu dropdown asli Google yang kita sembunyikan
    function ubahBahasa(langCode) {
        var select = document.querySelector('.goog-te-combo');
        if (select) {
            select.value = langCode;
            select.dispatchEvent(new Event('change')); // Memaksa Google membaca perubahan
        }
    }
</script>
<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>