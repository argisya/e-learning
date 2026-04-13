// Close modal
        window.closeModal = function(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        // Open Modal
        window.openModal = function(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }
        
        // Confirm Delete
        window.confirmDelete = function(id) {
            window.openModal('modalDeleteConfirmation');
        }

        // Keyboard Navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('.modal').forEach(modal => modal.classList.add('hidden'));
            }
        });