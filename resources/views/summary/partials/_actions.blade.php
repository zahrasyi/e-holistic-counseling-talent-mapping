@if ($meeting->summary)
<a href="{{ route('summary.show', $meeting) }}" class="group relative flex justify-center items-center">
    <div class="p-2 text-yellow-500 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
        </svg>
    </div>
    <span
        class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-2 py-1 bg-gray-800 text-white text-xs rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
        Show Detail Summary
    </span>
</a>
@endif

@role('admin|super admin|konselor')
<div class="flex items-center space-x-2">

    @if ($meeting->status === 'approved' && !$meeting->summary)
    <a href="{{ route('summary.create', $meeting) }}" class="group relative flex justify-center items-center">
        <div class="p-2 text-green-500 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
            <!-- Heroicons Plus Circle -->
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <span
            class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-2 py-1 bg-gray-800 text-white text-xs rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
            Buat Resume
        </span>
    </a>
    @endif

    @if ($meeting->status === 'completed')
    <a href="{{ route('summary.edit', $meeting->id) }}" class="group relative flex items-center">
        <div class="p-2 text-blue-500 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L7 19H4v-3L14.586 4.586z">
                </path>
            </svg>
        </div>
        <span
            class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-2 py-1 bg-gray-800 text-white text-xs rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
            Edit Summary
        </span>
    </a>
    @endif
</div>
@endrole