<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - E-Learning Platform</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#f0f4ff',
                            100: '#e0eaff',
                            200: '#c7d7fe',
                            300: '#a4bcfd',
                            400: '#8098f9',
                            500: '#667eea',
                            600: '#5a67d8',
                            700: '#4c51bf',
                            800: '#434190',
                            900: '#3c366b',
                        },
                        secondary: {
                            500: '#764ba2',
                            600: '#6b3a8f',
                        }
                    },
                    transitionProperty: {
                        'width': 'width',
                        'margin': 'margin',
                    }
                }
            }
        }
    </script>
    
    <style>
        /* Custom Scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #c7d7fe;
            border-radius: 10px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #667eea;
        }
        
        /* Sidebar Transition */
        .sidebar-transition {
            transition: all 0.3s ease-in-out;
        }
        
        /* Dropdown Animation */
        .dropdown-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-in-out;
        }
        
        .dropdown-menu.open {
            max-height: 500px;
        }
        
        /* Active State */
        .nav-item.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .nav-item.active i {
            color: white;
        }
        
        /* Gradient Background */
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        /* Glass Effect */
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }
        
        /* Notification Badge Animation */
        @keyframes pulse-ring {
            0% { transform: scale(0.8); opacity: 1; }
            100% { transform: scale(2); opacity: 0; }
        }
        
        .notification-pulse::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 50%;
            background: #ef4444;
            animation: pulse-ring 2s infinite;
        }
        
        /* Content Area Transition */
        .content-transition {
            transition: margin-left 0.3s ease-in-out;
        }
    </style>
    
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        @include('layouts.partials.sidebar')
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col content-transition" id="mainContent">
            <!-- Navbar -->
            @include('layouts.partials.navbar')
            
            <!-- Page Content -->
            <main class="flex-1 p-6 lg:p-8 overflow-y-auto custom-scrollbar">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl flex items-center gap-3">
                        <i class="fas fa-check-circle text-green-500"></i>
                        <span class="text-green-700">{{ session('success') }}</span>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl flex items-center gap-3">
                        <i class="fas fa-exclamation-circle text-red-500"></i>
                        <span class="text-red-700">{{ session('error') }}</span>
                    </div>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>
    
    <!-- Mobile Sidebar Overlay -->
    <div id="sidebarOverlay" 
         class="fixed inset-0 bg-black/50 z-40 lg:hidden hidden"
         onclick="toggleSidebar()"></div>
    
    <!-- Tailwind JS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom Scripts -->
    <script>
        // Toggle Sidebar (Mobile)
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const mainContent = document.getElementById('mainContent');
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
        
        // Toggle Dropdown
        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            const icon = document.getElementById(`icon-${id}`);
            
            dropdown.classList.toggle('open');
            icon.classList.toggle('rotate-180');
        }
        
        // Set Active State
        function setActive(element) {
            document.querySelectorAll('.nav-item').forEach(item => {
                item.classList.remove('active');
            });
            element.classList.add('active');
        }
        
        // Notification Dropdown
        function toggleNotification() {
            const dropdown = document.getElementById('notificationDropdown');
            dropdown.classList.toggle('hidden');
        }
        
        // User Dropdown
        function toggleUserDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('hidden');
        }
        
        // Search Toggle (Mobile)
        function toggleSearch() {
            const searchBox = document.getElementById('mobileSearch');
            searchBox.classList.toggle('hidden');
            if (!searchBox.classList.contains('hidden')) {
                searchBox.querySelector('input').focus();
            }
        }
        
        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const notificationBtn = document.getElementById('notificationBtn');
            const notificationDropdown = document.getElementById('notificationDropdown');
            const userBtn = document.getElementById('userBtn');
            const userDropdown = document.getElementById('userDropdown');
            
            if (notificationBtn && !notificationBtn.contains(event.target) && 
                notificationDropdown && !notificationDropdown.contains(event.target)) {
                notificationDropdown.classList.add('hidden');
            }
            
            if (userBtn && !userBtn.contains(event.target) && 
                userDropdown && !userDropdown.contains(event.target)) {
                userDropdown.classList.add('hidden');
            }
        });
        
        // Keyboard Navigation
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                document.getElementById('notificationDropdown')?.classList.add('hidden');
                document.getElementById('userDropdown')?.classList.add('hidden');
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>