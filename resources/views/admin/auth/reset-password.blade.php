<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reset Password - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { font-family: 'Inter', sans-serif; }
        .hero-gradient {
            background: linear-gradient(135deg, #0A1928 0%, #0D2A3A 50%, #1B4D3E 100%);
        }
        .password-requirements li {
            transition: color 0.3s ease;
        }
        .password-requirements li.met {
            color: #22c55e;
        }
        .password-requirements li.met .req-icon {
            background-color: #22c55e;
            border-color: #22c55e;
            color: white;
        }
        .password-requirements li .req-icon {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-[#0A1928] to-[#0D2A3A] min-h-screen flex items-center justify-center px-4">
    
    <div class="w-full max-w-6xl bg-white/5 backdrop-blur-sm rounded-2xl shadow-2xl overflow-hidden flex flex-col md:flex-row">
        
        <!-- ============================================ -->
        <!-- LEFT COLUMN - BRANDING -->
        <!-- ============================================ -->
        <div class="w-full md:w-1/2 hero-gradient p-8 md:p-12 flex flex-col justify-between">
            <div>
                <div class="flex items-center space-x-3 mb-8">
                    <div class="w-12 h-12 bg-[#2D6A4F] rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-building text-white text-xl"></i>
                    </div>
                    <span class="text-white text-2xl font-bold tracking-tight">{{ config('app.name') }}</span>
                </div>
                
                <h1 class="text-white text-3xl md:text-4xl font-bold mb-4 leading-tight">
                    Create New <br>
                    <span class="text-[#2D6A4F]">Password</span>
                </h1>
                
                <p class="text-gray-300 text-base leading-relaxed mb-8">
                    Choose a strong password for your account. Make sure it's something you'll remember.
                </p>
                
                <div class="space-y-3">
                    <div class="flex items-center space-x-3 text-gray-300">
                        <div class="w-5 h-5 bg-[#2D6A4F] rounded-full flex items-center justify-center">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="text-sm">Minimum 8 characters</span>
                    </div>
                    <div class="flex items-center space-x-3 text-gray-300">
                        <div class="w-5 h-5 bg-[#2D6A4F] rounded-full flex items-center justify-center">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="text-sm">Uppercase & lowercase letters</span>
                    </div>
                    <div class="flex items-center space-x-3 text-gray-300">
                        <div class="w-5 h-5 bg-[#2D6A4F] rounded-full flex items-center justify-center">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="text-sm">At least one number & special character</span>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 pt-8 border-t border-white/10">
                <p class="text-gray-400 text-xs">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                </p>
            </div>
        </div>
        
        <!-- ============================================ -->
        <!-- RIGHT COLUMN - FORM -->
        <!-- ============================================ -->
        <div class="w-full md:w-1/2 bg-white p-8 md:p-12">
            <div class="max-w-md mx-auto">
                
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-[#0A1928]">Set New Password</h2>
                    <p class="text-gray-500 mt-2">Create your new password below</p>
                </div>
                
                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                            <span class="text-red-700 text-sm">{{ session('error') }}</span>
                        </div>
                    </div>
                @endif
                
                <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
                    @csrf
                    
                    <input type="hidden" name="token" value="{{ $token }}">
                    
                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email Address <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400 text-sm"></i>
                            </div>
                            <input type="email" name="email" value="{{ old('email', $email ?? '') }}" required
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition"
                                   placeholder="your@email.com">
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- New Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">New Password <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400 text-sm"></i>
                            </div>
                            <input type="password" name="password" id="password" required
                                   class="w-full pl-10 pr-12 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition"
                                   placeholder="Enter new password">
                            <button type="button" onclick="togglePassword('password')" 
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition">
                                <i id="password-eye" class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Confirm Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400 text-sm"></i>
                            </div>
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                   class="w-full pl-10 pr-12 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition"
                                   placeholder="Confirm your password">
                            <button type="button" onclick="togglePassword('password_confirmation')" 
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition">
                                <i id="password_confirmation-eye" class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Password Requirements -->
                    <div class="password-requirements bg-gray-50 rounded-xl p-4">
                        <p class="text-sm font-medium text-gray-700 mb-2">Password must contain:</p>
                        <ul class="text-xs text-gray-500 space-y-1">
                            <li id="req-length" class="flex items-center transition">
                                <span class="w-4 h-4 rounded-full border-2 border-gray-300 flex items-center justify-center mr-2 text-xs transition req-icon" id="req-length-icon">○</span>
                                At least 8 characters
                            </li>
                            <li id="req-upper" class="flex items-center transition">
                                <span class="w-4 h-4 rounded-full border-2 border-gray-300 flex items-center justify-center mr-2 text-xs transition req-icon" id="req-upper-icon">○</span>
                                One uppercase letter
                            </li>
                            <li id="req-lower" class="flex items-center transition">
                                <span class="w-4 h-4 rounded-full border-2 border-gray-300 flex items-center justify-center mr-2 text-xs transition req-icon" id="req-lower-icon">○</span>
                                One lowercase letter
                            </li>
                            <li id="req-number" class="flex items-center transition">
                                <span class="w-4 h-4 rounded-full border-2 border-gray-300 flex items-center justify-center mr-2 text-xs transition req-icon" id="req-number-icon">○</span>
                                One number
                            </li>
                            <li id="req-special" class="flex items-center transition">
                                <span class="w-4 h-4 rounded-full border-2 border-gray-300 flex items-center justify-center mr-2 text-xs transition req-icon" id="req-special-icon">○</span>
                                One special character (!@#$%^&*)
                            </li>
                        </ul>
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full py-3 bg-gradient-to-r from-[#0A1928] to-[#0D2A3A] hover:from-[#0D2A3A] hover:to-[#0A1928] text-white rounded-lg font-semibold transition shadow-md">
                        <i class="fas fa-check-circle mr-2"></i> Reset Password
                    </button>
                </form>
                
                <!-- Back to Login -->
                <div class="mt-6 pt-6 text-center border-t border-gray-200">
                    <a href="{{ route('login') }}" class="text-sm text-[#2D6A4F] hover:text-[#1B4D3E] font-medium transition">
                        <i class="fas fa-arrow-left mr-1"></i> Back to Login
                    </a>
                </div>
            </div>
        </div>
        
    </div>
    
    <script>
        // Toggle password visibility
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const eyeIcon = document.getElementById(fieldId + '-eye');
            
            if (field.type === 'password') {
                field.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
        
        // Password requirements validation
        document.addEventListener('DOMContentLoaded', function() {
            const password = document.getElementById('password');
            
            password.addEventListener('input', function() {
                const val = this.value;
                
                // Helper function to update requirement
                function updateRequirement(id, condition) {
                    const element = document.getElementById(id);
                    const icon = document.getElementById(id + '-icon');
                    
                    if (condition) {
                        element.classList.add('text-green-600');
                        element.classList.remove('text-gray-500');
                        icon.textContent = '✓';
                        icon.className = 'w-4 h-4 rounded-full bg-green-500 text-white flex items-center justify-center mr-2 text-xs req-icon';
                    } else {
                        element.classList.remove('text-green-600');
                        element.classList.add('text-gray-500');
                        icon.textContent = '○';
                        icon.className = 'w-4 h-4 rounded-full border-2 border-gray-300 flex items-center justify-center mr-2 text-xs req-icon transition';
                    }
                }
                
                updateRequirement('req-length', val.length >= 8);
                updateRequirement('req-upper', /[A-Z]/.test(val));
                updateRequirement('req-lower', /[a-z]/.test(val));
                updateRequirement('req-number', /[0-9]/.test(val));
                updateRequirement('req-special', /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(val));
            });
        });
    </script>
    
</body>
</html>