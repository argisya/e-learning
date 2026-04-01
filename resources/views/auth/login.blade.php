<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-Learning Platform</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">


    <style>
        /* Custom Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        /* Light overlay for text readability only */
        .image-overlay {
            background: linear-gradient(
                to bottom,
                rgba(102, 126, 234, 0.3) 0%,
                rgba(118, 75, 162, 0.2) 50%,
                rgba(102, 126, 234, 0.4) 100%
            );
        }
        
        .input-focus-ring:focus-within {
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.15);
        }
        
        /* Loading Spinner */
        .spinner {
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        /* Smooth transitions */
        .transition-all-300 {
            transition: all 0.3s ease;
        }
        
        /* Text shadow for readability on image */
        .text-shadow {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        /* Glass effect */
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex">
        <!-- Left Side - Image -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-gradient-to-br from-primary-500 to-secondary-500">
            <!-- School Image - NO HEAVY OVERLAY -->
            <div class="absolute inset-0">
                <img src="{{ asset('logo-login.svg') }}" 
                     alt="School Building" 
                     class="w-full h-full object-cover">
                <!-- Light overlay only for text readability -->
                <div class="absolute inset-0 image-overlay opacity-60"></div>
            </div>
            
            <!-- Subtle Decorative Elements -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute top-10 right-10 w-32 h-32 bg-white/5 rounded-full blur-2xl"></div>
                <div class="absolute bottom-10 left-10 w-32 h-32 bg-white/5 rounded-full blur-2xl"></div>
            </div>
            
            <!-- Content Container - RESPONSIVE FIXED -->
            <div class="relative z-10 flex items-center justify-center w-full h-full">
                <div class="w-full max-w-content px-8 lg:px-12 xl:px-16 text-center text-white">
                    <div class="animate-fade-in space-y-6">
                        <!-- Icon/Logo -->
                        <!-- <div class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 rounded-2xl glass-effect mb-4 animate-float">
                            <i class="fas fa-graduation-cap text-2xl sm:text-3xl lg:text-4xl text-black"></i>
                        </div> -->
                        
                        <!-- Title -->
                        <h1 class="text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-bold leading-tight text-shadow">
                            Selamat Datang di<br/>
                            <span class="text-white">E-Learning Platform</span>
                        </h1>
                        
                        <!-- Description -->
                        <p class="text-sm sm:text-base lg:text-lg xl:text-xl text-white/95 max-w-lg mx-auto leading-relaxed text-shadow">
                            Platform pembelajaran digital untuk masa depan yang lebih baik
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Bottom Wave Decoration -->
            <div class="absolute bottom-0 left-0 right-0 z-20">
                <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                    <path d="M0 120L60 110C120 100 240 80 360 70C480 60 600 60 720 65C840 70 960 80 1080 85C1200 90 1320 90 1380 90L1440 90V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="#f9fafb"/>
                </svg>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center bg-gray-50 p-4 sm:p-8 lg:p-12 xl:p-16">
            <div class="w-full max-w-md animate-fade-in">
                <!-- Logo Section -->
                <div class="text-center mb-8 lg:mb-10">
                    <div class="inline-flex items-center justify-center w-20 h-20 lg:w-24 lg:h-24 rounded-full gradient-bg mb-4 lg:mb-6 shadow-xl transform hover:scale-105 transition-all-300">
                        <img src="{{ asset('GARA-logo.svg') }}" 
                            alt="School Logo" 
                            class="w-full h-full object-cover">
                    </div>
                    <h2 class="text-2xl lg:text-3xl font-bold text-gray-800 mb-2">E-LEARNING</h2>
                    <p class="text-gray-500 text-sm lg:text-base">Silakan login untuk melanjutkan</p>
                </div>

                <!-- Login Form -->
                <form action="{{ route('login.process') }}" method="POST" id="loginForm" class="space-y-5 lg:space-y-6">
                    @csrf
                    
                    <!-- Username Input -->
                    <div>
                        <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">
                            Username
                        </label>
                        <div class="relative input-focus-ring rounded-xl transition-all-300">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input type="text" 
                                   id="username" 
                                   name="username" 
                                   value="{{ old('username') }}"
                                   placeholder="Masukkan username" 
                                   required 
                                   autofocus
                                   autocomplete="username"
                                   class="w-full pl-11 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:outline-none transition-all-300 @error('username') border-red-500 @enderror">
                        </div>
                        @error('username')
                            <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            Password
                        </label>
                        <div class="relative input-focus-ring rounded-xl transition-all-300">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   placeholder="Masukkan password" 
                                   required
                                   autocomplete="current-password"
                                   class="w-full pl-11 pr-12 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:outline-none transition-all-300 @error('password') border-red-500 @enderror">
                            <button type="button" 
                                    id="togglePassword"
                                    class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-primary-500 transition-colors"
                                    aria-label="Toggle password visibility">
                                <i class="fas fa-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" 
                                   name="remember" 
                                   class="w-4 h-4 text-primary-500 border-gray-300 rounded focus:ring-primary-500 focus:ring-2">
                            <span class="text-sm text-gray-600">Ingat saya</span>
                        </label>
                        <a href="" 
                           class="text-sm text-primary-600 hover:text-primary-700 font-medium hover:underline transition-all-300">
                            Lupa password?
                        </a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            id="btnLogin"
                            class="w-full gradient-bg text-white font-semibold py-3.5 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all-300 focus:outline-none focus:ring-4 focus:ring-primary-200 disabled:opacity-70 disabled:cursor-not-allowed disabled:transform-none">
                        <span id="btnText">Masuk</span>
                        <div id="btnLoading" class="hidden spinner w-6 h-6 mx-auto"></div>
                    </button>
                </form>

                <!-- Divider -->
                <!-- <div class="relative my-6 lg:my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-gray-50 text-gray-500">Atau</span>
                    </div>
                </div> -->

                <!-- Social Login (Optional) -->
                <!-- <div class="grid grid-cols-2 gap-3">
                    <button type="button" class="flex items-center justify-center gap-2 px-4 py-2.5 border-2 border-gray-200 rounded-xl hover:border-gray-300 hover:bg-gray-50 transition-all-300">
                        <i class="fab fa-google text-red-500"></i>
                        <span class="text-sm font-medium text-gray-700">Google</span>
                    </button>
                    <button type="button" class="flex items-center justify-center gap-2 px-4 py-2.5 border-2 border-gray-200 rounded-xl hover:border-gray-300 hover:bg-gray-50 transition-all-300">
                        <i class="fab fa-github text-gray-800"></i>
                        <span class="text-sm font-medium text-gray-700">GitHub</span>
                    </button>
                </div> -->

                <!-- Register Link -->
                <!-- <div class="mt-8 text-center">
                    <p class="text-gray-600">
                        Belum punya akun? 
                        <a href="" 
                           class="text-primary-600 hover:text-primary-700 font-semibold hover:underline transition-all-300">
                            Daftar Sekarang
                        </a>
                    </p>
                </div> -->

                <!-- Copyright -->
                <div class="mt-8 text-center text-xs sm:text-sm text-gray-400">
                    Copyright © {{ date('Y') }} - E-Learning Platform
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle Password Visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle icon
            eyeIcon.classList.toggle('fa-eye');
            eyeIcon.classList.toggle('fa-eye-slash');
            
            // Toggle color
            // if (type === 'text') {
            //     this.classList.add('text-primary-500');
            //     this.classList.remove('text-gray-400');
            // } else {
            //     this.classList.remove('text-primary-500');
            //     this.classList.add('text-gray-400');
            // }
        });

        // Form Submission with Loading Animation
        const loginForm = document.getElementById('loginForm');
        const btnLogin = document.getElementById('btnLogin');
        const btnText = document.getElementById('btnText');
        const btnLoading = document.getElementById('btnLoading');

        loginForm.addEventListener('submit', function(e) {
            btnText.classList.add('hidden');
            btnLoading.classList.remove('hidden');
            btnLogin.disabled = true;
        });

        // Input Focus Effects
        const inputs = document.querySelectorAll('input[type="text"], input[type="password"]');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('scale-[1.02]');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('scale-[1.02]');
            });
        });

        // Auto-hide error messages after 5 seconds
        setTimeout(() => {
            const errorMessages = document.querySelectorAll('.text-red-600');
            errorMessages.forEach(msg => {
                msg.style.transition = 'opacity 0.5s';
                msg.style.opacity = '0';
                setTimeout(() => msg.style.display = 'none', 500);
            });
        }, 5000);
    </script>
</body>
</html>