<nav x-data="{ open: false }" class="fixed top-0 left-0 w-full bg-unida-blue/50 backdrop-blur-sm shadow z-50">
    <div class="container  mx-auto px-3">
        <div class="flex items-center justify-between gap-4 h-20">

            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center gap-4 m-3">
                    <img class="h-48 w-auto" src="{{ asset('asset/homepage/logo-konseling-navbar.png') }}"
                        alt="UNIDA Gontor Logo">
                    {{-- <div class="text-white leading-tight">
                        <p class="font-arabic text-lg tracking-wider">جامعة دار السلام كونتور</p>
                        <p class="text-xs font-light tracking-widest">UNIVERSITAS DARUSSALAM GONTOR</p>
                    </div> --}}
                </a>
            </div>

            <div class="flex items-center justify-between gap-8">
                <div>
                    <div class="ml-1 flex items-baseline gap-5 space-x-10">
                        <a href="{{ route('home') }}"
                            class="{{ request()->routeIs('home') ? 'text-unida-blue' : 'text-gray-200 hover:text-white' }} text-xl font-semibold mx-1 transition-colors duration-300">
                            Home
                        </a>
                        <a href="{{ route('about') }}"
                            class="{{ request()->routeIs('about') ? 'text-unida-blue' : 'text-gray-200 hover:text-white' }} text-xl font-semibold mx-1 transition-colors duration-300">
                            About Us
                        </a>
                        <a href="{{ route('services') }}"
                            class="{{ request()->routeIs('services') ? 'text-unida-blue' : 'text-gray-200 hover:text-white' }} text-xl font-semibold mx-1 transition-colors duration-300">
                            Service
                        </a>
                        <a href="{{ route('case-studies') }}"
                            class="{{ request()->routeIs('case-studies') ? 'text-unida-blue' : 'text-gray-200 hover:text-white' }} text-xl font-semibold mx-1 transition-colors duration-300">
                            Case Study
                        </a>
                    </div>
                </div>

                <div class="md:block ">
                    @guest
                    <a href="{{ route('login') }}"
                        onclick="event.preventDefault(); alert('Anda harus login terlebih dahulu untuk membuat janji.'); window.location.href='{{ route('login') }}';"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white  font-semibold rounded-md shadow transition">
                        Book An Appointment
                    </a>
                    @endguest
                    @auth
                    <a href="{{ dashboardRoute() }}"
                        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white  font-semibold rounded-md shadow transition">
                        Go to Dashboard
                    </a>
                    @endauth
                </div>

                <div class="-mr-2 flex md:hidden ml-4">
                    <button @click="open = !open" type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-300 hover:text-white hover:bg-slate-800 focus:outline-none">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open" @click.away="open = false" x-transition class="md:hidden border-t border-slate-700 bg-slate-900">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="{{ route('home') }}"
                class="block {{ request()->routeIs('home') ? 'text-unida-blue' : 'text-gray-200  font-semibold hover:text-white' }} rounded-md px-3 py-2">
                Home font-semibold
            </a> font-semibold
            <a href="{{ route('about') }}" font-semibold
                class="block {{ request()->routeIs('about') ? 'text-unida-blue' : 'text-gray-200  font-semibold hover:text-white' }} rounded-md px-3 py-2">
                About Us font-semibold
            </a> font-semibold
            <a href="{{ route('services') }}" font-semibold
                class="block {{ request()->routeIs('services') ? 'text-unida-blue' : 'text-gray-200  font-semibold hover:text-white' }} rounded-md px-3 py-2">
                Service font-semibold
            </a> font-semibold
            <a href="{{ route('case-studies') }}" font-semibold
                class="block {{ request()->routeIs('case-studies') ? 'text-unida-blue' : 'text-gray-200  font-semibold hover:text-white' }} rounded-md px-3 py-2">
                Case Study
            </a>

            <div class="border-t border-slate-700 my-2"></div>

            @guest
            <a href="{{ route('login') }}"
                onclick="event.preventDefault(); alert('Anda harus login terlebih dahulu untuk membuat janji.'); window.location.href='{{ route('login') }}';"
                class="block px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md shadow transition">
                Book An Appointment
            </a>
            @endguest
            @auth
            <a href="{{ dashboardRoute() }}"
                class="block px-3 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md shadow transition">
                Go to Dashboard
            </a>
            @endauth

        </div>
    </div>
</nav>