@props(['name', 'text'])

<div
    class="question bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 transition-all duration-300 mb-4">
    <div class="flex items-start space-x-4 mb-3">
        <div class="flex-1">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">
                {{ $text }}
            </h3>
        </div>
    </div>

    <div class="grid sm:grid-cols-3 md:grid-cols-5 gap-3">
        @foreach ([
        1 => 'Tidak Sesuai',
        2 => 'Kurang Sesuai',
        3 => 'Cukup Sesuai',
        4 => 'Sesuai',
        5 => 'Sangat Sesuai'
        ] as $value => $label)
        <label
            class="group cursor-pointer scale-option flex items-center p-2 rounded-lg border border-gray-300 dark:border-gray-700 transition-all duration-200 hover:bg-blue-50 hover:border-blue-400 dark:hover:bg-gray-700 peer-checked:bg-blue-100">
            <input type="radio" name="{{ $name }}" value="{{ $value }}" class="hidden peer" required />

            <div
                class="w-5 h-5 rounded-full border-2 border-gray-400 flex items-center justify-center mr-3 transition-all duration-200 peer-checked:border-blue-500 peer-checked:bg-blue-600">
                <svg class="w-3 h-3 text-white hidden peer-checked:block" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>

            <span
                class="text-base text-gray-800 dark:text-gray-200 transition-all duration-200 group-hover:text-blue-700 peer-checked:text-blue-700">
                {{ $value }}. {{ $label }}
            </span>
        </label>
        @endforeach
    </div>
</div>