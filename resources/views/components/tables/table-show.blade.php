{{-- resources/views/components/tables/table-show.blade.php --}}
<div class="relative overflow-x-auto shadow-md sm:rounded-lg rounded-lg">
    {{-- Flash session message --}}
    @if (session('error'))
    <x-partials.alert type="error" :message="session('error')" />
    @elseif (session('success'))
    <x-partials.alert type="success" :message="session('success')" />
    @endif

    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border border-primary dark:border-gray-700">
        <thead class="text-xs text-slate-100 uppercase bg-primary dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 border-r border-gray-200 dark:border-gray-700">Field</th>
                <th scope="col" class="px-6 py-3 border-r border-gray-200 dark:border-gray-700">Value</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fields as $field)
            <tr
                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-100 even:dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <td
                    class="px-6 py-4 border-r border-gray-200 dark:border-gray-700 font-medium text-gray-700 dark:text-gray-300">
                    {{ $field['label'] }}
                </td>
                <td class="px-6 py-4 text-gray-900 dark:text-white">
                    {!! $field['value'] !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Bagian actions di bawah table --}}
    <div class="px-4 py-4 sm:px-6 bg-gray-50 dark:bg-gray-900/50 flex justify-end space-x-3">
        {{ $actions }}
    </div>
</div>