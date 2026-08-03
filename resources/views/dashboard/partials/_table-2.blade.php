<div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
    <h3 class="pb-3 font-semibold">Recent Appointments</h3>
    <table class="min-w-full">
        <thead>
            <tr class="border-gray-100 border-y dark:border-gray-800">
                <th class="py-3 px-4 text-left">
                    <p class="font-medium text-gray-500 text-xs dark:text-gray-400">Mahasiswa</p>
                </th>
                <th class="py-3 px-4 text-left">
                    <p class="font-medium text-gray-500 text-xs dark:text-gray-400">Konselor Dituju</p>
                </th>
                <th class="py-3 px-4 text-left">
                    <p class="font-medium text-gray-500 text-xs dark:text-gray-400">Waktu Pengajuan</p>
                </th>
                <th class="py-3 px-4 text-center">
                    <p class="font-medium text-gray-500 text-xs dark:text-gray-400">Status</p>
                </th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
            @forelse ($recentAppointments as $meeting)
                <tr>
                    <td class="py-3 px-4">
                        <div class="flex items-center gap-3">
                            <div
                                class="h-10 w-10 overflow-hidden rounded-full bg-gray-200 flex items-center justify-center">
                                <span
                                    class="font-semibold text-gray-500">{{ substr($meeting->student->name ?? 'N/A', 0, 1) }}</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800 text-sm dark:text-white/90">
                                    {{ $meeting->student->name ?? 'N/A' }}
                                </p>
                            </div>
                        </div>
                    </td>
                    <td class="py-3 px-4">
                        <p class="text-gray-500 text-sm dark:text-gray-400">
                            {{ $meeting->counselor->name ?? 'N/A' }}
                        </p>
                    </td>
                    <td class="py-3 px-4">
                        <p class="text-gray-500 text-sm dark:text-gray-400"
                            title="{{ $meeting->created_at->format('d M Y H:i') }}">
                            {{-- Tampilkan waktu dalam format "human-readable" --}}
                            {{ $meeting->created_at->diffForHumans() }}
                        </p>
                    </td>
                    <td class="py-3 px-4">
                        <div class="flex justify-center">
                            {{-- Panggil komponen/partial untuk badge status --}}
                            @include('appointments.partials._status-badge', ['meeting' => $meeting])
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="py-10 text-center">
                        <p class="text-gray-500 dark:text-gray-400">Tidak ada aktivitas janji temu terbaru.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
