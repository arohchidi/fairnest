<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name')) - {{ config('app.name') }}</title>
    <meta name="description" content="@yield('description', 'Find your perfect rental property')">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Add this to your layout head or page -->

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
    </style>
    
    @stack('styles')
   
</head>
<body class="bg-gray-50 pt-16">
    
    <!-- Navigation -->
   <nav class="fixed top-0 left-0 right-0 z-50 bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-[#2D6A4F] rounded-lg flex items-center justify-center">
                            <i class="fas fa-building text-white text-sm"></i>
                        </div>
                        <span class="font-bold text-xl text-gray-800">{{ config('app.name') }}</span>
                    </a>
                </div>
                
                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ url('/') }}" class="text-gray-600 hover:text-[#2D6A4F] transition">Home</a>
                    <a href="{{ url('/properties') }}" class="text-gray-600 hover:text-[#2D6A4F] transition">Properties</a>
                    <a href="{{ url('/about') }}" class="text-gray-600 hover:text-[#2D6A4F] transition">About</a>
                    <a href="{{ url('/contact') }}" class="text-gray-600 hover:text-[#2D6A4F] transition">Contact</a>
                </div>
                
                <!-- Auth Links -->
                <div class="flex items-center space-x-4">
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-[#2D6A4F] transition">Login</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-[#2D6A4F] text-white rounded-lg hover:bg-[#1B4D3E] transition">Sign Up</a>
                    @else
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-[#2D6A4F] rounded-full flex items-center justify-center text-white font-semibold">
                                    {{ strtoupper(substr(auth()->user()->username ?? auth()->user()->name ?? 'U', 0, 1)) }}
                                </div>
                                <span class="text-gray-700">{{ auth()->user()->username ?? auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down text-xs text-gray-500"></i>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-100 py-1 z-50" style="display: none;">
                                <a href="{{ url('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Dashboard</a>
                                <a href="{{ url('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Profile</a>
                                <form method="POST" action="{{ url('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-50">Logout</button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
                
                <!-- Mobile menu button -->
                <button id="mobileMenuButton" class="md:hidden text-gray-600">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
        
        <!-- Mobile menu -->
        <div id="mobileMenu" class="hidden md:hidden bg-white border-t border-gray-200 py-2">
            <a href="{{ url('/') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-50">Home</a>
            <a href="{{ url('/properties') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-50">Properties</a>
            <a href="{{ url('/about') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-50">About</a>
            <a href="{{ url('/contact') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-50">Contact</a>
        </div>
    </nav>
    
    <!-- Main Content -->
    <main>
    @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                    {{ session('error') }}
                </div>
            @endif
        @yield('content')
        
    </main>
    
  
    <!-- Alpine.js for dropdown -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Mobile menu toggle -->
    <script>
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');
        
        if (mobileMenuButton) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
    </script>
    
    @stack('scripts')
</body>
</html>