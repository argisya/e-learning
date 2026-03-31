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
                    }
                }
            }
        }
    </script>
    
    <style>
        /* Custom Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .input-focus-ring:focus-within {
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
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
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex">
        <!-- Left Side - Image -->
        <div class="hidden lg:flex lg:w-1/2 gradient-bg relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <path d="M0,50 Q25,30 50,50 T100,50 L100,100 L0,100 Z" fill="white" />
                </svg>
            </div>
            
            <!-- School Image -->
            <img src="{{ asset('images/school-building.jpg') }}" 
                 alt="School Building" 
                 class="absolute inset-0 w-full h-full object-cover opacity-90">
            
            <!-- Overlay Content -->
            <div class="relative z-10 flex flex-col items-center justify-center text-white p-12 text-center">
                <div class="animate-fade-in">
                    <h1 class="text-4xl xl:text-5xl font-bold mb-6 drop-shadow-lg">
                        Selamat Datang di<br/>E-Learning Platform
                    </h1>
                    <p class="text-lg xl:text-xl opacity-90 max-w-md drop-shadow-md">
                        Platform pembelajaran digital untuk masa depan yang lebih baik
                    </p>
                </div>
            </div>
            
            <!-- Decorative Elements -->
            <div class="absolute bottom-0 left-0 right-0 h-32 gradient-bg opacity-20"></div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center bg-gray-50 p-6 sm:p-12">
            <div class="w-full max-w-md animate-fade-in">
                <!-- Logo Section -->
                <div class="text-center mb-10">
                    <div class="inline-flex items-center justify-center w-24 h-24 rounded-full gradient-bg mb-6 shadow-xl transform hover:scale-105 transition-all-300">
                        <i class="fas fa-graduation-cap text-4xl text-white"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">E-LEARNING</h2>
                    <p class="text-gray-500">Silakan login untuk melanjutkan</p>
                </div>

                <!-- Login Form -->
                <form action="{{ route('login') }}" method="POST" id="loginForm" class="space-y-6">
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
                                   class="w-full pl-11 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:outline-none transition-all-300 @error('username') border-red-500 @enderror">
                        </div>
                        @error('username')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
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
                                   class="w-full pl-11 pr-12 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:outline-none transition-all-300 @error('password') border-red-500 @enderror">
                            <button type="button" 
                                    id="togglePassword"
                                    class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-primary-500 transition-colors">
                                <i class="fas fa-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Forgot Password -->
                    <div class="flex justify-end">
                        <a href="{{ route('password.request') }}" 
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

                <!-- Register Link -->
                <div class="mt-8 text-center">
                    <p class="text-gray-600">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" 
                           class="text-primary-600 hover:text-primary-700 font-semibold hover:underline transition-all-300">
                            Daftar Sekarang
                        </a>
                    </p>
                </div>

                <!-- Copyright -->
                <div class="mt-8 text-center text-sm text-gray-400">
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
            if (type === 'text') {
                this.classList.add('text-primary-500');
                this.classList.remove('text-gray-400');
            } else {
                this.classList.remove('text-primary-500');
                this.classList.add('text-gray-400');
            }
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
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.parentElement.classList.add('scale-[1.02]');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.parentElement.classList.remove('scale-[1.02]');
            });
        });

        // Auto-hide error messages after 5 seconds
        setTimeout(() => {
            const errorMessages = document.querySelectorAll('.text-red-600');
            errorMessages.forEach(msg => {
                msg.style.transition = 'opacity 0.5s';
                msg.style.opacity = '0';
                setTimeout(() => msg.remove(), 500);
            });
        }, 5000);
    </script>
</body>
</html>