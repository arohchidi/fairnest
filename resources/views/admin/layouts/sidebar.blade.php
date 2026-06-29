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
            
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-[#2D6A4F] text-white shadow-lg' : 'text-gray-300 hover:bg-white/5' }}">
                <i class="fas fa-chart-pie w-5"></i>
                <span class="text-sm font-medium">Dashboard</span>
            </a>
            
            <!-- Properties Menu with Submenu -->
            <div x-data="{ open: {{ request()->routeIs('admin.properties.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.properties.*') ? 'bg-[#2D6A4F]/20 text-white' : 'text-gray-300 hover:bg-white/5' }}">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-building w-5"></i>
                        <span class="text-sm font-medium">Properties</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{'rotate-180': open}"></i>
                </button>
                <div x-show="open" x-collapse class="ml-4 mt-1 space-y-1">
                    <a href="{{ route('admin.properties.index') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm transition-all duration-200 {{ request()->routeIs('admin.properties.index') ? 'bg-[#2D6A4F] text-white' : 'text-gray-400 hover:bg-white/5 hover:text-gray-200' }}">
                        <i class="fas fa-list w-4"></i>
                        <span>All Properties</span>
                    </a>
                    <a href="{{ route('admin.properties.create') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm transition-all duration-200 {{ request()->routeIs('admin.properties.create') ? 'bg-[#2D6A4F] text-white' : 'text-gray-400 hover:bg-white/5 hover:text-gray-200' }}">
                        <i class="fas fa-plus w-4"></i>
                        <span>Add New Property</span>
                    </a>
                </div>
            </div>
            
            <!-- Bookings Menu with Submenu -->
            <div x-data="{ open: {{ request()->routeIs('admin.bookings.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.bookings.*') ? 'bg-[#2D6A4F]/20 text-white' : 'text-gray-300 hover:bg-white/5' }}">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-calendar-alt w-5"></i>
                        <span class="text-sm font-medium">Bookings</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{'rotate-180': open}"></i>
                </button>
                <div x-show="open" x-collapse class="ml-4 mt-1 space-y-1">
                    <a href="{{ route('admin.bookings.index') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm transition-all duration-200 {{ request()->routeIs('admin.bookings.index') ? 'bg-[#2D6A4F] text-white' : 'text-gray-400 hover:bg-white/5 hover:text-gray-200' }}">
                        <i class="fas fa-list w-4"></i>
                        <span>All Bookings</span>
                    </a>
                   
                </div>
            </div>
            
            <!-- Users Menu with Submenu -->
            <div x-data="{ open: {{ request()->routeIs('admin.users.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-[#2D6A4F]/20 text-white' : 'text-gray-300 hover:bg-white/5' }}">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-users w-5"></i>
                        <span class="text-sm font-medium">Users</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{'rotate-180': open}"></i>
                </button>
                <div x-show="open" x-collapse class="ml-4 mt-1 space-y-1">
                    <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm transition-all duration-200 {{ request()->routeIs('admin.users.index') ? 'bg-[#2D6A4F] text-white' : 'text-gray-400 hover:bg-white/5 hover:text-gray-200' }}">
                        <i class="fas fa-list w-4"></i>
                        <span>All Users</span>
                    </a>
                    <a href="{{ route('admin.users.create') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm transition-all duration-200 {{ request()->routeIs('admin.users.create') ? 'bg-[#2D6A4F] text-white' : 'text-gray-400 hover:bg-white/5 hover:text-gray-200' }}">
                        <i class="fas fa-user-plus w-4"></i>
                        <span>Create User</span>
                    </a>
                    
                </div>
            </div>
            
            <!-- Reviews Menu with Submenu -->
            <div x-data="{ open: {{ request()->routeIs('admin.reviews.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.reviews.*') ? 'bg-[#2D6A4F]/20 text-white' : 'text-gray-300 hover:bg-white/5' }}">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-star w-5"></i>
                        <span class="text-sm font-medium">Reviews</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{'rotate-180': open}"></i>
                </button>
                <div x-show="open" x-collapse class="ml-4 mt-1 space-y-1">
                    <a href="{{ url('admin.reviews.index') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm transition-all duration-200 {{ request()->routeIs('admin.reviews.index') ? 'bg-[#2D6A4F] text-white' : 'text-gray-400 hover:bg-white/5 hover:text-gray-200' }}">
                        <i class="fas fa-list w-4"></i>
                        <span>All Reviews</span>
                    </a>
                   
                </div>
            </div>
       
       

              <!-- Reports Menu with Submenu -->
            <div x-data="{ open: {{ request()->routeIs('admin.reports.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.reviews.*') ? 'bg-[#2D6A4F]/20 text-white' : 'text-gray-300 hover:bg-white/5' }}">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-flag w-5"></i>
                        <span class="text-sm font-medium">Reports</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{'rotate-180': open}"></i>
                </button>
                <div x-show="open" x-collapse class="ml-4 mt-1 space-y-1">
                    <a href="{{ route('admin.reports.index') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm transition-all duration-200 {{ request()->routeIs('admin.reviews.index') ? 'bg-[#2D6A4F] text-white' : 'text-gray-400 hover:bg-white/5 hover:text-gray-200' }}">
                        <i class="fas fa-list w-4"></i>
                        <span>All Reports</span>
                    </a>
                   
                </div>
            </div>



              <!-- Reports Menu with Submenu -->
            <div x-data="{ open: {{ request()->routeIs('admin.matching.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.reviews.*') ? 'bg-[#2D6A4F]/20 text-white' : 'text-gray-300 hover:bg-white/5' }}">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-users w-5"></i>
                        <span class="text-sm font-medium">Matching</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{'rotate-180': open}"></i>
                </button>
                <div x-show="open" x-collapse class="ml-4 mt-1 space-y-1">
                    <a href="{{ route('admin.matching.index') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm transition-all duration-200 {{ request()->routeIs('admin.reviews.index') ? 'bg-[#2D6A4F] text-white' : 'text-gray-400 hover:bg-white/5 hover:text-gray-200' }}">
                        <i class="fas fa-users w-4"></i>
                        <span>Roommates Matching</span>
                    </a>
                   
                </div>
            </div>
       
        </nav>
        
        <nav class="mt-6 pt-6 border-t border-white/10 space-y-1">
            <p class="text-gray-500 text-xs uppercase tracking-wider font-semibold px-3 mb-3">Settings</p>
            
            <!-- Analytics Menu with Submenu -->
            <div x-data="{ open: {{ request()->routeIs('admin.faq*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition-all duration-200 text-gray-300 hover:bg-white/5">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-comment w-5"></i>
                        <span class="text-sm font-medium">FAQs</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{'rotate-180': open}"></i>
                </button>
                <div x-show="open" x-collapse class="ml-4 mt-1 space-y-1">
                    <a href="{{ route('admin.faq.index') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm transition-all duration-200 text-gray-400 hover:bg-white/5 hover:text-gray-200">
                         <i class="fas fa-list w-4"></i>
                        <span>All FAQs</span>
                    </a>
                    <a href="{{ route('admin.faq.create') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm transition-all duration-200 text-gray-400 hover:bg-white/5 hover:text-gray-200">
                         <i class="fas fa-pencil w-4"></i>
                        <span>Add Faq</span>
                    </a>
                    
                </div>
            </div>







              <!-- Analytics Menu with Submenu -->
            <div x-data="{ open: {{ request()->routeIs('admin.pages*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition-all duration-200 text-gray-300 hover:bg-white/5">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-book w-5"></i>
                        <span class="text-sm font-medium">Manage Pages</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{'rotate-180': open}"></i>
                </button>
                <div x-show="open" x-collapse class="ml-4 mt-1 space-y-1">
                    <a href="{{ route('admin.pages.terms') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm transition-all duration-200 text-gray-400 hover:bg-white/5 hover:text-gray-200">
                         <i class="fas fa-list w-4"></i>
                        <span>Terms & Condition</span>
                    </a>
                    <a href="{{ route('admin.pages.privacy-policy') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm transition-all duration-200 text-gray-400 hover:bg-white/5 hover:text-gray-200">
                          <i class="fas fa-list w-4"></i>
                        <span>Privacy Policy</span>
                    </a>
                    
                </div>
            </div>
            
            <!-- Settings Menu with Submenu -->
            <div x-data="{ open: {{ request()->routeIs('admin.settings.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition-all duration-200 text-gray-300 hover:bg-white/5">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-cog w-5"></i>
                        <span class="text-sm font-medium">Settings</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{'rotate-180': open}"></i>
                </button>
                <div x-show="open" x-collapse class="ml-4 mt-1 space-y-1">
                    <a href="{{ url('admin.settings.index') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm transition-all duration-200 text-gray-400 hover:bg-white/5 hover:text-gray-200">
                        <i class="fas fa-globe w-4"></i>
                        <span>General</span>
                    </a>
                    
                    <a href="{{ url('admin.settings.index') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm transition-all duration-200 text-gray-400 hover:bg-white/5 hover:text-gray-200">
                        <i class="fas fa-envelope w-4"></i>
                        <span>Email Templates</span>
                    </a>
                </div>
            </div>
        
         <!-- Settings Menu with Submenu -->
            <div x-data="{ open: {{ request()->routeIs('admin.email.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition-all duration-200 text-gray-300 hover:bg-white/5">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-envelope w-5"></i>
                        <span class="text-sm font-medium">Email</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{'rotate-180': open}"></i>
                </button>
                <div x-show="open" x-collapse class="ml-4 mt-1 space-y-1">
                    <a href="{{ url('admin.email.index') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm transition-all duration-200 text-gray-400 hover:bg-white/5 hover:text-gray-200">
                        <i class="fas fa-envelope w-4"></i>
                        <span>GEmail</span>
                    </a>
                    
                  
                </div>
            </div>
        
        
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

<!-- Mobile Overlay -->
<div onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-10 md:hidden"></div>