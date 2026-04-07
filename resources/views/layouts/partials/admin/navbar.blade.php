<nav class="bg-white border-b border-gray-200 sticky top-0 z-40 lg:ml-72 transition-all duration-300">
    <div class="px-4 lg:px-6 py-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <button onclick="toggleSidebar()" 
                        class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors"
                        aria-label="Toggle menu">
                    <i class="fas fa-bars text-gray-600 text-lg"></i>
                </button>
                
                <div class="flex items-center gap-3">
                    <div class="hidden sm:flex items-center justify-center w-10 h-10 rounded-lg gradient-bg">
                        <i class="fas fa-school text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-base lg:text-lg font-bold text-gray-800">SMP ISLAMI TERPADU AL-FATH</h1>
                        <p class="text-xs text-gray-500 hidden md:block">Tahun Ajaran 2025/2026</p>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center gap-2 lg:gap-4">
                <div class="hidden md:block relative">
                    <input type="text" 
                           placeholder="Cari sesuatu..." 
                           class="w-64 lg:w-80 pl-10 pr-4 py-2 bg-gray-100 border-0 rounded-xl focus:bg-white focus:ring-2 focus:ring-primary-500 transition-all-300 text-sm">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </div>
                
                </div>
        </div>
    </div>
</nav>