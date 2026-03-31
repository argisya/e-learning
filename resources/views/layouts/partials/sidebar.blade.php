<!-- Sidebar -->
<aside id="sidebar" 
       class="fixed lg:static inset-y-0 left-0 z-50 w-72 bg-white border-r border-gray-200 transform -translate-x-full lg:translate-x-0 sidebar-transition flex flex-col">
    <!-- Logo Section -->
    <div class="px-6 py-5 border-b border-gray-200">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-xl gradient-bg flex items-center justify-center shadow-lg">
                <i class="fas fa-graduation-cap text-2xl text-white"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-800">E-LEARNING</h2>
                <p class="text-xs text-gray-500">Platform Pembelajaran</p>
            </div>
        </div>
    </div>
    
    <!-- Navigation Menu -->
    <nav class="flex-1 overflow-y-auto custom-scrollbar py-4">
        <ul class="space-y-1 px-3">
            <!-- Dashboard -->
            <li>
                <a href="" 
                   class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl transition-all-300 {{ request()->routeIs('dashboard') ? 'active' : 'text-gray-600 hover:bg-primary-50' }}">
                    <i class="fas fa-home w-5 text-center"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
            </li>
            
            <!-- Guru Dropdown -->
            <li>
                <button onclick="toggleDropdown('guruDropdown')"
                        class="nav-item w-full flex items-center justify-between gap-3 px-4 py-3 rounded-xl transition-all-300 text-gray-600 hover:bg-primary-50 {{ request()->routeIs('guru.*') ? 'active' : '' }}">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-chalkboard-teacher w-5 text-center"></i>
                        <span class="font-medium">Guru</span>
                    </div>
                    <i id="icon-guruDropdown" class="fas fa-chevron-down text-xs transition-transform"></i>
                </button>
                <div id="guruDropdown" class="dropdown-menu pl-12 pr-3 space-y-1">
                    <a href="" 
                       class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('guru.dashboard') ? 'bg-primary-100 text-primary-700' : 'text-gray-500 hover:bg-gray-50' }}">
                        Dashboard Guru
                    </a>
                    <a href="" 
                       class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('guru.data') ? 'bg-primary-100 text-primary-700' : 'text-gray-500 hover:bg-gray-50' }}">
                        Data Guru
                    </a>
                    <a href="" 
                       class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('guru.jadwal') ? 'bg-primary-100 text-primary-700' : 'text-gray-500 hover:bg-gray-50' }}">
                        Jadwal Guru
                    </a>
                    <a href="" 
                       class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('guru.absensi') ? 'bg-primary-100 text-primary-700' : 'text-gray-500 hover:bg-gray-50' }}">
                        Absensi Guru
                    </a>
                </div>
            </li>
            
            <!-- Siswa Dropdown -->
            <li>
                <button onclick="toggleDropdown('siswaDropdown')"
                        class="nav-item w-full flex items-center justify-between gap-3 px-4 py-3 rounded-xl transition-all-300 text-gray-600 hover:bg-primary-50 {{ request()->routeIs('siswa.*') ? 'active' : '' }}">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-user-graduate w-5 text-center"></i>
                        <span class="font-medium">Siswa</span>
                    </div>
                    <i id="icon-siswaDropdown" class="fas fa-chevron-down text-xs transition-transform"></i>
                </button>
                <div id="siswaDropdown" class="dropdown-menu pl-12 pr-3 space-y-1">
                    <a href="" 
                       class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('siswa.dashboard') ? 'bg-primary-100 text-primary-700' : 'text-gray-500 hover:bg-gray-50' }}">
                        Dashboard Siswa
                    </a>
                    <a href="" 
                       class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('siswa.data') ? 'bg-primary-100 text-primary-700' : 'text-gray-500 hover:bg-gray-50' }}">
                        Data Siswa
                    </a>
                    <a href="" 
                       class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('siswa.jadwal') ? 'bg-primary-100 text-primary-700' : 'text-gray-500 hover:bg-gray-50' }}">
                        Jadwal Siswa
                    </a>
                    <a href="" 
                       class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('siswa.absensi') ? 'bg-primary-100 text-primary-700' : 'text-gray-500 hover:bg-gray-50' }}">
                        Absensi Siswa
                    </a>
                </div>
            </li>
            
            <!-- Kelas -->
            <li>
                <a href="" 
                   class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl transition-all-300 {{ request()->routeIs('kelas') ? 'active' : 'text-gray-600 hover:bg-primary-50' }}">
                    <i class="fas fa-school w-5 text-center"></i>
                    <span class="font-medium">Kelas</span>
                    @if($kelasCount ?? 0 > 0)
                        <span class="ml-auto bg-primary-500 text-white text-xs px-2 py-0.5 rounded-full">{{ $kelasCount }}</span>
                    @endif
                </a>
            </li>
            
            <!-- Rapor -->
            <li>
                <a href="" 
                   class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl transition-all-300 {{ request()->routeIs('rapor') ? 'active' : 'text-gray-600 hover:bg-primary-50' }}">
                    <i class="fas fa-file-alt w-5 text-center"></i>
                    <span class="font-medium">Rapor</span>
                    @if($raporPending ?? 0 > 0)
                        <span class="ml-auto bg-orange-500 text-white text-xs px-2 py-0.5 rounded-full">{{ $raporPending }}</span>
                    @endif
                </a>
            </li>
            
            <!-- Pengumuman -->
            <li>
                <a href="" 
                   class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl transition-all-300 {{ request()->routeIs('pengumuman') ? 'active' : 'text-gray-600 hover:bg-primary-50' }}">
                    <i class="fas fa-bullhorn w-5 text-center"></i>
                    <span class="font-medium">Pengumuman</span>
                    @if($pengumumanBaru ?? 0 > 0)
                        <span class="ml-auto bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">{{ $pengumumanBaru }}</span>
                    @endif
                </a>
            </li>
        </ul>
        
        <!-- Quick Stats (Optional) -->
        <div class="mx-3 mt-6 p-4 bg-gradient-to-r from-primary-500 to-secondary-500 rounded-xl text-white">
            <p class="text-xs text-white/80 mb-2">Progress Belajar</p>
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-semibold">75%</span>
                <span class="text-xs">3/4 Modul</span>
            </div>
            <div class="w-full bg-white/20 rounded-full h-2">
                <div class="bg-white rounded-full h-2 transition-all-300" style="width: 75%"></div>
            </div>
        </div>
    </nav>
    
    <!-- Sidebar Footer -->
    <div class="p-4 border-t border-gray-200">
        <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50">
            <img src="{{ asset('images/avatar.jpg') }}" 
                 alt="User" 
                 class="w-10 h-10 rounded-full object-cover border-2 border-primary-500">
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-gray-800 truncate">{{ auth()->user()->name ?? 'User Name' }}</p>
                <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email ?? 'user@example.com' }}</p>
            </div>
        </div>
        
        <!-- Logout Button (Sidebar) -->
        <form action="" method="POST" class="mt-3">
            @csrf
            <button type="submit" 
                    class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-red-50 text-red-600 rounded-xl hover:bg-red-100 transition-colors font-medium">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>