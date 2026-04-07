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
            <!-- Mobile Search Toggle -->
            <button onclick="toggleSearch()" 
                    class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors"
                    aria-label="Search">
                <i class="fas fa-search text-gray-600"></i>
            </button>
            
            <!-- Mobile Search Box -->
            <div id="mobileSearch" class="hidden md:hidden absolute top-full left-4 right-4 mt-2">
                <input type="text" 
                        placeholder="Cari sesuatu..." 
                        class="w-full pl-10 pr-4 py-2 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 text-sm shadow-lg">
                <i class="fas fa-search absolute left-7 top-1/2 -translate-y-1/2 text-gray-400"></i>
            </div>
            
            <!-- Notifications -->
            <div class="relative">
                <button id="notificationBtn"
                        onclick="toggleNotification()"
                        class="relative p-2 rounded-lg hover:bg-gray-100 transition-colors"
                        aria-label="Notifications">
                    <i class="fas fa-bell text-gray-600 text-lg"></i>
                    <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-red-500 rounded-full notification-pulse"></span>
                    <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center font-semibold">3</span>
                </button>
                
                <!-- Notification Dropdown -->
                <div id="notificationDropdown" 
                        class="hidden absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-2xl border border-gray-200 overflow-hidden">
                    <div class="px-4 py-3 border-b border-gray-200 flex items-center justify-between">
                        <h3 class="font-semibold text-gray-800">Notifikasi</h3>
                        <a href="#" class="text-xs text-primary-600 hover:underline">Lihat Semua</a>
                    </div>
                    <div class="max-h-80 overflow-y-auto custom-scrollbar">
                        <!-- Notification Item -->
                        <a href="#" class="flex items-start gap-3 px-4 py-3 hover:bg-gray-50 transition-colors border-b border-gray-100">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-book text-blue-600"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-800 truncate">Tugas Baru Ditambahkan</p>
                                <p class="text-xs text-gray-500 truncate">Matematika - Bab 5: Aljabar</p>
                                <p class="text-xs text-gray-400 mt-1">5 menit yang lalu</p>
                            </div>
                        </a>
                        <a href="#" class="flex items-start gap-3 px-4 py-3 hover:bg-gray-50 transition-colors border-b border-gray-100">
                            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-check-circle text-green-600"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-800 truncate">Nilai Telah Diterbitkan</p>
                                <p class="text-xs text-gray-500 truncate">Ujian Tengah Semester</p>
                                <p class="text-xs text-gray-400 mt-1">1 jam yang lalu</p>
                            </div>
                        </a>
                        <a href="#" class="flex items-start gap-3 px-4 py-3 hover:bg-gray-50 transition-colors">
                            <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-bullhorn text-orange-600"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-800 truncate">Pengumuman Baru</p>
                                <p class="text-xs text-gray-500 truncate">Libur Hari Raya</p>
                                <p class="text-xs text-gray-400 mt-1">2 jam yang lalu</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            
            
            <!-- Messages -->
            <button class="hidden lg:block p-2 rounded-lg hover:bg-gray-100 transition-colors relative"
                    aria-label="Messages">
                <i class="fas fa-envelope text-gray-600 text-lg"></i>
                <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-green-500 rounded-full"></span>
            </button>
            
            <!-- Divider -->
            <div class="hidden lg:block w-px h-8 bg-gray-200"></div>

            <div class="flex items-center gap-2 lg:gap-4">
                <div class="hidden md:block relative">
                    <input type="text" 
                           placeholder="Cari sesuatu..." 
                           class="w-64 lg:w-80 pl-10 pr-4 py-2 bg-gray-100 border-0 rounded-xl focus:bg-white focus:ring-2 focus:ring-primary-500 transition-all-300 text-sm">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </div>    
            </div>
            
            <!-- User Profile -->
            <div class="relative">
                <button id="userBtn"
                        onclick="toggleUserDropdown()"
                        class="flex items-center gap-2 lg:gap-3 p-1.5 lg:p-2 rounded-xl hover:bg-gray-100 transition-colors">
                    <img src="{{ asset('images/avatar.jpg') }}" 
                            alt="User Avatar" 
                            class="w-8 h-8 lg:w-10 lg:h-10 rounded-full object-cover border-2 border-primary-500">
                    <div class="hidden lg:block text-left">
                        <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name ?? 'User Name' }}</p>
                        <p class="text-xs text-gray-500">{{ auth()->user()->role ?? 'Siswa' }}</p>
                    </div>
                    <i class="fas fa-chevron-down text-gray-400 text-xs hidden lg:block"></i>
                </button>
                
                <!-- User Dropdown -->
                <div id="userDropdown" 
                        class="hidden absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-2xl border border-gray-200 overflow-hidden">
                    <!-- User Info -->
                    <div class="px-4 py-3 bg-gradient-to-r from-primary-500 to-secondary-500 text-white">
                        <p class="font-semibold">{{ auth()->user()->name ?? 'User Name' }}</p>
                        <p class="text-xs text-white/80">{{ auth()->user()->email ?? 'user@example.com' }}</p>
                    </div>
                    
                    <!-- Menu Items -->
                    <div class="py-2">
                        <a href="" class="flex items-center gap-3 px-4 py-2.5 hover:bg-gray-50 transition-colors">
                            <i class="fas fa-user text-gray-500 w-5"></i>
                            <span class="text-sm text-gray-700">Profil Saya</span>
                        </a>
                        <a href="" class="flex items-center gap-3 px-4 py-2.5 hover:bg-gray-50 transition-colors">
                            <i class="fas fa-cog text-gray-500 w-5"></i>
                            <span class="text-sm text-gray-700">Pengaturan</span>
                        </a>
                        <a href="" class="flex items-center gap-3 px-4 py-2.5 hover:bg-gray-50 transition-colors">
                            <i class="fas fa-question-circle text-gray-500 w-5"></i>
                            <span class="text-sm text-gray-700">Bantuan</span>
                        </a>
                    </div>
                    
                    <!-- Divider -->
                    <div class="border-t border-gray-200"></div>
                    
                    <!-- Logout -->
                    <form action="" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 hover:bg-red-50 transition-colors text-red-600">
                            <i class="fas fa-sign-out-alt w-5"></i>
                            <span class="text-sm">Keluar</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>