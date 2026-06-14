@extends('admin.layouts.app')

@section('title', 'Create New User')
@section('header-title', 'Create New User')
@section('header-description', 'Add a new user to the platform')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-[#0A1928] to-[#0D2A3A] rounded-2xl p-6 text-white">
        <div class="flex items-start justify-between">
            <div>
                <h2 class="text-2xl font-bold mb-2">Add New User</h2>
                <p class="text-gray-300">Create a new account for tenants, landlords, or administrators.</p>
            </div>
            <div class="hidden md:block">
                <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-user-plus text-3xl text-[#2D6A4F]"></i>
                </div>
            </div>
        </div>
    </div>
    
    <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
        @csrf
        
        <!-- Quick Tips Card -->
        <div class="bg-blue-50 rounded-xl p-4 border border-blue-200">
            <div class="flex items-start space-x-3">
                <i class="fas fa-lightbulb text-blue-500 text-lg mt-0.5"></i>
                <div>
                    <p class="text-sm font-medium text-blue-800">Quick Tips</p>
                    <p class="text-xs text-blue-700 mt-1">Fill in the required fields marked with <span class="text-red-500">*</span>. The user will receive a welcome email with login instructions after creation.</p>
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Left Column - Avatar & Account Type -->
            <div class="lg:col-span-1 space-y-6">
                
                <!-- Avatar Preview Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden sticky top-6">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-image text-[#2D6A4F] mr-2"></i>
                            Avatar Preview
                        </h3>
                    </div>
                    <div class="p-6 text-center">
                        <div id="avatarPreview" class="w-32 h-32 mx-auto bg-gradient-to-br from-[#2D6A4F] to-[#1B4D3E] rounded-2xl flex items-center justify-center text-white text-5xl font-bold shadow-lg mb-4">
                            U
                        </div>
                        <p class="text-sm text-gray-600">Avatar is auto-generated from username</p>
                        <p class="text-xs text-gray-400 mt-2">Changes as you type the username</p>
                    </div>
                </div>
                
                <!-- Account Type Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-user-tag text-[#2D6A4F] mr-2"></i>
                            Account Type
                        </h3>
                    </div>
                    <div class="p-6 space-y-3">
                        <div class="bg-gray-50 rounded-xl p-3 text-center">
                            <p class="text-2xl font-bold text-[#2D6A4F]">User</p>
                            <p class="text-xs text-gray-500 mt-1">Can book properties, write reviews</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-3 text-center">
                            <p class="text-2xl font-bold text-blue-600">Agent</p>
                            <p class="text-xs text-gray-500 mt-1">Can list properties, manage bookings</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-3 text-center">
                            <p class="text-2xl font-bold text-purple-600">Admin</p>
                            <p class="text-xs text-gray-500 mt-1">Full system access</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Column - Form Fields -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Basic Information Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-[#2D6A4F]/10 rounded-xl flex items-center justify-center mr-3">
                                <i class="fas fa-user text-[#2D6A4F] text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Basic Information</h3>
                                <p class="text-sm text-gray-500 mt-0.5">Personal details for the new user</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-6 space-y-5">
                        <!-- Username -->
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                                Username <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-at text-gray-400 text-sm"></i>
                                </div>
                                <input type="text" name="username" id="username" value="{{ old('username') }}" required
                                       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition"
                                       placeholder="johndoe"
                                       onkeyup="updateAvatar(this.value)">
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Used for login and profile URL. Must be unique.</p>
                            @error('username')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email Address <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-envelope text-gray-400 text-sm"></i>
                                    </div>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                           class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition"
                                           placeholder="john@example.com">
                                </div>
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Phone -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                    Phone Number
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-phone text-gray-400 text-sm"></i>
                                    </div>
                                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                                           class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition"
                                           placeholder="+1 234 567 8900">
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Optional, but recommended for notifications</p>
                                @error('phone')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Role Selection Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center mr-3">
                                <i class="fas fa-shield-alt text-purple-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Select Role</h3>
                                <p class="text-sm text-gray-500 mt-0.5">Choose the user's permissions level</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Tenant Role -->
                            <label class="relative cursor-pointer">
                                <input type="radio" name="role" value="tenant" {{ old('role', 'user') == 'user' ? 'checked' : '' }} class="hidden peer" onchange="updateRoleDescription('user')">
                                <div class="p-4 border-2 rounded-xl transition-all peer-checked:border-[#2D6A4F] peer-checked:bg-[#2D6A4F]/5 hover:border-gray-300 border-gray-200">
                                    <div class="text-center">
                                        <div class="w-14 h-14 mx-auto bg-green-100 rounded-xl flex items-center justify-center mb-3">
                                            <i class="fas fa-user text-green-600 text-2xl"></i>
                                        </div>
                                        <p class="font-bold text-gray-800">User</p>
                                        <p class="text-xs text-gray-500 mt-1">Book properties</p>
                                    </div>
                                    <div class="mt-3 space-y-1">
                                         <div class="flex items-center text-xs text-gray-600">
                                        <i class="fas fa-check-circle text-green-500 w-3 mr-1"></i>
                                        Search and book listings
                                    </div>
                                    <div class="flex items-center text-xs text-gray-600">
                                        <i class="fas fa-check-circle text-green-500 w-3 mr-1"></i>
                                        Write property reviews
                                    </div>
                                    </div>
                                </div>
                                <div class="absolute top-3 right-3 text-[#2D6A4F] opacity-0 peer-checked:opacity-100 transition">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                            </label>
                            
                            <!-- Landlord Role -->
                            <label class="relative cursor-pointer">
                                <input type="radio" name="role" value="landlord" {{ old('role') == 'agent' ? 'checked' : '' }} class="hidden peer" onchange="updateRoleDescription('agent')">
                                <div class="p-4 border-2 rounded-xl transition-all peer-checked:border-[#2D6A4F] peer-checked:bg-[#2D6A4F]/5 hover:border-gray-300 border-gray-200">
                                    <div class="text-center">
                                        <div class="w-14 h-14 mx-auto bg-blue-100 rounded-xl flex items-center justify-center mb-3">
                                            <i class="fas fa-building text-blue-600 text-2xl"></i>
                                        </div>
                                        <p class="font-bold text-gray-800">Agent</p>
                                        <p class="text-xs text-gray-500 mt-1">List properties</p>
                                    </div>
                                    <div class="mt-3 space-y-1">
                                        <div class="flex items-center text-xs text-gray-600">
                                            <i class="fas fa-check-circle text-green-500 w-3 mr-1"></i>
                                            List properties
                                        </div>
                                        <div class="flex items-center text-xs text-gray-600">
                                            <i class="fas fa-check-circle text-green-500 w-3 mr-1"></i>
                                            Manage bookings
                                        </div>
                                    </div>
                                </div>
                                <div class="absolute top-3 right-3 text-[#2D6A4F] opacity-0 peer-checked:opacity-100 transition">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                            </label>
                            
                            <!-- Admin Role -->
                            <label class="relative cursor-pointer">
                                <input type="radio" name="role" value="admin" {{ old('role') == 'admin' ? 'checked' : '' }} class="hidden peer" onchange="updateRoleDescription('admin')">
                                <div class="p-4 border-2 rounded-xl transition-all peer-checked:border-[#2D6A4F] peer-checked:bg-[#2D6A4F]/5 hover:border-gray-300 border-gray-200">
                                    <div class="text-center">
                                        <div class="w-14 h-14 mx-auto bg-purple-100 rounded-xl flex items-center justify-center mb-3">
                                            <i class="fas fa-crown text-purple-600 text-2xl"></i>
                                        </div>
                                        <p class="font-bold text-gray-800">Admin</p>
                                        <p class="text-xs text-gray-500 mt-1">Full access</p>
                                    </div>
                                    <div class="mt-3 space-y-1">
                                        <div class="flex items-center text-xs text-gray-600">
                                            <i class="fas fa-check-circle text-green-500 w-3 mr-1"></i>
                                            Full system access
                                        </div>
                                        <div class="flex items-center text-xs text-gray-600">
                                            <i class="fas fa-check-circle text-green-500 w-3 mr-1"></i>
                                            Manage all users
                                        </div>
                                    </div>
                                </div>
                                <div class="absolute top-3 right-3 text-[#2D6A4F] opacity-0 peer-checked:opacity-100 transition">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                            </label>
                        </div>
                        @error('role')
                            <p class="text-red-500 text-xs mt-3">{{ $message }}</p>
                        @enderror
                        
                        <!-- Role Description -->
                        <div id="roleDescription" class="mt-4 p-3 bg-gray-50 rounded-lg text-sm text-gray-600">
                            <i class="fas fa-info-circle text-[#2D6A4F] mr-2"></i>
                            <span id="roleDescriptionText">Tenants can browse properties, make bookings, and submit reviews.</span>
                        </div>
                    </div>
                </div>
                
                <!-- Password Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center mr-3">
                                <i class="fas fa-key text-yellow-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Set Password</h3>
                                <p class="text-sm text-gray-500 mt-0.5">Create a secure password for the user</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-6 space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                    Password <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-lock text-gray-400 text-sm"></i>
                                    </div>
                                    <input type="password" name="password" id="password" required
                                           class="w-full pl-10 pr-12 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition"
                                           placeholder="Create a strong password">
                                    <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                    Confirm Password <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-lock text-gray-400 text-sm"></i>
                                    </div>
                                    <input type="password" name="password_confirmation" id="password_confirmation" required
                                           class="w-full pl-10 pr-12 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition"
                                           placeholder="Confirm the password">
                                    <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Password Strength Indicator -->
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <p class="text-xs text-gray-500">Password Strength</p>
                                <p id="strengthText" class="text-xs font-medium text-gray-500">Not entered</p>
                            </div>
                            <div class="h-1.5 bg-gray-200 rounded-full overflow-hidden">
                                <div id="strengthBar" class="h-full w-0 bg-red-500 transition-all duration-300"></div>
                            </div>
                            <div class="flex flex-wrap gap-x-4 gap-y-1 text-xs text-gray-500">
                                <span><i class="fas fa-circle text-[8px] text-green-500 mr-1"></i> 8+ characters</span>
                                <span><i class="fas fa-circle text-[8px] text-green-500 mr-1"></i> Uppercase & lowercase</span>
                                <span><i class="fas fa-circle text-[8px] text-green-500 mr-1"></i> Numbers & symbols</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Account Status Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center mr-3">
                                <i class="fas fa-toggle-on text-green-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Account Status</h3>
                                <p class="text-sm text-gray-500 mt-0.5">Set the initial account state</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <div class="flex items-center space-x-6">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="is_active" value="1" checked class="w-4 h-4 text-[#2D6A4F] focus:ring-[#2D6A4F]">
                                <span class="ml-2 text-sm text-gray-700">
                                    <i class="fas fa-check-circle text-green-500 mr-1"></i> Active
                                </span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="is_active" value="0" class="w-4 h-4 text-red-500 focus:ring-red-500">
                                <span class="ml-2 text-sm text-gray-700">
                                    <i class="fas fa-ban text-red-500 mr-1"></i> Inactive
                                </span>
                            </label>
                        </div>
                        <p class="text-xs text-gray-500 mt-3">
                            <i class="fas fa-info-circle mr-1"></i>
                            Active users can log in immediately. Inactive users will need to be activated later.
                        </p>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="flex justify-end space-x-3 pb-6">
                    <a href="{{ route('admin.users.index') }}" 
                       class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition font-medium">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 bg-gradient-to-r from-[#0A1928] to-[#0D2A3A] hover:from-[#0D2A3A] hover:to-[#0A1928] text-white rounded-xl font-medium transition shadow-md flex items-center space-x-2">
                        <i class="fas fa-user-plus"></i>
                        <span>Create User</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Update avatar preview
    function updateAvatar(username) {
        const preview = document.getElementById('avatarPreview');
        if (username && username.length > 0) {
            preview.textContent = username.substring(0, 2).toUpperCase();
        } else {
            preview.textContent = 'U';
        }
    }
    
    // Toggle password visibility
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const type = field.type === 'password' ? 'text' : 'password';
        field.type = type;
    }
    
    // Update role description
    function updateRoleDescription(role) {
        const descriptions = {
            tenant: 'Tenants can browse properties, make bookings, submit reviews, and manage their profile.',
            landlord: 'Landlords can list properties, manage bookings, track earnings, and respond to reviews.',
            admin: 'Admins have full system access, can manage users, properties, bookings, and platform settings.'
        };
        document.getElementById('roleDescriptionText').textContent = descriptions[role] || descriptions.tenant;
    }
    
    // Password strength checker
    const passwordInput = document.getElementById('password');
    const strengthBar = document.getElementById('strengthBar');
    const strengthText = document.getElementById('strengthText');
    
    passwordInput.addEventListener('input', function() {
        const password = this.value;
        let strength = 0;
        
        if (password.length >= 8) strength++;
        if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
        if (password.match(/[0-9]/) && password.match(/[^a-zA-Z0-9]/)) strength++;
        
        const width = (strength / 3) * 100;
        strengthBar.style.width = width + '%';
        
        if (strength === 0) {
            strengthBar.className = 'h-full w-0 bg-gray-300 transition-all duration-300';
            strengthText.textContent = 'Not entered';
            strengthText.className = 'text-xs font-medium text-gray-500';
        } else if (strength === 1) {
            strengthBar.className = 'h-full bg-red-500 transition-all duration-300';
            strengthText.textContent = 'Weak';
            strengthText.className = 'text-xs font-medium text-red-500';
        } else if (strength === 2) {
            strengthBar.className = 'h-full bg-yellow-500 transition-all duration-300';
            strengthText.textContent = 'Medium';
            strengthText.className = 'text-xs font-medium text-yellow-600';
        } else {
            strengthBar.className = 'h-full bg-green-500 transition-all duration-300';
            strengthText.textContent = 'Strong';
            strengthText.className = 'text-xs font-medium text-green-600';
        }
    });
    
    // Initialize avatar from old value if exists
    const oldUsername = "{{ old('username') }}";
    if (oldUsername) {
        updateAvatar(oldUsername);
    }
    
    // Initialize role description from old value
    const oldRole = "{{ old('role', 'tenant') }}";
    updateRoleDescription(oldRole);
</script>
@endpush
@endsection