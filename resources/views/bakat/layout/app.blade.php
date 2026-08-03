<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-Counseling UNIDA')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard E-Holistik Bakat</title>
        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
        <style>
            body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
            
            .radio-pill input[type="radio"] {
                accent-color: #cbd5e1;
                width: 1rem;
                height: 1rem;
                margin-right: 0.5rem;
            }
            .radio-pill {
                border: 1px solid #e2e8f0;
                border-radius: 9999px;
                padding: 0.35rem 1rem;
                display: flex;
                align-items: center;
                cursor: pointer;
                transition: all 0.2s;
                background-color: white;
                color: #64748b;
                font-size: 0.875rem;
            }
            .radio-pill:hover { background-color: #f1f5f9; }
            ::-webkit-scrollbar { width: 6px; }
            ::-webkit-scrollbar-track { background: transparent; }
            ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
            ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    
            /* --- ANIMASI CSS --- */
            @keyframes slideInRight {
                0% { opacity: 0; transform: translateX(50px); }
                100% { opacity: 1; transform: translateX(0); }
            }
            @keyframes fadeUp {
                0% { opacity: 0; transform: translateY(30px); }
                100% { opacity: 1; transform: translateY(0); }
            }
            .anim-slide-in { animation: slideInRight 0.7s cubic-bezier(0.4, 0, 0.2, 1) forwards; opacity: 0; }
            .anim-fade-up { animation: fadeUp 0.7s cubic-bezier(0.4, 0, 0.2, 1) forwards; opacity: 0; }
            
            @keyframes popIn {
                0% { transform: scale(0.3); opacity: 0; }
                70% { transform: scale(1.05); opacity: 1; }
                100% { transform: scale(1); opacity: 1; }
            }
            .anim-pop-in { animation: popIn 1.2s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; opacity: 0; }
    
            .expand-box {
                max-height: 0; overflow: hidden;
                transition: max-height 0.8s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.8s ease, transform 0.8s ease;
                opacity: 0; transform: translateY(-20px);
            }
            .expand-box.expanded { max-height: 500px; opacity: 1; transform: translateY(0); }
            
            .upload-box {
                max-height: 0; overflow: hidden;
                transition: max-height 0.4s ease-in-out, opacity 0.4s ease-in-out; opacity: 0;
            }
            .upload-box.show { max-height: 200px; opacity: 1; margin-top: 1rem; }
    
            .hide-scrollbar::-webkit-scrollbar { display: none; }
            .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        </style>
</head>
<body class="h-screen flex overflow-hidden text-slate-800">

    <div id="toast-container" class="fixed top-5 left-1/2 transform -translate-x-1/2 -translate-y-16 z-[100] transition-all duration-300 opacity-0 pointer-events-none">
        <div class="bg-red-500 text-white px-6 py-3 rounded-xl shadow-xl flex items-center space-x-3 border-2 border-red-400">
            <i class="fas fa-exclamation-triangle text-lg animate-pulse"></i>
            <span id="toast-message" class="font-medium text-sm">Peringatan: Harap isi semua pertanyaan!</span>
        </div>
    </div>

    @include('bakat.layout.sidebar')

    <main class="flex-1 flex flex-col h-full relative">
        @include('bakat.layout.header')

        <div class="flex-1 overflow-y-auto bg-[#f8fafc]">
            @yield('content')
        </div>
    </main>

    @stack('scripts')
</body>
</html>