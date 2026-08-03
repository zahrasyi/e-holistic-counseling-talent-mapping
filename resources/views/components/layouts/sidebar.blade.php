<aside class="w-64 bg-secondary dark:bg-gray-800 shadow-md hidden md:block">
    <div class="h-full flex flex-col p-4">
        <h2 class="text-xl font-bold text-indigo-300 dark:text-indigo-400 mb-6">E-Counseling</h2>

        <nav class="flex-1 space-y-2">
            <div class="h-full px-3 py-4 overflow-y-auto bg-secondary dark:bg-gray-800">
                <ul class="space-y-2 font-medium">

                    {{-- dashboard --}}
                    <li>
                        <a href="{{ dashboardRoute() }}"
                            class="flex items-center p-2 text-slate-100 rounded-lg dark:text-white hover:bg-slate-800 dark:hover:bg-gray-700 group">
                            <svg class="w-5 h-5 text-slate-200 transition duration-75 dark:text-gray-400 dark:group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 22 21">
                                <path
                                    d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                <path
                                    d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                            </svg>
                            <span class="ms-3">Dashboard</span>
                        </a>
                    </li>

                    {{-- appointment --}}
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-base text-slate-100 transition duration-75 rounded-lg group hover:bg-slate-800 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="appointment-dropdown" data-collapse-toggle="appointment-dropdown">
                            <svg class="shrink-0 w-5 h-5 text-slate-200 transition duration-75 group-hover:text-slate-200 dark:text-gray-400 dark:group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M8 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1h2a2 2 0 0 1 2 2v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h2Zm6 1h-4v2H9a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2h-1V4Zm-3 8a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Zm2 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Z"
                                    clip-rule="evenodd" />
                            </svg>


                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Appointment</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="appointment-dropdown" class="hidden py-2 space-y-2">

                            {{-- appointment --}}
                            @role('mahasiswa')
                                <li>
                                    <a href="{{ route('appointments.select-type') }}"
                                        class="flex items-center w-full p-2 text-slate-100 transition duration-75 rounded-lg pl-11 group hover:bg-slate-800 dark:text-white dark:hover:bg-gray-700">Appointment
                                    </a>
                                </li>
                            @endrole

                            {{-- pending appointment --}}
                            @role('mahasiswa')
                                <li>
                                    <a href="{{ route('appointments.pasien') }}"
                                        class="flex items-center w-full p-2 text-slate-100 transition duration-75 rounded-lg pl-11 group hover:bg-slate-800 dark:text-white dark:hover:bg-gray-700">Pengajuan
                                    </a>
                                </li>
                            @endrole

                            {{-- approved appointment mahasiswa --}}
                            @role('mahasiswa')
                                <li>
                                    <a href="{{ route('appointments.approvedPasien') }}"
                                        class="flex items-center w-full p-2 text-slate-100 transition duration-75 rounded-lg pl-11 group hover:bg-slate-800 dark:text-white dark:hover:bg-gray-700">Approved
                                    </a>
                                </li>
                            @endrole

                            {{-- completed appeointment mahasiswa --}}
                            @role('mahasiswa')
                                <li>
                                    <a href="{{ route('appointments.completedPasien') }}"
                                        class="flex items-center w-full p-2 text-slate-100 transition duration-75 rounded-lg pl-11 group hover:bg-slate-800 dark:text-white dark:hover:bg-gray-700">Completed
                                    </a>
                                </li>
                            @endrole

                            {{-- riwayat appointment mahasiswa --}}
                            @role('mahasiswa')
                                <li>
                                    <a href="{{ route('appointments.riwayatMahasiswa') }}"
                                        class="flex items-center w-full p-2 text-slate-100 transition duration-75 rounded-lg pl-11 group hover:bg-slate-800 dark:text-white dark:hover:bg-gray-700">Riwayat
                                    </a>
                                </li>
                            @endrole

                            {{-- appointment counselor --}}
                            @role('konselor')
                                <li>
                                    <a href="{{ route('appointments.counselor') }}"
                                        class="flex items-center w-full p-2 text-slate-100 transition duration-75 rounded-lg pl-11 group hover:bg-slate-800 dark:text-white dark:hover:bg-gray-700">Pengajuan
                                    </a>
                                </li>
                            @endrole

                            {{-- approved appointment Counselor --}}
                            @role('konselor')
                                <li>
                                    <a href="{{ route('appointments.approvedCounselor') }}"
                                        class="flex items-center w-full p-2 text-slate-100 transition duration-75 rounded-lg pl-11 group hover:bg-slate-800 dark:text-white dark:hover:bg-gray-700">Approved
                                    </a>
                                </li>
                            @endrole

                            {{-- riwayat appointment Counselor --}}
                            @role('konselor')
                                <li>
                                    <a href="{{ route('appointments.riwayatCounselor') }}"
                                        class="flex items-center w-full p-2 text-slate-100 transition duration-75 rounded-lg pl-11 group hover:bg-slate-800 dark:text-white dark:hover:bg-gray-700">Riwayat
                                    </a>
                                </li>
                            @endrole

                            {{-- riwayat appointment untuk admin --}}
                            @role('admin|super admin')
                                <li>
                                    <a href="{{ route('appointments.riwayat') }}"
                                        class="flex items-center w-full p-2 text-slate-100 transition duration-75 rounded-lg pl-11 group hover:bg-slate-800 dark:text-white dark:hover:bg-gray-700">Riwayat
                                    </a>
                                </li>
                            @endrole

                        </ul>
                    </li>

                    @role('mahasiswa')
                        {{-- kuesioner --}}
                        <li>
                            <button type="button"
                                class="flex items-center w-full p-2 text-base text-slate-100 transition duration-75 rounded-lg group hover:bg-slate-800 dark:text-white dark:hover:bg-gray-700"
                                aria-controls="kuesioner-dropdown" data-collapse-toggle="kuesioner-dropdown">
                                <svg class="shrink-0 w-5 h-5 text-slate-200 transition duration-75 group-hover:text-slate-200 dark:text-gray-400 dark:group-hover:text-white"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M18 5V4a1 1 0 0 0-1-1H8.914a1 1 0 0 0-.707.293L4.293 7.207A1 1 0 0 0 4 7.914V20a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-5M9 3v4a1 1 0 0 1-1 1H4m11.383.772 2.745 2.746m1.215-3.906a2.089 2.089 0 0 1 0 2.953l-6.65 6.646L9 17.95l.739-3.692 6.646-6.646a2.087 2.087 0 0 1 2.958 0Z" />
                                </svg>


                                <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Questionnaire</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>

                            <ul id="kuesioner-dropdown" class="hidden py-2 space-y-2">
                                {{-- questionnaire --}}

                                <li>
                                    <a href="{{ route('questionnaire.index') }}"
                                        class="flex items-center w-full p-2 text-slate-100 transition duration-75 rounded-lg pl-11 group hover:bg-slate-800 dark:text-white dark:hover:bg-gray-700">Questionnaire
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('questionnaire.list') }}"
                                        class="flex items-center w-full p-2 text-slate-100 transition duration-75 rounded-lg pl-11 group hover:bg-slate-800 dark:text-white dark:hover:bg-gray-700">Riwayat
                                        Questionnaire
                                    </a>
                                </li>

                            </ul>
                        </li>
                    @endrole

                    {{-- Talent --}}
                    @role('mahasiswa')
                        <li>
                            <button type="button"
                                class="flex items-center w-full p-2 text-slate-100 transition duration-75 rounded-lg group hover:bg-slate-800 dark:text-white dark:hover:bg-gray-700"
                                aria-controls="talent-dropdown"
                                data-collapse-toggle="talent-dropdown">
                        
                                <svg class="w-5 h-5 text-slate-200"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path d="M12 2L1 21h22L12 2z"/>
                                </svg>
                        
                                <span class="flex-1 ms-3 text-left whitespace-nowrap">
                                    Talent
                                </span>
                        
                                <svg class="w-3 h-3"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 10 6">
                                    <path stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="m1 1 4 4 4-4"/>
                                </svg>
                            </button>
                        
                            <ul id="talent-dropdown" class="hidden py-2 space-y-2">
                        
                                <li>
                                    <a href="{{ route('talent.search') }}"
                                        class="flex items-center w-full p-2 text-slate-100 transition duration-75 rounded-lg pl-11  hover:bg-slate-800 dark:text-white dark:hover:bg-gray-700">
                                        Search Stage
                                    </a>
                                </li>
                        
                                <li>
                                    <a href="{{ route('talent.development') }}"
                                        class="flex items-center w-full p-2 text-slate-100 transition duration-75 rounded-lg pl-11  hover:bg-slate-800 dark:text-white dark:hover:bg-gray-700">
                                        Development Stage
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('talent.history') }}"
                                        class="flex items-center w-full p-2 text-slate-100 transition duration-75 rounded-lg pl-11  hover:bg-slate-800 dark:text-white dark:hover:bg-gray-700">
                                        History
                                    </a>
                                </li>
                        
                            </ul>
                        </li>
                    @endrole

                    {{-- master --}}
                    @role('super admin|admin')
                        <li>
                            <button type="button"
                                class="flex items-center w-full p-2 text-base text-slate-100 transition duration-75 rounded-lg group hover:bg-slate-800 dark:text-white dark:hover:bg-gray-700"
                                aria-controls="master-dropdown" data-collapse-toggle="master-dropdown">
                                <svg class="shrink-0 w-5 h-5 text-slate-200 transition duration-75 group-hover:text-slate-200 dark:text-gray-400 dark:group-hover:text-white"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 7.205c4.418 0 8-1.165 8-2.602C20 3.165 16.418 2 12 2S4 3.165 4 4.603c0 1.437 3.582 2.602 8 2.602ZM12 22c4.963 0 8-1.686 8-2.603v-4.404c-.052.032-.112.06-.165.09a7.75 7.75 0 0 1-.745.387c-.193.088-.394.173-.6.253-.063.024-.124.05-.189.073a18.934 18.934 0 0 1-6.3.998c-2.135.027-4.26-.31-6.3-.998-.065-.024-.126-.05-.189-.073a10.143 10.143 0 0 1-.852-.373 7.75 7.75 0 0 1-.493-.267c-.053-.03-.113-.058-.165-.09v4.404C4 20.315 7.037 22 12 22Zm7.09-13.928a9.91 9.91 0 0 1-.6.253c-.063.025-.124.05-.189.074a18.935 18.935 0 0 1-6.3.998c-2.135.027-4.26-.31-6.3-.998-.065-.024-.126-.05-.189-.074a10.163 10.163 0 0 1-.852-.372 7.816 7.816 0 0 1-.493-.268c-.055-.03-.115-.058-.167-.09V12c0 .917 3.037 2.603 8 2.603s8-1.686 8-2.603V7.596c-.052.031-.112.059-.165.09a7.816 7.816 0 0 1-.745.386Z" />
                                </svg>

                                <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Master</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <ul id="master-dropdown" class="hidden py-2 space-y-2">

                                {{-- counseling type & specialization --}}
                                <li>
                                    <a href="{{ route('counselingType.index') }}"
                                        class="flex items-center w-full p-2 text-slate-100 transition duration-75 rounded-lg pl-11 group hover:bg-slate-800 dark:text-white dark:hover:bg-gray-700">
                                        Counseling</a>
                                </li>

                                {{-- konselor --}}
                                <li>
                                    <a href="{{ route('assignment.index') }}"
                                        class="flex items-center w-full p-2 text-slate-100 transition duration-75 rounded-lg pl-11 group hover:bg-slate-800 dark:text-white dark:hover:bg-gray-700">
                                        Counselor</a>
                                </li>

                                {{-- user --}}
                                <li>
                                    <a href="{{ route('users.index') }}"
                                        class="flex items-center w-full p-2 text-slate-100 transition duration-75 rounded-lg pl-11 group hover:bg-slate-800 dark:text-white dark:hover:bg-gray-700">User</a>
                                </li>

                                {{-- role --}}
                                <li>
                                    <a href="{{ route('roles.index') }}"
                                        class="flex items-center w-full p-2 text-slate-100 transition duration-75 rounded-lg pl-11 group hover:bg-slate-800 dark:text-white dark:hover:bg-gray-700">Role</a>
                                </li>

                            </ul>
                        </li>
                    @endrole

                </ul>
            </div>
        </nav>
    </div>
</aside>

{{-- mobile --}}
<div id="sidebar"
    class="fixed inset-y-0 left-0 z-40 w-64 p-4 overflow-y-auto transition-transform -translate-x-full bg-secondary dark:bg-gray-800"
    tabindex="-1" aria-labelledby="drawer-label">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h2 id="drawer-label" class="text-xl font-bold text-indigo-300 dark:text-indigo-400">
            E-Counseling
        </h2>
        <button type="button" data-drawer-hide="sidebar" aria-controls="sidebar"
            class="text-indigo-300 bg-transparent hover:bg-slate-800 hover:text-white rounded-lg text-sm w-8 h-8 flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 space-y-2">
        <ul class="space-y-2 font-medium">

            <!-- Dashboard -->
            <li>
                <a href="{{ dashboardRoute() }}"
                    class="flex items-center p-2 text-slate-100 rounded-lg hover:bg-slate-800 dark:text-white dark:hover:bg-gray-700 group">
                    <svg class="w-5 h-5 text-slate-200 transition duration-75 dark:text-gray-400 dark:group-hover:text-white"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path
                            d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                        <path
                            d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>

            <!-- Appointment -->
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-base text-slate-100 rounded-lg hover:bg-slate-800 dark:text-white dark:hover:bg-gray-700 group"
                    aria-controls="appointment-dropdown-mobile" data-collapse-toggle="appointment-dropdown-mobile">
                    <svg class="w-5 h-5 text-slate-200 transition duration-75 dark:text-gray-400 dark:group-hover:text-white"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M8 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1h2a2 2 0 0 1 2 2v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h2Zm6 1h-4v2H9a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2h-1V4Zm-3 8a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Zm2 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="flex-1 ms-3 text-left">Appointment</span>
                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>

                <ul id="appointment-dropdown-mobile" class="hidden py-2 space-y-2">
                    @role('mahasiswa')
                        <li><a href="{{ route('appointments.select-type') }}"
                                class="block px-4 py-2 hover:bg-slate-700 rounded-md">Appointment</a></li>
                        <li><a href="{{ route('appointments.pasien') }}"
                                class="block px-4 py-2 hover:bg-slate-700 rounded-md">Pengajuan</a></li>
                        <li><a href="{{ route('appointments.approvedPasien') }}"
                                class="block px-4 py-2 hover:bg-slate-700 rounded-md">Approved</a></li>
                        <li><a href="{{ route('appointments.completedPasien') }}"
                                class="block px-4 py-2 hover:bg-slate-700 rounded-md">Completed</a></li>
                        <li><a href="{{ route('appointments.riwayatMahasiswa') }}"
                                class="block px-4 py-2 hover:bg-slate-700 rounded-md">Riwayat</a></li>
                    @endrole

                    @role('konselor')
                        <li><a href="{{ route('appointments.counselor') }}"
                                class="block px-4 py-2 hover:bg-slate-700 rounded-md">Pengajuan</a></li>
                        <li><a href="{{ route('appointments.approvedCounselor') }}"
                                class="block px-4 py-2 hover:bg-slate-700 rounded-md">Approved</a></li>
                        <li><a href="{{ route('appointments.riwayatCounselor') }}"
                                class="block px-4 py-2 hover:bg-slate-700 rounded-md">Riwayat</a></li>
                    @endrole

                    @role('admin|super admin')
                        <li><a href="{{ route('appointments.riwayat') }}"
                                class="block px-4 py-2 hover:bg-slate-700 rounded-md">Riwayat</a></li>
                    @endrole
                </ul>
            </li>

            <!-- Questionnaire -->
            @role('mahasiswa')
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-slate-100 rounded-lg hover:bg-slate-800 dark:text-white dark:hover:bg-gray-700 group"
                        aria-controls="kuesioner-dropdown-mobile" data-collapse-toggle="kuesioner-dropdown-mobile">
                        <svg class="w-5 h-5 text-slate-200 transition duration-75 dark:text-gray-400 dark:group-hover:text-white"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 5V4a1 1 0 0 0-1-1H8.914a1 1 0 0 0-.707.293L4.293 7.207A1 1 0 0 0 4 7.914V20a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-5M9 3v4a1 1 0 0 1-1 1H4m11.383.772 2.745 2.746m1.215-3.906a2.089 2.089 0 0 1 0 2.953l-6.65 6.646L9 17.95l.739-3.692 6.646-6.646a2.087 2.087 0 0 1 2.958 0Z" />
                        </svg>
                        <span class="flex-1 ms-3 text-left">Questionnaire</span>
                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>

                    <ul id="kuesioner-dropdown-mobile" class="hidden py-2 space-y-2">
                        <li><a href="{{ route('questionnaire.index') }}"
                                class="block px-4 py-2 hover:bg-slate-700 rounded-md">Questionnaire</a></li>
                        <li><a href="{{ route('questionnaire.list') }}"
                                class="block px-4 py-2 hover:bg-slate-700 rounded-md">Riwayat Questionnaire</a></li>
                    </ul>
                </li>
            @endrole

            {{-- Talent --}}
            @role('mahasiswa')
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-slate-100 transition duration-75 rounded-lg group hover:bg-slate-800"
                        aria-controls="talent-dropdown"
                        data-collapse-toggle="talent-dropdown">
                
                        <svg class="w-5 h-5 text-slate-200"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 24 24">
                            <path d="M12 2L1 21h22L12 2z"/>
                        </svg>
                
                        <span class="flex-1 ms-3 text-left whitespace-nowrap">
                            Talent
                        </span>
                
                        <svg class="w-3 h-3"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                
                    <ul id="talent-dropdown" class="hidden py-2 space-y-2">
                
                        <li>
                            <a href="{{ route('talent.search') }}"
                                class="flex items-center w-full p-2 text-slate-100 transition duration-75 rounded-lg pl-11 hover:bg-slate-800">
                                Search Stage
                            </a>
                        </li>
                
                        <li>
                            <a href="{{ route('talent.development') }}"
                                class="flex items-center w-full p-2 text-slate-100 transition duration-75 rounded-lg pl-11 hover:bg-slate-800">
                                Development Stage
                            </a>
                        </li>
                
                    </ul>
                </li>
            @endrole

            <!-- Master -->
            @role('super admin|admin')
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-slate-100 rounded-lg hover:bg-slate-800 dark:text-white dark:hover:bg-gray-700 group"
                        aria-controls="master-dropdown-mobile" data-collapse-toggle="master-dropdown-mobile">
                        <svg class="w-5 h-5 text-slate-200 transition duration-75 dark:text-gray-400 dark:group-hover:text-white"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 7.205c4.418 0 8-1.165 8-2.602C20 3.165 16.418 2 12 2S4 3.165 4 4.603c0 1.437 3.582 2.602 8 2.602ZM12 22c4.963 0 8-1.686 8-2.603v-4.404c-.052.032-.112.06-.165.09a7.75 7.75 0 0 1-.745.387c-.193.088-.394.173-.6.253-.063.024-.124.05-.189.073a18.934 18.934 0 0 1-6.3.998c-2.135.027-4.26-.31-6.3-.998-.065-.024-.126-.05-.189-.074a10.143 10.143 0 0 1-.852-.373 7.75 7.75 0 0 1-.493-.267c-.053-.03-.113-.058-.165-.09v4.404C4 20.315 7.037 22 12 22Zm7.09-13.928a9.91 9.91 0 0 1-.6.253c-.063.025-.124.05-.189.074a18.935 18.935 0 0 1-6.3.998c-2.135.027-4.26-.31-6.3-.998-.065-.024-.126-.05-.189-.074a10.163 10.163 0 0 1-.852-.372 7.816 7.816 0 0 1-.493-.268c-.055-.03-.115-.058-.167-.09V12c0 .917 3.037 2.603 8 2.603s8-1.686 8-2.603V7.596c-.052.031-.112.059-.165.09a7.816 7.816 0 0 1-.745.386Z" />
                        </svg>
                        <span class="flex-1 ms-3 text-left">Master</span>
                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>

                    <ul id="master-dropdown-mobile" class="hidden py-2 space-y-2">
                        <li><a href="{{ route('counselingType.index') }}"
                                class="block px-4 py-2 hover:bg-slate-700 rounded-md">Counseling</a></li>
                        <li><a href="{{ route('assignment.index') }}"
                                class="block px-4 py-2 hover:bg-slate-700 rounded-md">Counselor</a></li>
                        <li><a href="{{ route('users.index') }}"
                                class="block px-4 py-2 hover:bg-slate-700 rounded-md">User</a></li>
                        <li><a href="{{ route('roles.index') }}"
                                class="block px-4 py-2 hover:bg-slate-700 rounded-md">Role</a></li>
                    </ul>
                </li>
            @endrole

        </ul>
    </nav>
</div>
