@extends('layouts.app')
@section('title', 'Dashboard Bakat')
@section('content')
<div id="view-dashboard" class="p-8">
    <h2 class="text-xl font-bold text-slate-800 mb-8">Selamat Datang, Zahra Syifaul</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm flex flex-col items-center justify-center text-center">
            <i class="far fa-calendar-check text-2xl text-blue-400 mb-3"></i>
            <p class="text-sm font-medium text-slate-700 mb-2">Janji Temu Akan Datang</p>
            <h3 class="text-2xl font-bold text-slate-800">1</h3>
        </div>
        <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm flex flex-col items-center justify-center text-center">
            <i class="fas fa-user-clock text-2xl text-blue-400 mb-3"></i>
            <p class="text-sm font-medium text-slate-700 mb-2">Permintaan Menunggu</p>
            <h3 class="text-2xl font-bold text-slate-800">1</h3>
        </div>
        <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm flex flex-col items-center justify-center text-center">
            <i class="fas fa-clipboard-check text-2xl text-blue-400 mb-3"></i>
            <p class="text-sm font-medium text-slate-700 mb-2">Total Sesi Selesai</p>
            <h3 class="text-2xl font-bold text-slate-800">1</h3>
        </div>
    </div>
    <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm">
        <div class="flex justify-between items-center mb-8">
            <h3 class="text-base font-bold text-slate-800">Analisis Aktivitas Saya</h3>
            <div class="flex bg-gray-100 rounded-lg p-1 text-xs text-gray-500 font-medium">
                <button class="bg-white px-3 py-1 rounded shadow-sm text-slate-700">Frequensi sesi</button>
                <button class="px-3 py-1 hover:text-slate-700">Jenis Layanan</button>
                <button class="px-3 py-1 hover:text-slate-700">Sesi Per Konselor</button>
            </div>
        </div>
        <div class="relative h-48 w-full flex flex-col justify-between text-xs text-gray-400 pb-6">
            <div class="flex items-center w-full"><span class="w-4">3</span> <div class="flex-1 border-b border-gray-300 ml-4"></div></div>
            <div class="flex items-center w-full"><span class="w-4">2</span> <div class="flex-1 border-b border-gray-300 ml-4"></div></div>
            <div class="flex items-center w-full relative">
                <span class="w-4">1</span> <div class="flex-1 border-b border-gray-300 ml-4"></div>
                <div class="absolute left-1/3 top-1/2 transform -translate-y-1/2 w-4 h-4 bg-[#5b75a6] rounded-full border-2 border-white shadow"></div>
            </div>
        </div>
    </div>
</div>
@endsection