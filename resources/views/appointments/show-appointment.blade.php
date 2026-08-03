<x-layouts.app>

    <x-partials.breadcrumbs :items="$breadcrumbs" />

    <x-partials.header title="Detail Appointment" description="Setujui atau Reschedule appointment disini." />

    <x-tables.table-show :fields="$fieldsMeetings">
        <x-slot name="actions">
            <div class="flex gap-3">
                <a href="{{ route('appointments.counselor') }}"
                    class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white rounded-lg shadow-md
                   bg-gradient-to-r from-gray-500 via-gray-600 to-gray-700
                   hover:from-gray-600 hover:via-gray-700 hover:to-gray-800
                   focus:ring-4 focus:outline-none focus:ring-gray-300
                   dark:focus:ring-gray-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back
                </a>

                <button type="button" data-modal-target="tinjau-modal" data-modal-toggle="tinjau-modal"
                    data-student="{{ $meeting->student->name ?? 'N/A' }}" data-time="{{ $meeting->meeting_time }}"
                    data-url="{{ route('appointments.updateStatus', $meeting) }}"
                    class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white rounded-lg shadow-md
                   bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700
                   hover:from-blue-600 hover:via-blue-700 hover:to-blue-800
                   focus:ring-4 focus:outline-none focus:ring-blue-300
                   dark:focus:ring-blue-800 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12h.01M19 12c0 3.866-3.134 7-7 7s-7-3.134-7-7 3.134-7 7-7 7 3.134 7 7z" />
                    </svg>
                    Tinjau
                </button>
            </div>
        </x-slot>

    </x-tables.table-show>

    @include('appointments.partials._modal')

</x-layouts.app>
