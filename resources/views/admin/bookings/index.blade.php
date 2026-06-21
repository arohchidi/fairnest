@extends('admin.layouts.app')

@section('title', 'Manage Bookings')
@section('header-title', 'Bookings Management')
@section('header-description', 'View and manage all property bookings')

@section('content')
<div class="space-y-6">
    
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-[#2D6A4F]">
            <p class="text-gray-500 text-xs">Total Bookings</p>
            <p class="text-2xl font-bold text-gray-800">{{ $statistics['total'] ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-blue-500">
            <p class="text-gray-500 text-xs">Pending</p>
            <p class="text-2xl font-bold text-blue-600">{{ $statistics['pending'] ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-green-500">
            <p class="text-gray-500 text-xs">Confirmed</p>
            <p class="text-2xl font-bold text-green-600">{{ $statistics['confirmed'] ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-yellow-500">
            <p class="text-gray-500 text-xs">Completed</p>
            <p class="text-2xl font-bold text-yellow-600">{{ $statistics['completed'] ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-red-500">
            <p class="text-gray-500 text-xs">Cancelled</p>
            <p class="text-2xl font-bold text-red-600">{{ $statistics['cancelled'] ?? 0 }}</p>
        </div>
    </div>
    
    <!-- Filters Section -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Filter Bookings</h3>
                    <p class="text-sm text-gray-500 mt-1">Search and filter through bookings</p>
                </div>
                <div class="text-sm text-gray-500">
                   
                </div>
            </div>
        </div>
        
        <div class="p-6">
            <form method="GET" action="{{ route('admin.bookings.index') }}" id="filterForm">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Guest, property, email..."
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                            <option value="">All Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Date From</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Date To</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                    </div>
                </div>
                
                <div class="flex justify-between items-center mt-4">
                    <button type="submit" class="px-4 py-2 bg-[#2D6A4F] text-white rounded-lg hover:bg-[#1B4D3E] transition flex items-center space-x-2">
                        <i class="fas fa-search"></i>
                        <span>Apply Filters</span>
                    </button>
                    
                    @if(request()->anyFilled(['search', 'status', 'date_from', 'date_to']))
                        <a href="{{ route('admin.bookings.index') }}" class="px-4 py-2 text-gray-600 hover:text-gray-800 transition flex items-center space-x-2">
                            <i class="fas fa-times"></i>
                            <span>Clear Filters</span>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
    
    <!-- Bookings Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center flex-wrap gap-3">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">All Bookings</h3>
                <p class="text-sm text-gray-500 mt-1">Total {{ 0}} bookings</p>
            </div>
           
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">#</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">User</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Phone</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Property</th>
                        
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Roommate Preference</th>
                        
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Status</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Date</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $index => $booking)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                        <td class="py-3 px-4 text-sm text-gray-500">{{ $booking->id }}</td>
                        
                        <!-- Guest -->
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-gradient-to-br from-[#2D6A4F] to-[#1B4D3E] rounded-full flex items-center justify-center text-white text-xs font-semibold">
                                    {{ strtoupper(substr($booking->username ??  'G', 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800 text-sm">{{ $booking->username ??  'Guest' }}</p>
                                    <p class="text-xs text-gray-400">{{ $booking->email ?? '' }}</p>
                                </div>
                            </div>
                        </td>
                          <!-- Check In -->
                        <td class="py-3 px-4 text-sm text-gray-700">{{ $booking->phone }}</td>
                        
                        <!-- Property -->
                        <td class="py-3 px-4">
                            <p class="text-sm text-gray-800">{{ Str::limit($booking->property->title ?? 'N/A', 25) }}</p>
                            <p class="text-xs text-gray-400">{{ $booking->property->city ?? '' }}, {{ $booking->property->country ?? '' }}</p>
                        </td>
                        
                        <!-- Roommate -->
                        <td class="py-3 px-4 text-sm text-gray-700">@if($booking->needs_roommate === '1') Yes @else No @endif</td>
                        
 <!-- Status Badge -->
                        <td class="py-3 px-4">
                            @php
                                $statusColors = [
                                    'pending' => 'yellow',
                                    'confirmed' => 'green',
                                    'completed' => 'blue',
                                    'cancelled' => 'red',
                                ];
                                $color = $statusColors[$booking->status] ?? 'gray';
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-{{ $color }}-100 text-{{ $color }}-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-{{ $color }}-500 mr-1.5"></span>
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>

                        <!-- Check Out -->
                        <td class="py-3 px-4 text-sm text-gray-700">{{ \Carbon\Carbon::parse($booking->created_at)->format('M d, Y') }}</td>
                        
                       
                        
                        
                        <!-- Actions -->
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-2">
                                <!-- View -->
                                <a href="{{ route('admin.bookings.show', $booking) }}" 
                                   class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition flex items-center justify-center"
                                   title="View Details">
                                    <i class="fas fa-eye text-sm"></i>
                                </a>
                                
                               
                                
                                <!-- Status Dropdown -->
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" class="w-8 h-8 rounded-lg bg-gray-100 text-gray-600 hover:bg-gray-200 transition flex items-center justify-center" title="Change Status">
                                        <i class="fas fa-chevron-down text-sm"></i>
                                    </button>
                                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg border border-gray-100 py-1 z-50" style="display: none;">
                                        <form method="POST" action="{{ route('admin.bookings.update-status', $booking) }}">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="pending">
                                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-yellow-600 hover:bg-gray-50 hover:text-yellow-700 transition">Pending</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.bookings.update-status', $booking) }}">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="confirmed">
                                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-green-600 hover:bg-gray-50 hover:text-green-700 transition">Confirmed</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.bookings.update-status', $booking) }}">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="completed">
                                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-blue-600 hover:bg-gray-50 hover:text-blue-700 transition">Completed</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.bookings.update-status', $booking) }}">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="cancelled">
                                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-50 hover:text-red-700 transition">Cancelled</button>
                                        </form>
                                    </div>
                                </div>
                                
                                <!-- Delete -->
                                <button type="button" onclick="confirmDelete({{ $booking->id }}, '{{ addslashes($booking->user->username ?? $booking->user->name ?? 'Guest') }}')" 
                                        class="w-8 h-8 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition flex items-center justify-center"
                                        title="Delete Booking">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                            </div>
                            
                            <!-- Delete Form -->
                            <form id="delete-form-{{ $booking->id }}" 
                                  action="{{ route('admin.bookings.destroy', $booking) }}" 
                                  method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-calendar-times text-5xl text-gray-300 mb-3"></i>
                                <p class="text-gray-500 text-lg">No bookings found</p>
                                <p class="text-gray-400 text-sm mt-1">Try adjusting your filters or create a new booking</p>
                                <a href="{{ route('admin.bookings.create') }}" class="mt-4 px-4 py-2 bg-[#2D6A4F] text-white rounded-lg hover:bg-[#1B4D3E] transition">
                                    <i class="fas fa-plus mr-2"></i>Add Booking
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($bookings->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            {{ $bookings->appends(request()->query())->links() }}
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
            <h3 class="text-lg font-semibold text-gray-900 text-center mb-2">Delete Booking</h3>
            <p class="text-gray-500 text-center text-sm" id="deleteMessage">Are you sure you want to delete this booking? This action cannot be undone.</p>
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

@push('scripts')
<script>
    let deleteId = null;
    
    function confirmDelete(id, guestName) {
        deleteId = id;
        document.getElementById('deleteMessage').innerHTML = `Are you sure you want to delete the booking for <strong>"${guestName}"</strong>? This action cannot be undone.`;
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