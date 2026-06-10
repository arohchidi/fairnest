<header class="bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center">
    <div>
        <button onclick="toggleSidebar()" class="text-gray-600 hover:text-[#2D6A4F] md:hidden">
            <i class="fas fa-bars text-2xl"></i>
        </button>
        <div class="hidden md:block">
            <h1 class="text-2xl font-bold text-gray-800">@yield('header-title', 'Dashboard')</h1>
            <p class="text-gray-500 text-sm">@yield('header-description', 'Welcome back')</p>
        </div>
    </div>
    
    <div class="flex items-center space-x-4">
        <div class="relative">
            <button class="text-gray-500 hover:text-[#2D6A4F]">
                <i class="far fa-bell text-xl"></i>
            </button>
        </div>
        
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-[#2D6A4F] rounded-full flex items-center justify-center text-white font-bold">
                {{ strtoupper(substr(auth()->user()->username ?? 'A', 0, 1)) }}
            </div>
            <div class="hidden md:block">
                <p class="text-sm font-semibold">{{ auth()->user()->username ?? 'Admin' }}</p>
                <p class="text-xs text-gray-500">{{ ucfirst(auth()->user()->role ?? 'admin') }}</p>
            </div>
        </div>
    </div>
</header>