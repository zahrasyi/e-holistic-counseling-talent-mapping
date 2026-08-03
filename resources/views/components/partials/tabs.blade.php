<div class="border-b border-gray-200 dark:border-gray-700 mb-4">
    <ul
        class="flex flex-wrap text-sm font-medium text-center text-gray-500 
               border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
        @foreach ($tabs as $tab)
            <li class="me-2">
                <a href="{{ $tab['route'] }}"
                    class="inline-block p-4 rounded-t-lg 
                   {{ strtolower($active) === strtolower($tab['label'])
                       ? 'text-blue-600 bg-gray-300 active dark:bg-gray-800 dark:text-blue-500'
                       : 'hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300' }}">
                    {{ $tab['label'] }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
