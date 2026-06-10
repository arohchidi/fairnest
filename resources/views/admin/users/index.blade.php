@extends('admin.layouts.app')

@section('title', 'Manage Users')
@section('header-title', 'Users Management')
@section('header-description', 'Manage and monitor all registered users')

@section('content')
<div class="space-y-6">
    
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-[#2D6A4F]">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Total Users</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $statistics['total'] ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 bg-[#2D6A4F]/10 rounded-lg flex items-center justify-center">
                    <i class="fas fa-users text-[#2D6A4F] text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-green-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Active Users</p>
                    <p class="text-2xl font-bold text-green-600">{{ $statistics['active'] ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-yellow-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Inactive Users</p>
                    <p class="text-2xl font-bold text-yellow-600">{{ $statistics['in_active'] ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-user-slash text-yellow-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-blue-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">New This Month</p>
                    <p class="text-2xl font-bold text-blue-600">{{ $statistics['new_this_month'] ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-calendar-plus text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Filters Section -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Filter Users</h3>
                    <p class="text-sm text-gray-500 mt-1">Search and filter through registered users</p>
                </div>
                <div class="text-sm text-gray-500">
                    Showing  {{ $users->total() }}
                </div>
            </div>
        </div>
        
        <div class="p-6">
            <form method="GET" action="{{ route('admin.users.index') }}" id="filterForm">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Name, email or phone..."
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                        <select name="role" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent">
                            <option value="">All Roles</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                            <option value="agent" {{ request('role') == 'agent' ? 'selected' : '' }}>Agent</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="is_active" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent">
                            <option value="">All Status</option>
                            <option value="1" {{ request('is_active') == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ request('is_active') == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email Verified</label>
                        <select name="is_verified" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent">
                            <option value="">All</option>
                            <option value="1" {{ request('is_verified') == 1 ? 'selected' : '' }}>Verified</option>
                            <option value="0" {{ request('is_verified') == 0 ? 'selected' : '' }}>Not Verified</option>
                        </select>
                    </div>
                </div>
                
                <div class="flex justify-between items-center mt-4">
                    <button type="submit" class="px-4 py-2 bg-[#2D6A4F] text-white rounded-lg hover:bg-[#1B4D3E] transition flex items-center space-x-2">
                        <i class="fas fa-search"></i>
                        <span>Apply Filters</span>
                    </button>
                    
                    @if(request()->anyFilled(['search', 'role', 'is_active', 'is_verified']))
                        <a href="{{ route('admin.users.index') }}" class="px-4 py-2 text-gray-600 hover:text-gray-800 transition flex items-center space-x-2">
                            <i class="fas fa-times"></i>
                            <span>Clear Filters</span>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
    
    <!-- Users Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center flex-wrap gap-3">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">User Listings</h3>
                <p class="text-sm text-gray-500 mt-1">Total {{ $users->total() }} registered users</p>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">User</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Contact</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Role</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Status</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Joined</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                        <!-- User Info -->
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-[#2D6A4F] to-[#1B4D3E] rounded-full flex items-center justify-center text-white font-semibold shadow-sm">
                                    {{ strtoupper(substr($user->username ?? $user->name ?? 'U', 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $user->username ?? $user->name ?? 'N/A' }}</p>
                                    <p class="text-xs text-gray-500">ID: #{{ $user->id }}</p>
                                </div>
                            </div>
                        </td>
                        
                        <!-- Contact -->
                        <td class="py-3 px-4">
                            <div>
                                <p class="text-sm text-gray-700">{{ $user->email }}</p>
                                @if($user->phone)
                                    <p class="text-xs text-gray-500 mt-1">{{ $user->phone }}</p>
                                @endif
                            </div>
                        </td>
                        
                        <!-- Role -->
                        <td class="py-3 px-4">
                            @php
                                $roleColors = [
                                    'admin' => 'blue',
                                    'user' => 'green',
                                    'agent' => 'purple',
                                ];
                                $color = $roleColors[$user->role] ?? 'gray';
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-{{ $color }}-100 text-{{ $color }}-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-{{ $color }}-500 mr-1.5"></span>
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        
                        <!-- Status -->
                        <td class="py-3 px-4">
                            @if($user->is_active == 1)
                                <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span>
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mr-1.5"></span>
                                    Inactive
                                </span>
                            @endif
                            
                            @if(!$user->is_verified)
                                <span class="inline-flex items-center px-2 py-0.5 text-xs rounded-full bg-yellow-100 text-yellow-700 ml-2">
                                    Unverified
                                </span>
                            @endif
                        </td>
                        
                        <!-- Joined -->
                        <td class="py-3 px-4">
                            <p class="text-sm text-gray-700">{{ $user->created_at->format('M d, Y') }}</p>
                            <p class="text-xs text-gray-400">{{ $user->created_at->diffForHumans() }}</p>
                        </td>
                        
                        <!-- Actions -->
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-2">
                                <!-- View -->
                                <a href="{{route('admin.users.show', $user)}}" 
                                   class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition flex items-center justify-center"
                                   title="View Details">
                                    <i class="fas fa-eye text-sm"></i>
                                </a>
                                
                                <!-- Edit -->
                                <a href="{{route('admin.users.edit', $user)}}" 
                                   class="w-8 h-8 rounded-lg bg-yellow-100 text-yellow-600 hover:bg-yellow-200 transition flex items-center justify-center"
                                   title="Edit User">
                                    <i class="fas fa-edit text-sm"></i>
                                </a>
                                
                                <!-- Toggle Status -->
                                <button type="button" 
                                        onclick="toggleStatus({{ $user->id }}, '{{ addslashes($user->username ?? $user->name) }}', {{ $user->is_active ? 1 : 0 }})" 
                                        class="w-8 h-8 rounded-lg {{ $user->is_active ? 'bg-red-100 text-red-600 hover:bg-red-200' : 'bg-green-100 text-green-600 hover:bg-green-200' }} transition flex items-center justify-center"
                                        title="{{ $user->is_active == 1 ? 'Deactivate' : 'Activate' }} User">
                                    <i class="fas {{ $user->is_active == 1 ? 'fa-ban' : 'fa-check-circle' }} text-sm"></i>
                                </button>

<button type="button" onclick="confirmDelete({{ $user->id }}, '{{ addslashes($user->username) }}')" 
                                        class="w-8 h-8 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition flex items-center justify-center">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>

                            </div>
                            
 <!-- Delete Form -->
                            <form id="delete-form-{{ $user->id }}" 
                                  action="{{route('admin.delete.user', $user)}}" 
                                  method="GET" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <?php
                           if($user->is_active == 1){
                              $status = "true";
                           }else{
                             $status = "false";
                           }
                            ?>
                            <!-- Status Toggle Form -->
                            <form id="toggle-status-form-{{ $user->id }}" 
                                  action="{{ route('admin.users.toggle-status', [$user]) }}" 
                                  method="post" style="display: none;">
                                 @csrf
                                 @method('PATCH')
                               
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-users text-5xl text-gray-300 mb-3"></i>
                                <p class="text-gray-500 text-lg">No users found</p>
                                <p class="text-gray-400 text-sm mt-1">Try adjusting your filters</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($users->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            {{ $users->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full mx-4 transform transition-all">
        <div class="p-6">
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full mb-4">
                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 text-center mb-2">Delete User</h3>
            <p class="text-gray-500 text-center text-sm" id="deleteMessage">Are you sure you want to delete this user? This action cannot be undone.</p>
            <div class="flex space-x-3 mt-6">
                <button onclick="closeDeleteModal()" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    Cancel
                </button>
                <button id="confirmDeleteBtn" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>


<!-- Toggle Status Modal -->
<div id="toggleStatusModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full mx-4 transform transition-all">
        <div class="p-6">
            <div class="flex items-center justify-center w-12 h-12 mx-auto rounded-full mb-4" id="modalIconContainer">
                <i id="modalIcon" class="text-2xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 text-center mb-2" id="modalTitle">Confirm Action</h3>
            <p class="text-gray-500 text-center text-sm" id="modalMessage">Are you sure you want to change this user's status?</p>
            <div class="flex space-x-3 mt-6">
                <button onclick="closeStatusModal()" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    Cancel
                </button>
                <button id="confirmStatusBtn" class="flex-1 px-4 py-2 rounded-lg text-white transition">
                    Confirm
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let statusToggleId = null;
    let statusToggleAction = null;
    
    function toggleStatus(id, username, isActive) {
        statusToggleId = id;

        
        if (isActive) {
            // Currently active -> going to deactivate
            statusToggleAction = 'deactivate';
            document.getElementById('modalIconContainer').className = 'flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full mb-4';
            document.getElementById('modalIcon').className = 'fas fa-ban text-red-600 text-xl';
            document.getElementById('modalTitle').innerText = 'Deactivate User';
            document.getElementById('modalMessage').innerHTML = `Are you sure you want to deactivate <strong>"${username}"</strong>? This user will not be able to login.`;
            document.getElementById('confirmStatusBtn').className = 'flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition';
        } else {
            // Currently inactive -> going to activate
            statusToggleAction = 'activate';
            document.getElementById('modalIconContainer').className = 'flex items-center justify-center w-12 h-12 mx-auto bg-green-100 rounded-full mb-4';
            document.getElementById('modalIcon').className = 'fas fa-check-circle text-green-600 text-xl';
            document.getElementById('modalTitle').innerText = 'Activate User';
            document.getElementById('modalMessage').innerHTML = `Are you sure you want to activate <strong>"${username}"</strong>? This user will be able to login again.`;
            document.getElementById('confirmStatusBtn').className = 'flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition';
        }
        
        document.getElementById('toggleStatusModal').classList.remove('hidden');
        document.getElementById('toggleStatusModal').classList.add('flex');
    }
    
    function closeStatusModal() {
        document.getElementById('toggleStatusModal').classList.add('hidden');
        document.getElementById('toggleStatusModal').classList.remove('flex');
        statusToggleId = null;
        statusToggleAction = null;
    }
    
    document.getElementById('confirmStatusBtn').addEventListener('click', function() {
        if (statusToggleId) {
            document.getElementById(`toggle-status-form-${statusToggleId}`).submit();
        }
    });
    
    // Close modal on click outside
    document.getElementById('toggleStatusModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeStatusModal();
        }
    });
</script>



<script>
    let deleteId = null;
    
    function confirmDelete(id, username) {
        deleteId = id;
        document.getElementById('deleteMessage').innerHTML = `Are you sure you want to delete <strong>"${username}"</strong>? This action cannot be undone.`;
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteModal').classList.add('flex');
    }
    
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.getElementById('deleteModal').classList.remove('flex');
        deleteId = null;
    }
    
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (deleteId) {
            document.getElementById(`delete-form-${deleteId}`).submit();
        }
    });
    
    // Close modal on click outside
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });
</script>
@endpush
@endsection