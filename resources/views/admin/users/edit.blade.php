@extends('admin.layouts.app')

@section('title', 'Edit ' . ($user->username ?? $user->name))
@section('header-title', 'Edit User')
@section('header-description', 'Update user information and account settings')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    
    <!-- Progress Steps -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-2 md:space-x-4">
                <div class="flex items-center">
                    <div class="w-8 h-8 rounded-full bg-[#2D6A4F] text-white flex items-center justify-center text-sm font-bold">1</div>
                    <div class="ml-2">
                        <p class="text-xs text-gray-500">Step 1</p>
                        <p class="text-sm font-medium text-gray-800 hidden md:block">Basic Info</p>
                    </div>
                </div>
                <div class="w-8 h-0.5 bg-gray-200"></div>
                <div class="flex items-center">
                    <div class="w-8 h-8 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center text-sm font-bold">2</div>
                    <div class="ml-2">
                        <p class="text-xs text-gray-500">Step 2</p>
                        <p class="text-sm font-medium text-gray-800 hidden md:block">Role & Status</p>
                    </div>
                </div>
                <div class="w-8 h-0.5 bg-gray-200"></div>
                <div class="flex items-center">
                    <div class="w-8 h-8 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center text-sm font-bold">3</div>
                    <div class="ml-2">
                        <p class="text-xs text-gray-500">Step 3</p>
                        <p class="text-sm font-medium text-gray-800 hidden md:block">Security</p>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <p class="text-xs text-gray-400">User ID: #{{ $user->id }}</p>
            </div>
        </div>
    </div>
    
    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
        @csrf
        @method('PATCH')
        
        <!-- Step 1: Basic Information -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-[#0A1928] to-[#0D2A3A]">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-white">Basic Information</h3>
                        <p class="text-gray-300 text-sm mt-0.5">Personal details and contact information</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-20 h-20 -mr-2 opacity-20">
                            <svg viewBox="0 0 24 24" fill="white">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="p-6 space-y-5">
                <!-- Avatar Preview -->
                <div class="flex items-center space-x-4 pb-4 border-b border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#2D6A4F] to-[#1B4D3E] rounded-xl flex items-center justify-center text-white text-2xl font-bold shadow-md">
                        {{ strtoupper(substr($user->username ?? $user->name ?? 'U', 0, 2)) }}
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">{{ $user->username ?? $user->name }}</p>
                        <p class="text-sm text-gray-500">Avatar is auto-generated from username</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Username -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user text-[#2D6A4F] mr-1"></i>
                            Username <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="username" id="username" value="{{ old('username', $user->username ?? $user->name) }}" required
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition"
                               placeholder="johndoe">
                        <p class="text-xs text-gray-500 mt-1">Used for login and profile URL</p>
                        @error('username')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-envelope text-[#2D6A4F] mr-1"></i>
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition"
                               placeholder="john@example.com">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Phone -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-phone text-[#2D6A4F] mr-1"></i>
                        Phone Number
                    </label>
                    <div class="flex">
                        <div class="relative flex-1">
                            <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition"
                                   placeholder="+1 234 567 8900">
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Optional, but recommended for notifications</p>
                    @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        
        <!-- Step 2: Role & Status -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-[#0A1928] to-[#0D2A3A]">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-white">Role & Status</h3>
                        <p class="text-gray-300 text-sm mt-0.5">User permissions and account access level</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-20 h-20 -mr-2 opacity-20">
                            <svg viewBox="0 0 24 24" fill="white">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="p-6 space-y-6">
                <!-- Role Selection - Visual Cards -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">
                        <i class="fas fa-tag text-[#2D6A4F] mr-1"></i>
                        Select User Role
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- User Role -->
                        <label class="relative cursor-pointer">
                            <input type="radio" name="role" value="user" {{ old('role', $user->role) == 'user' ? 'checked' : '' }} class="hidden peer">
                            <div class="p-4 border-2 rounded-xl transition-all peer-checked:border-[#2D6A4F] peer-checked:bg-[#2D6A4F]/5 hover:border-gray-300 border-gray-200">
                                <div class="flex items-center space-x-3 mb-3">
                                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-user text-green-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">Normal User</p>
                                        <p class="text-xs text-gray-500">Book properties</p>
                                    </div>
                                </div>
                                <div class="space-y-1">
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
                            <input type="radio" name="role" value="agent" {{ old('role', $user->role) == 'agent' ? 'checked' : '' }} class="hidden peer">
                            <div class="p-4 border-2 rounded-xl transition-all peer-checked:border-[#2D6A4F] peer-checked:bg-[#2D6A4F]/5 hover:border-gray-300 border-gray-200">
                                <div class="flex items-center space-x-3 mb-3">
                                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-building text-blue-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">Agent</p>
                                        <p class="text-xs text-gray-500">List properties</p>
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <div class="flex items-center text-xs text-gray-600">
                                        <i class="fas fa-check-circle text-green-500 w-3 mr-1"></i>
                                        List and manage properties
                                    </div>
                                    <div class="flex items-center text-xs text-gray-600">
                                        <i class="fas fa-check-circle text-green-500 w-3 mr-1"></i>
                                        View booking requests
                                    </div>
                                    <div class="flex items-center text-xs text-gray-600">
                                        <i class="fas fa-check-circle text-green-500 w-3 mr-1"></i>
                                        Track earnings
                                    </div>
                                </div>
                            </div>
                            <div class="absolute top-3 right-3 text-[#2D6A4F] opacity-0 peer-checked:opacity-100 transition">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </label>
                        
                        <!-- Admin Role -->
                        <label class="relative cursor-pointer">
                            <input type="radio" name="role" value="admin" {{ old('role', $user->role) == 'admin' ? 'checked' : '' }} class="hidden peer">
                            <div class="p-4 border-2 rounded-xl transition-all peer-checked:border-[#2D6A4F] peer-checked:bg-[#2D6A4F]/5 hover:border-gray-300 border-gray-200">
                                <div class="flex items-center space-x-3 mb-3">
                                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-crown text-purple-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">Admin</p>
                                        <p class="text-xs text-gray-500">Full access</p>
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <div class="flex items-center text-xs text-gray-600">
                                        <i class="fas fa-check-circle text-green-500 w-3 mr-1"></i>
                                        Full system access
                                    </div>
                                    <div class="flex items-center text-xs text-gray-600">
                                        <i class="fas fa-check-circle text-green-500 w-3 mr-1"></i>
                                        Manage all users
                                    </div>
                                    <div class="flex items-center text-xs text-gray-600">
                                        <i class="fas fa-check-circle text-green-500 w-3 mr-1"></i>
                                        Platform settings
                                    </div>
                                </div>
                            </div>
                            <div class="absolute top-3 right-3 text-[#2D6A4F] opacity-0 peer-checked:opacity-100 transition">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </label>
                    </div>
                    @error('role')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Account Status Toggle -->
                <div class="bg-gray-50 rounded-xl p-4">
                    <div class="flex items-center justify-between flex-wrap gap-4">
                        <div>
                            <p class="font-medium text-gray-800">Account Status</p>
                            <p class="text-sm text-gray-500 mt-0.5">Control user's access to the platform</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="radio" name="is_active" value="1" {{ old('is_active', $user->is_active) ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:bg-green-500 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:border-white"></div>
                                <span class="ml-3 text-sm font-medium text-gray-700">Active</span>
                            </label>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="radio" name="is_active" value="0" {{ old('is_active', $user->is_active) ? '' : 'checked' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:bg-red-500 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                                <span class="ml-3 text-sm font-medium text-gray-700">Inactive</span>
                            </label>
                        </div>
                    </div>
                    @error('is_active')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        
        <!-- Step 3: Security -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-[#0A1928] to-[#0D2A3A]">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-white">Security</h3>
                        <p class="text-gray-300 text-sm mt-0.5">Update password and security settings</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-20 h-20 -mr-2 opacity-20">
                            <svg viewBox="0 0 24 24" fill="white">
                                <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="p-6 space-y-5">
                <!-- Password Change Section -->
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <label class="text-sm font-medium text-gray-700">
                            <i class="fas fa-key text-[#2D6A4F] mr-1"></i>
                            Change Password
                        </label>
                        <button type="button" id="showPasswordFields" class="text-sm text-[#2D6A4F] hover:underline">
                            <i class="fas fa-plus mr-1"></i> Change password
                        </button>
                    </div>
                    
                    <div id="passwordFields" style="display: none;" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm text-gray-600 mb-1">New Password</label>
                                <div class="relative">
                                    <input type="password" name="password" id="password"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] transition"
                                           placeholder="Enter new password">
                                    <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600 mb-1">Confirm Password</label>
                                <div class="relative">
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] transition"
                                           placeholder="Confirm new password">
                                    <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-yellow-50 rounded-lg p-3">
                            <div class="flex items-start">
                                <i class="fas fa-info-circle text-yellow-600 mt-0.5 mr-2"></i>
                                <p class="text-xs text-yellow-800">Leave password fields empty to keep the current password unchanged.</p>
                            </div>
                        </div>
                        
                        @error('password')
                            <p class="text-red-500 text-xs">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Security Info -->
                <div class="bg-green-50 rounded-xl p-4">
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-shield-alt text-green-600 text-lg mt-0.5"></i>
                        <div>
                            <p class="text-sm font-medium text-green-800">Security Best Practices</p>
                            <p class="text-xs text-green-700 mt-1">
                                Always use strong passwords with a mix of letters, numbers, and special characters.
                                Never share login credentials with others.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Form Actions -->
        <div class="flex justify-between items-center pb-10">
            <a href="{{ route('admin.users.show', $user) }}" 
               class="px-6 py-2.5 text-gray-600 hover:text-gray-800 transition flex items-center space-x-2">
                <i class="fas fa-times"></i>
                <span>Cancel</span>
            </a>
            <div class="flex space-x-3">
                <button type="reset" 
                        class="px-6 py-2.5 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition font-medium">
                    Reset Form
                </button>
                <button type="submit" 
                        class="px-6 py-2.5 bg-gradient-to-r from-[#0A1928] to-[#0D2A3A] hover:from-[#0D2A3A] hover:to-[#0A1928] text-white rounded-xl font-medium transition shadow-md flex items-center space-x-2">
                    <i class="fas fa-save"></i>
                    <span>Save Changes</span>
                </button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Toggle password fields visibility
    document.getElementById('showPasswordFields').addEventListener('click', function() {
        const passwordFields = document.getElementById('passwordFields');
        if (passwordFields.style.display === 'none') {
            passwordFields.style.display = 'block';
            this.innerHTML = '<i class="fas fa-minus mr-1"></i> Cancel password change';
        } else {
            passwordFields.style.display = 'none';
            this.innerHTML = '<i class="fas fa-plus mr-1"></i> Change password';
            // Clear password fields
            document.getElementById('password').value = '';
            document.getElementById('password_confirmation').value = '';
        }
    });
    
    // Toggle password visibility
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const type = field.type === 'password' ? 'text' : 'password';
        field.type = type;
    }
    
    // Reset button functionality
    document.querySelector('button[type="reset"]').addEventListener('click', function(e) {
        e.preventDefault();
        if (confirm('Reset all changes? This cannot be undone.')) {
            window.location.reload();
        }
    });
</script>
@endpush
@endsection