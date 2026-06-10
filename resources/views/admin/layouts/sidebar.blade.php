<aside id="sidebar" class="w-72 bg-gradient-to-b from-[#0A1928] to-[#0D2A3A] h-screen overflow-y-auto fixed md:relative z-20 transition-transform -translate-x-full md:translate-x-0 shadow-2xl">
    <div class="p-6 border-b border-white/10">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-gradient-to-br from-[#2D6A4F] to-[#1B4D3E] rounded-xl flex items-center justify-center shadow-lg">
                <i class="fas fa-building text-white text-xl"></i>
            </div>
            <div>
                <h2 class="text-white text-xl font-bold tracking-tight">{{ config('app.name') }}</h2>
                <p class="text-gray-400 text-xs mt-0.5">Enterprise Platform</p>
            </div>
        </div>
        <button onclick="toggleSidebar()" class="absolute top-6 right-4 text-gray-400 hover:text-white md:hidden">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>
    
    <div class="px-4 py-6">
        <!-- User Info Card -->
        <div class="bg-white/5 rounded-xl p-4 mb-6">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-br from-[#2D6A4F] to-[#1B4D3E] rounded-full flex items-center justify-center text-white font-bold shadow-md">
                    {{ strtoupper(substr(auth()->user()->username ?? 'A', 0, 1)) }}
                </div>
                <div class="flex-1">
                    <p class="text-white text-sm font-semibold">{{ auth()->user()->username ?? 'Admin' }}</p>
                    <p class="text-gray-400 text-xs">{{ ucfirst(auth()->user()->role ?? 'administrator') }}</p>
                </div>
            </div>
        </div>
        
        <!-- Navigation -->
        <nav class="space-y-1">
            <p class="text-gray-500 text-xs uppercase tracking-wider font-semibold px-3 mb-3">Main</p>
            
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-[#2D6A4F] text-white shadow-lg' : 'text-gray-300 hover:bg-white/5' }}">
                <i class="fas fa-chart-pie w-5"></i>
                <span class="text-sm font-medium">Dashboard</span>
            </a>
            
            <a href="#" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-gray-300 hover:bg-white/5 transition-all duration-200">
                <i class="fas fa-building w-5"></i>
                <span class="text-sm font-medium">Properties</span>
                <span class="ml-auto text-xs bg-[#2D6A4F] px-2 py-0.5 rounded-full">12</span>
            </a>
            
            <a href="#" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-gray-300 hover:bg-white/5 transition-all duration-200">
                <i class="fas fa-calendar-alt w-5"></i>
                <span class="text-sm font-medium">Bookings</span>
            </a>
            
            <a href="#" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-gray-300 hover:bg-white/5 transition-all duration-200">
                <i class="fas fa-users w-5"></i>
                <span class="text-sm font-medium">Users</span>
            </a>
            
            <a href="#" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-gray-300 hover:bg-white/5 transition-all duration-200">
                <i class="fas fa-star w-5"></i>
                <span class="text-sm font-medium">Reviews</span>
            </a>
        </nav>
        
        <nav class="mt-6 pt-6 border-t border-white/10 space-y-1">
            <p class="text-gray-500 text-xs uppercase tracking-wider font-semibold px-3 mb-3">Management</p>
            
            <a href="#" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-gray-300 hover:bg-white/5 transition-all duration-200">
                <i class="fas fa-chart-line w-5"></i>
                <span class="text-sm font-medium">Analytics</span>
            </a>
            
            <a href="#" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-gray-300 hover:bg-white/5 transition-all duration-200">
                <i class="fas fa-cog w-5"></i>
                <span class="text-sm font-medium">Settings</span>
            </a>
            
            <a href="#" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-gray-300 hover:bg-white/5 transition-all duration-200">
                <i class="fas fa-shield-alt w-5"></i>
                <span class="text-sm font-medium">Security</span>
            </a>
        </nav>
    </div>
    
    <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-white/10 bg-gradient-to-b from-[#0A1928] to-[#0D2A3A]">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="flex items-center space-x-3 w-full px-3 py-2.5 rounded-lg text-gray-300 hover:bg-red-500/20 hover:text-red-400 transition-all duration-200">
                <i class="fas fa-sign-out-alt w-5"></i>
                <span class="text-sm font-medium">Logout</span>
            </button>
        </form>
    </div>
</aside>

<div onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-10 md:hidden"></div>