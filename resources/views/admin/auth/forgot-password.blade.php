<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Forgot Password - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { font-family: 'Inter', sans-serif; }
        .hero-gradient {
            background: linear-gradient(135deg, #0A1928 0%, #0D2A3A 50%, #1B4D3E 100%);
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
                    Forgot Your <br>
                    <span class="text-[#2D6A4F]">Password?</span>
                </h1>
                
                <p class="text-gray-300 text-base leading-relaxed mb-8">
                    Don't worry, it happens to the best of us. Enter your email address and we'll send you a link to reset your password.
                </p>
                
                <div class="space-y-3">
                    <div class="flex items-center space-x-3 text-gray-300">
                        <div class="w-5 h-5 bg-[#2D6A4F] rounded-full flex items-center justify-center">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="text-sm">Secure password reset process</span>
                    </div>
                    <div class="flex items-center space-x-3 text-gray-300">
                        <div class="w-5 h-5 bg-[#2D6A4F] rounded-full flex items-center justify-center">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="text-sm">24/7 customer support available</span>
                    </div>
                    <div class="flex items-center space-x-3 text-gray-300">
                        <div class="w-5 h-5 bg-[#2D6A4F] rounded-full flex items-center justify-center">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="text-sm">Quick response within minutes</span>
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
                    <h2 class="text-2xl font-bold text-[#0A1928]">Reset Password</h2>
                    <p class="text-gray-500 mt-2">Enter your email to receive a reset link</p>
                </div>
                
                @if(session('status'))
                    <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-500 rounded-r-lg">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span class="text-green-700 text-sm">{{ session('status') }}</span>
                        </div>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                            <span class="text-red-700 text-sm">{{ session('error') }}</span>
                        </div>
                    </div>
                @endif
                
                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf
                    
                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email Address <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400 text-sm"></i>
                            </div>
                            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition"
                                   placeholder="your@email.com">
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full py-3 bg-gradient-to-r from-[#0A1928] to-[#0D2A3A] hover:from-[#0D2A3A] hover:to-[#0A1928] text-white rounded-lg font-semibold transition shadow-md">
                        <i class="fas fa-paper-plane mr-2"></i> Send Reset Link
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
</body>
</html>