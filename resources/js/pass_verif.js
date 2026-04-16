// Password Strength Checker
        window.checkStrength = function(password) {
            const meter = document.getElementById('strengthMeter');
            const text = document.getElementById('strengthText');
            
            if (!password || password.length === 0) {
                meter.classList.add('hidden');
                text.textContent = '';
                return;
            }
            
            let strength = 0;
            
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/\d/.test(password)) strength++;
            if (/[^a-zA-Z\d]/.test(password)) strength++;
            
            meter.classList.remove('hidden');
            
            if (strength <= 2) {
                meter.className = 'strength-meter weak';
                text.textContent = 'Lemah';
                text.className = 'text-xs font-medium text-red-600';
            } else if (strength <= 4) {
                meter.className = 'strength-meter medium';
                text.textContent = 'Sedang';
                text.className = 'text-xs font-medium text-orange-500';
            } else {
                meter.className = 'strength-meter strong';
                text.textContent = 'Kuat';
                text.className = 'text-xs font-medium text-green-600';
            }
        }
        
        // Password Match Verification
        window.verifyPasswordMatch = function(confirmPassword) {
            const password = document.getElementById('password').value;
            const matchIcon = document.getElementById('matchIcon');
            const unmatchIcon = document.getElementById('unmatchIcon');
            
            if (confirmPassword === '') {
                matchIcon.classList.add('hidden');
                unmatchIcon.classList.add('hidden');
                return;
            }
            
            if (password === confirmPassword) {
                matchIcon.classList.remove('hidden');
                unmatchIcon.classList.add('hidden');
            } else {
                matchIcon.classList.add('hidden');
                unmatchIcon.classList.remove('hidden');
            }
        }
        
        // Toggle Password Visibility
        window.togglePasswordVisibility = function(fieldId, checkbox) {
            const input = document.getElementById(fieldId);
            input.type = checkbox.checked ? 'text' : 'password';
        }
        
        // Enable Disable Email Fields
        window.enableDisableFields = function() {
            const sendEmail = document.getElementById('kirim_invitation').checked;
            const subjectField = document.getElementById('subjectEmailField');
            const bodyField = document.getElementById('email_body');
            
            subjectField.style.opacity = sendEmail ? '1' : '0.5';
            bodyField.style.opacity = sendEmail ? '1' : '0.5';
            
            if (!sendEmail) {
                subjectField.querySelector('input').disabled = true;
                bodyField.querySelector('textarea').disabled = true;
            } else {
                subjectField.querySelector('input').disabled = false;
                bodyField.querySelector('textarea').disabled = false;
            }
        }
        
            
            // Check password match
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            
            if (password !== confirmPassword && confirmPassword !== '') {
                hasError = true;
                isValid = false;
                alert('Password tidak cocok!');
            }
            
            // Check password length
            if (password.length > 0 && password.length < 8) {
                hasError = true;
                isValid = false;
                alert('Password minimal 8 karakter!');
            }
            
            if (!isValid) {
                e.preventDefault();
                alert('Harap lengkapi semua field yang wajib diisi!');
            }
        
        
        // Disable New Password Fields
        window.disableNewPasswordFields = function(keepSame) {
            const passwordField = document.getElementById('password');
            const confirmField = document.getElementById('password_confirmation');
            
            passwordField.disabled = keepSame;
            confirmField.disabled = keepSame;
            
            if (keepSame) {
                passwordField.style.opacity = '0.5';
                confirmField.style.opacity = '0.5';
            } else {
                passwordField.style.opacity = '1';
                confirmField.style.opacity = '1';
            }
        }