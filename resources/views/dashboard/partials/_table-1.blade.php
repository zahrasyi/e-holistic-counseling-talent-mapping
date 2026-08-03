<div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
    <h3 class="pb-3 font-semibold">Konselor Teraktif</h3>
    <table class="min-w-full">
        <thead>
            <tr class="border-gray-100 border-y dark:border-gray-800">
                <th class="py-3 px-4 text-left">
                    <p class="font-medium text-gray-500 text-xs dark:text-gray-400">Konselor</p>
                </th>
                <th class="py-3 px-4 text-left">
                    <p class="font-medium text-gray-500 text-xs dark:text-gray-400">Spesialisasi</p>
                </th>
                <th class="py-3 px-4 text-center">
                    <p class="font-medium text-gray-500 text-xs dark:text-gray-400">Sesi Selesai</p>
                </th>
                <th class="py-3 px-4 text-center">
                    <p class="font-medium text-gray-500 text-xs dark:text-gray-400">Status</p>
                </th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
            @forelse ($konselorTeraktif as $data)
                <tr>
                    <td class="py-3 px-4">
                        <div class="flex items-center gap-3">
                            {{-- Placeholder untuk foto profil, bisa diganti nanti --}}
                            <div
                                class="h-10 w-10 overflow-hidden rounded-full bg-gray-200 flex items-center justify-center">
                                <span
                                    class="font-semibold text-gray-500">{{ substr($data->counselor->name ?? '', 0, 1) }}</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800 text-sm dark:text-white/90">
                                    {{ $data->counselor->name ?? 'N/A' }}
                                </p>
                                <span class="text-gray-500 text-xs dark:text-gray-400">
                                    {{ $data->counselor->email ?? 'N/A' }}
                                </span>
                            </div>
                        </div>
                    </td>
                    <td class="py-3 px-4">
                        <p class="text-gray-500 text-sm dark:text-gray-400">
                            {{-- Ambil spesialisasi pertama, jika ada --}}
                            {{ $data->counselor?->specializations?->first()?->name ?? 'Umum' }}
                        </p>
                    </td>
                    <td class="py-3 px-4 text-center">
                        <p class="font-semibold text-gray-800 text-sm dark:text-white/90">
                            {{ $data->completed_sessions }}
                        </p>
                    </td>
                    <td class="py-3 px-4">
                        <div class="flex justify-center">
                            <p
                                class="rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-700 dark:bg-green-500/15 dark:text-green-400">
                                Aktif
                            </p>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="py-10 text-center">
                        <p class="text-gray-500 dark:text-gray-400">Tidak ada data aktivitas konselor dalam 30 hari
                            terakhir.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
