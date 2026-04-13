        window.toggleSidebar = function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const mainContent = document.getElementById('mainContent');
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
        
        // Toggle Dropdown
        window.toggleDropdown = function(id) {
            const dropdown = document.getElementById(id);
            const icon = document.getElementById(`icon-${id}`);
            
            dropdown.classList.toggle('open');
            icon.classList.toggle('rotate-180');
        }
        
        // Set Active State
        window.setActive = function(element) {
            document.querySelectorAll('.nav-item').forEach(item => {
                item.classList.remove('active');
            });
            element.classList.add('active');
        }
        
        // Notification Dropdown
        window.toggleNotification = function() {
            const dropdown = document.getElementById('notificationDropdown');
            dropdown.classList.toggle('hidden');
        }
        
        // User Dropdown
        window.toggleUserDropdown = function() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('hidden');
        }
        
        // Search Toggle (Mobile)
        window.toggleSearch = function() {
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