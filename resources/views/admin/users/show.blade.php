@extends('admin.layouts.app')

@section('title', $user->username ?? $user->name)
@section('header-title', 'User Profile')
@section('header-description', 'Complete user overview and activity')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    
    <!-- Back Button -->
    <div>
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center space-x-2 text-gray-500 hover:text-[#2D6A4F] transition group">
            <i class="fas fa-arrow-left text-sm group-hover:-translate-x-1 transition"></i>
            <span>Back to Users</span>
        </a>
    </div>
    
    <!-- Hero Section with Cover Image -->
    <div class="relative">
        <!-- Cover Image -->
        <div class="h-48 md:h-64 bg-gradient-to-r from-[#0A1928] to-[#0D2A3A] rounded-2xl overflow-hidden relative">
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8">
                <div class="flex flex-col md:flex-row md:items-end justify-between">
                    <div class="flex flex-col md:flex-row md:items-center space-y-4 md:space-y-0 md:space-x-6">
                        <!-- Avatar -->
                        <div class="relative -mb-12 md:mb-0">
                            <div class="w-24 h-24 md:w-32 md:h-32 bg-gradient-to-br from-[#2D6A4F] to-[#1B4D3E] rounded-2xl flex items-center justify-center text-white text-4xl md:text-5xl font-bold shadow-xl border-4 border-white">
                                {{ strtoupper(substr($user->username ?? $user->name ?? 'U', 0, 2)) }}
                            </div>
                            <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-500 rounded-full border-2 border-white flex items-center justify-center">
                                <i class="fas fa-check text-white text-xs"></i>
                            </div>
                        </div>
                        
                        <!-- User Info -->
                        <div class="text-white">
                            <h1 class="text-2xl md:text-3xl font-bold">{{ $user->username ?? $user->name }}</h1>
                            <div class="flex flex-wrap items-center gap-2 mt-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-white/20">
                                    <i class="fas fa-id-card mr-1 text-xs"></i>
                                    ID: #{{ $user->id }}
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-white/20">
                                    <i class="fas fa-calendar-alt mr-1 text-xs"></i>
                                    Joined {{ $user->created_at->format('M d, Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex space-x-3 mt-4 md:mt-0">
                        <a href="{{ route('admin.users.edit', $user) }}" 
                           class="px-5 py-2.5 bg-white/10 backdrop-blur-sm hover:bg-white/20 text-white rounded-xl transition flex items-center space-x-2 border border-white/20">
                            <i class="fas fa-edit"></i>
                            <span>Edit Profile</span>
                        </a>
                        @if($user->is_active)
                            <button type="button" onclick="toggleStatus({{ $user->id }}, '{{ addslashes($user->username ?? $user->name) }}', true)" 
                                    class="px-5 py-2.5 bg-red-500/20 backdrop-blur-sm hover:bg-red-500/30 text-red-100 rounded-xl transition flex items-center space-x-2 border border-red-500/30">
                                <i class="fas fa-ban"></i>
                                <span>Deactivate</span>
                            </button>
                        @else
                            <button type="button" onclick="toggleStatus({{ $user->id }}, '{{ addslashes($user->username ?? $user->name) }}', false)" 
                                    class="px-5 py-2.5 bg-green-500/20 backdrop-blur-sm hover:bg-green-500/30 text-green-100 rounded-xl transition flex items-center space-x-2 border border-green-500/30">
                                <i class="fas fa-check-circle"></i>
                                <span>Activate</span>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Stats Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Properties</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $properties ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 bg-[#2D6A4F]/10 rounded-lg flex items-center justify-center">
                    <i class="fas fa-building text-[#2D6A4F] text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Bookings</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $user->bookings_count ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-calendar-check text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Spent</p>
                    <p class="text-2xl font-bold text-gray-800">${{ number_format($user->total_spent ?? 0, 2) }}</p>
                </div>
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-dollar-sign text-green-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Reviews Given</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $user->reviews_count ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-star text-yellow-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Left Column - Personal Info -->
        <div class="space-y-6">
            <!-- Contact Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-address-card text-[#2D6A4F] mr-2"></i>
                        Contact Information
                    </h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-envelope text-blue-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Email Address</p>
                            <p class="text-gray-800 font-medium mt-0.5">{{ $user->email }}</p>
                            @if($user->email_verified_at)
                                <span class="inline-flex items-center text-xs text-green-600 mt-1">
                                    <i class="fas fa-check-circle mr-1"></i> Verified
                                </span>
                            @else
                                <span class="inline-flex items-center text-xs text-yellow-600 mt-1">
                                    <i class="fas fa-clock mr-1"></i> Not Verified
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    @if($user->phone)
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-phone text-green-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Phone Number</p>
                            <p class="text-gray-800 font-medium mt-0.5">{{ $user->phone }}</p>
                        </div>
                    </div>
                    @endif
                    
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-flag-checkered text-purple-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Account Status</p>
                            @if($user->is_active)
                                <span class="inline-flex items-center px-2 py-1 text-xs rounded-full bg-green-100 text-green-700 mt-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span>
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 text-xs rounded-full bg-red-100 text-red-700 mt-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mr-1.5"></span>
                                    Inactive
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Role & Permissions Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-shield-alt text-[#2D6A4F] mr-2"></i>
                        Role & Permissions
                    </h3>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                        <div>
                            <p class="text-sm text-gray-500">Current Role</p>
                            @php
                                $roleColors = [
                                    'admin' => 'blue',
                                    'user' => 'green',
                                    'agent' => 'purple',
                                ];
                                $color = $roleColors[$user->role] ?? 'gray';
                            @endphp
                            <p class="text-xl font-bold text-gray-800 mt-1 capitalize">{{ $user->role }}</p>
                        </div>
                        <div class="w-12 h-12 bg-{{ $color }}-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-user-tag text-{{ $color }}-600 text-xl"></i>
                        </div>
                    </div>
                    
                    <div class="mt-4 space-y-2">
                        <div class="flex items-center space-x-2 text-sm">
                            <i class="fas fa-check-circle text-green-500 w-4"></i>
                            <span class="text-gray-600">Can access dashboard</span>
                        </div>
                        @if($user->role == 'admin')
                        <div class="flex items-center space-x-2 text-sm">
                            <i class="fas fa-check-circle text-green-500 w-4"></i>
                            <span class="text-gray-600">Full system access</span>
                        </div>
                        <div class="flex items-center space-x-2 text-sm">
                            <i class="fas fa-check-circle text-green-500 w-4"></i>
                            <span class="text-gray-600">Manage all users</span>
                        </div>
                        <div class="flex items-center space-x-2 text-sm">
                            <i class="fas fa-check-circle text-green-500 w-4"></i>
                            <span class="text-gray-600">Manage all properties</span>
                        </div>
                        @elseif($user->role == 'landlord')
                        <div class="flex items-center space-x-2 text-sm">
                            <i class="fas fa-check-circle text-green-500 w-4"></i>
                            <span class="text-gray-600">Manage own properties</span>
                        </div>
                        <div class="flex items-center space-x-2 text-sm">
                            <i class="fas fa-check-circle text-green-500 w-4"></i>
                            <span class="text-gray-600">View bookings</span>
                        </div>
                        @else
                        <div class="flex items-center space-x-2 text-sm">
                            <i class="fas fa-check-circle text-green-500 w-4"></i>
                            <span class="text-gray-600">Book properties</span>
                        </div>
                        <div class="flex items-center space-x-2 text-sm">
                            <i class="fas fa-check-circle text-green-500 w-4"></i>
                            <span class="text-gray-600">Write reviews</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Column - Activity & Listings -->
        <div class="lg:col-span-2 space-y-6">
            
         
            <!-- User Properties -->
            
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-building text-[#2D6A4F] mr-2"></i>
                            Listed Properties
                        </h3>
                        <p class="text-sm text-gray-500 mt-1">Properties owned by this user</p>
                    </div>
                    @if($userProperties->count() >= 3)
                    <a href="" class="text-sm text-[#2D6A4F] hover:underline">View all</a>
                    @endif
                </div>
                <div class="divide-y divide-gray-100">
                    @forelse($userProperties as $property)
                    <div class="px-6 py-4 hover:bg-gray-50 transition">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                    @if($property->featured_image)
                                        <img src="{{ asset('storage/' . $property->featured_image) }}" alt="" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-[#2D6A4F]/10">
                                            <i class="fas fa-home text-[#2D6A4F]"></i>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">{{ \Str::limit($property->title, 40) }}</p>
                                    <p class="text-sm text-gray-500">{{ $property->city }}, {{ $property->country }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-[#2D6A4F]">${{ number_format($property->rent_fee, 2) }}</p>
                                <p class="text-xs text-gray-500">/ rent</p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="px-6 py-12 text-center">
                        <i class="fas fa-home text-4xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500">No properties listed yet</p>
                    </div>
                    @endforelse
                </div>
                <!-- Pagination -->
        @if($userProperties->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            {{  $userProperties->appends(request()->query())->links() }}
        </div>
        @endif
            </div>
            
            
            <!-- Recent Reviews -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-star text-[#2D6A4F] mr-2"></i>
                        Recent Reviews
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">Reviews written by this user</p>
                </div>
                <div class="divide-y divide-gray-100">
                    @forelse(($user->recentReviews ?? []) as $review)
                    <div class="px-6 py-4 hover:bg-gray-50 transition">
                        <div class="flex justify-between items-start mb-2">
                            <div class="flex items-center space-x-2">
                                <div class="flex text-yellow-400 text-sm">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="{{ $i <= $review->rating ? 'fas' : 'far' }} fa-star"></i>
                                    @endfor
                                </div>
                                <span class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <p class="text-gray-700 text-sm">{{ \Str::limit($review->comment, 150) }}</p>
                        <p class="text-xs text-gray-400 mt-2">on {{ $review->property->title ?? 'Property' }}</p>
                    </div>
                    @empty
                    <div class="px-6 py-12 text-center">
                        <i class="fas fa-star text-4xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500">No reviews yet</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Status Toggle Form -->
<form id="toggle-status-form-{{ $user->id }}" 
      action="{{ route('admin.users.toggle-status', $user) }}" 
      method="POST" style="display: none;">
    @csrf
    @method('PATCH')
</form>

<!-- Toggle Status Modal -->
<div id="toggleStatusModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full mx-4 transform transition-all animate-modal-pop">
        <div class="p-6">
            <div class="flex items-center justify-center w-14 h-14 mx-auto rounded-full mb-4 transition-all" id="modalIconContainer">
                <i id="modalIcon" class="text-2xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 text-center mb-2" id="modalTitle">Confirm Action</h3>
            <p class="text-gray-500 text-center text-sm leading-relaxed" id="modalMessage"></p>
            <div class="flex space-x-3 mt-8">
                <button onclick="closeStatusModal()" class="flex-1 px-4 py-2.5 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition font-medium">
                    Cancel
                </button>
                <button id="confirmStatusBtn" class="flex-1 px-4 py-2.5 rounded-xl text-white font-medium transition">
                    Confirm
                </button>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    @keyframes modal-pop {
        0% {
            opacity: 0;
            transform: scale(0.95);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }
    .animate-modal-pop {
        animation: modal-pop 0.2s ease-out;
    }
</style>
@endpush

@push('scripts')
<script>
    let statusToggleId = null;
    
    function toggleStatus(id, name, isActive) {
        statusToggleId = id;
        
        if (isActive) {
            document.getElementById('modalIconContainer').className = 'flex items-center justify-center w-14 h-14 mx-auto bg-red-100 rounded-full mb-4';
            document.getElementById('modalIcon').className = 'fas fa-ban text-red-600 text-2xl';
            document.getElementById('modalTitle').innerText = 'Deactivate User';
            document.getElementById('modalMessage').innerHTML = `Are you sure you want to deactivate <strong class="text-gray-900">"${name}"</strong>?<br>This user will not be able to access their account.`;
            document.getElementById('confirmStatusBtn').className = 'flex-1 px-4 py-2.5 bg-red-600 text-white rounded-xl hover:bg-red-700 transition font-medium';
        } else {
            document.getElementById('modalIconContainer').className = 'flex items-center justify-center w-14 h-14 mx-auto bg-green-100 rounded-full mb-4';
            document.getElementById('modalIcon').className = 'fas fa-check-circle text-green-600 text-2xl';
            document.getElementById('modalTitle').innerText = 'Activate User';
            document.getElementById('modalMessage').innerHTML = `Are you sure you want to activate <strong class="text-gray-900">"${name}"</strong>?<br>This user will be able to access their account again.`;
            document.getElementById('confirmStatusBtn').className = 'flex-1 px-4 py-2.5 bg-green-600 text-white rounded-xl hover:bg-green-700 transition font-medium';
        }
        
        document.getElementById('toggleStatusModal').classList.remove('hidden');
        document.getElementById('toggleStatusModal').classList.add('flex');
    }
    
    function closeStatusModal() {
        document.getElementById('toggleStatusModal').classList.add('hidden');
        document.getElementById('toggleStatusModal').classList.remove('flex');
        statusToggleId = null;
    }
    
    document.getElementById('confirmStatusBtn').addEventListener('click', function() {
        if (statusToggleId) {
            document.getElementById(`toggle-status-form-${statusToggleId}`).submit();
        }
    });
    
    document.getElementById('toggleStatusModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeStatusModal();
        }
    });
</script>
@endpush
@endsection