// Apply Filters
        function applyFilters() {
            const searchInput = document.getElementById('student_search').value.toLowerCase();
            const classFilter = document.getElementById('class_filter').value;
            const genderFilter = document.getElementById('gender_filter').value;
            const statusFilter = document.getElementById('status_filter').value;
            const jenjangFilter = document.getElementById('jenjang_filter').value;
            const tingkatFilter = document.getElementById('tingkat_filter').value;
            const programFilter = document.getElementById('program_filter').value;
            
            console.log('Filters:', { searchInput, classFilter, genderFilter, statusFilter, jenjangFilter, tingkatFilter, programFilter });
            
            if (searchInput.length > 0 || classFilter !== '' || statusFilter !== '') {
                showEmptyState(true);
            } else {
                showEmptyState(false);
            }
        }
        
        // Reset Filters
        function resetFilters() {
            document.getElementById('student_search').value = '';
            document.getElementById('class_filter').value = '';
            document.getElementById('gender_filter').value = '';
            document.getElementById('status_filter').value = '';
            document.getElementById('class_search').value = '';
            document.getElementById('jenjang_filter').value = '';
            document.getElementById('tingkat_filter').value = '';
            document.getElementById('program_filter').value = '';
            showEmptyState(false);
        }
        
        // Show/Hide Empty State
        function showEmptyState(show) {
            const emptyState = document.getElementById('emptyState');
            const tableBody = document.querySelector('#studentContent tbody');
            
            if (show) {
                emptyState.classList.remove('hidden');
                if (tableBody) tableBody.classList.add('hidden');
            } else {
                emptyState.classList.add('hidden');
                if (tableBody) tableBody.classList.remove('hidden');
            }
        }
        