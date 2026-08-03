<x-layouts.app>
    <!-- Tambahan CSS disamakan dengan tema biru Penelusuran -->
    <style>
        .btn-filter { background-color: #2563eb; color: #ffffff; }
        .btn-filter:hover { background-color: #1d4ed8; }
        
        .btn-reset { color: #6b7280; }
        .btn-reset:hover { color: #374151; }
        
        .btn-eye { background-color: #eff6ff; color: #2563eb; }
        .btn-eye:hover { background-color: #2563eb; color: #ffffff; }
    </style>

    <div class="p-8 min-h-[70vh]">
        <div class="max-w-4xl mx-auto">
            <div class="mb-5">
                <a href="{{ route('talent.history') }}" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-blue-600 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Menu Riwayat
                </a>
            </div>
            <h2 class="text-2xl font-bold mb-6" style="color: #34538c;">
                <i class="fas fa-chart-line mr-2"></i> Riwayat Pengembangan (Aptitude)
            </h2>
            
            <!-- Filter -->
            <form method="GET" action="{{ route('talent.history.pengembangan') }}" class="mb-6 flex gap-2 items-center p-4 rounded-xl border" style="background-color: #ffffff; border-color: #e5e7eb;">
                <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="rounded-lg" style="border-color: #d1d5db; outline-color: #2563eb;">
                <button type="submit" class="px-4 py-2 rounded-lg font-semibold transition-all duration-300 btn-filter">Filter</button>
                <a href="{{ route('talent.history.pengembangan') }}" class="font-semibold px-4 transition-all duration-300 btn-reset">Reset</a>
            </form>

            <!-- Tabel -->
            <div class="rounded-2xl border shadow-sm overflow-hidden" style="background-color: #ffffff; border-color: #e5e7eb;">
                <table class="w-full text-left">
                    <thead class="text-sm uppercase" style="background-color: #f9fafb; color: #6b7280;">
                        <tr>
                            <th class="p-4">Date</th>
                            <th class="p-4">Result</th>
                            <th class="p-4 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y" style="border-color: #f3f4f6;">
                        @forelse($riwayat as $item)
                        <tr>
                            <td class="p-4" style="color: #4b5563;">{{ $item->created_at->format('d M Y, H:i') }}</td>
                            <td class="p-4 font-semibold" style="color: #334155;">{{ $item->kategori_dominan ?? 'Menunggu Hasil' }}</td>
                            <td class="p-4 text-center">
                                <a href="{{ route('talent.pengembangan.hasil', ['id' => $item->id]) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-full transition-all duration-300 btn-eye" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="p-8 text-center" style="color: #6b7280;">Belum ada riwayat ditemukan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>