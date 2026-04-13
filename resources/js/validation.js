// Form Validation
        window.validateForm = function() {
            const inputs = document.querySelectorAll('[required]');
            let isValid = true;
            
            inputs.forEach(input => {
                if (!input.checkValidity()) {
                    isValid = false;
                    input.classList.add('border-red-500');
                    setTimeout(() => input.classList.remove('border-red-500'), 1000);
                }
            });
            
            if (!isValid) e.preventDefault();
        };
        
        // Preview file upload
        window.previewFile = function() {
            const preview = document.getElementById('previewContainer');
            const file = document.querySelector('#foto').files[0];
            const reader = new FileReader();
            
            reader.onloadend = function () {
                preview.innerHTML = `<img src="${reader.result}" alt="Preview" class="w-full h-full object-cover rounded-lg">`;
            }
            
            if (file) reader.readAsDataURL(file);
            else preview.innerHTML = '<i class="fas fa-camera text-gray-400 text-2xl"></i>';
        }

        // Generate NIS from Class Selection
        window.generateNIS = function(classValue) {
            if (classValue && classValue !== '') {
                const nisInput = document.getElementById('nis');
                const year = new Date().getFullYear();
                const random = Math.floor(Math.random() * 900) + 100;
                nisInput.value = `${year}${random}`;
            }
        }

        // Load Wali Kelas Info
        window.loadWaliInfo = function(value) {
            const previewDiv = document.getElementById('waliInfoPreview');
            
            if (value) {
                previewDiv.classList.remove('hidden');
            } else {
                previewDiv.classList.add('hidden');
            }
        }

        // Print Handler
        window.addEventListener('beforeprint', function() {
            document.body.classList.add('print-mode');
        });
        
        window.addEventListener('afterprint', function() {
            document.body.classList.remove('print-mode');
        });