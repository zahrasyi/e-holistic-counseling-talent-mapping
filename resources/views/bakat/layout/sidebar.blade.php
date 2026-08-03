<aside class="w-64 bg-[#2b3954] text-white flex flex-col flex-shrink-0">
    <div class="h-16 flex items-center px-6 text-lg font-semibold tracking-wide">
        <i class="fas fa-leaf mr-2 text-blue-300"></i> E-Counseling
    </div>

    <nav class="flex-1 overflow-y-auto py-6">
        <a href="#" onclick="switchView('view-dashboard')" id="nav-dashboard" class="flex items-center px-6 py-3 text-gray-200 hover:bg-white/10 rounded-r-full mr-4 transition mb-2">
            <span class="font-medium">Dashboard</span>
        </a>
        <a href="#" class="flex items-center px-6 py-3 text-gray-200 hover:bg-white/10 rounded-r-full mr-4 transition mb-2">
            <span class="font-medium">Appointment</span>
        </a>
        <a href="#" class="flex items-center px-6 py-3 text-gray-200 hover:bg-white/10 rounded-r-full mr-4 transition mb-2">
            <span class="font-medium">Questionnaire</span>
        </a>

        <div class="px-6 py-3 text-gray-200 hover:bg-white/10 rounded-r-full mr-4 transition cursor-pointer flex justify-between items-center mb-2">
            <span class="font-medium">Interest</span>
            <i class="fas fa-chevron-down text-xs"></i>
        </div>

        <div>
            <div onclick="toggleMenu('talent-submenu', 'talent-icon')" class="px-6 py-3 text-gray-200 hover:bg-white/10 rounded-r-full mr-4 transition cursor-pointer flex justify-between items-center mb-1">
                <span class="font-medium">Talent</span>
                <i id="talent-icon" class="fas fa-chevron-up text-xs transition-transform duration-300"></i>
            </div>
            
            <div id="talent-submenu" class="flex flex-col mb-2 overflow-hidden transition-all duration-300" style="max-height: 200px;">
                <a href="#" onclick="switchView('view-kuisioner')" id="nav-search-stage" class="bg-[#5c7296] text-white mx-4 px-4 py-2 rounded-lg text-sm font-medium transition mb-1 shadow-sm">
                    Search Stage
                </a>
                <a href="#" onclick="switchView('view-pengembangan')" id="nav-dev-stage" class="text-gray-300 hover:text-white mx-4 px-4 py-2 rounded-lg text-sm transition">
                    Development Stage
                </a>
            </div>
        </div>
    </nav>
</aside>