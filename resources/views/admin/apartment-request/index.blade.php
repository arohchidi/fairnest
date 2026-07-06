@extends('admin.layouts.app')

@section('title', 'Apartment Requests')
@section('header-title', 'Apartment Requests')
@section('header-description', 'Manage and review apartment request submissions')

@section('content')
<div class="space-y-6">
    
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-[#2D6A4F]">
            <p class="text-gray-500 text-xs">Total Requests</p>
            <p class="text-2xl font-bold text-gray-800">{{ $statistics['total'] ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-yellow-500">
            <p class="text-gray-500 text-xs">Pending</p>
            <p class="text-2xl font-bold text-yellow-600">{{ $statistics['pending'] ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-blue-500">
            <p class="text-gray-500 text-xs">In Progress</p>
            <p class="text-2xl font-bold text-blue-600">{{ $statistics['in_progress'] ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-green-500">
            <p class="text-gray-500 text-xs">Resolved</p>
            <p class="text-2xl font-bold text-green-600">{{ $statistics['resolved'] ?? 0 }}</p>
        </div>
    </div>
    
    <!-- Filters -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-800">Filter Requests</h3>
        </div>
        <div class="p-6">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Name, email, phone..."
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="in_progress">In Progress</option>
                        <option value="resolved">Resolved</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                    <select name="location" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                        <option value="">All Locations</option>
                        <option value="independence_layout">Independence Layout</option>
                        <option value="ama_brewery">Ama Brewery</option>
                        <option value="obollo_road">Obollo Road</option>
                        <option value="agbani_road">Agbani Road</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date From</label>
                    <input type="date" name="date_from" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                </div>
                <div class="md:col-span-4 flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-[#2D6A4F] text-white rounded-lg hover:bg-[#1B4D3E] transition">
                        <i class="fas fa-search mr-2"></i> Apply Filters
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Requests Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">All Requests</h3>
            <span class="text-sm text-gray-500">{{ $requests->total() }} requests</span>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600 w-12">#</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Requester</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Location</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Apartment</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Budget</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Status</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Date</th>
                        <th class="text-center py-3 px-4 text-sm font-semibold text-gray-600 w-32">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($requests as $request)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                        <td class="py-3 px-4 text-sm text-gray-500">{{ $requests->firstItem() + $loop->index }}</td>
                        <td class="py-3 px-4">
                            <div>
                                <p class="font-medium text-gray-800">{{ $request->full_name }}</p>
                                <p class="text-xs text-gray-400">{{ $request->email }}</p>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <span class="text-sm text-gray-700 capitalize">{{ str_replace('_', ' ', $request->preferred_location) }}</span>
                        </td>
                        <td class="py-3 px-4">
                            <span class="text-sm text-gray-700 capitalize">{{ str_replace('_', ' ', $request->apartment_type) }}</span>
                        </td>
                        <td class="py-3 px-4">
                            <span class="text-sm text-gray-700">{{ str_replace('_', ' - ₦', $request->budget) }}</span>
                        </td>
                        <td class="py-3 px-4">
                            @php
                                $statusColors = [
                                    'pending' => 'yellow',
                                    'in_progress' => 'blue',
                                    'resolved' => 'green',
                                ];
                                $color = $statusColors[$request->status] ?? 'gray';
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-{{ $color }}-100 text-{{ $color }}-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-{{ $color }}-500 mr-1.5"></span>
                                {{ ucfirst(str_replace('_', ' ', $request->status)) }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-sm text-gray-500">{{ $request->created_at->format('M d, Y') }}</td>
                        <td class="py-3 px-4">
                            <div class="flex items-center justify-center space-x-2">
                                <button onclick="openViewModal({{ json_encode($request) }})" 
                                        class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition flex items-center justify-center">
                                    <i class="fas fa-eye text-sm"></i>
                                </button>
                                <button onclick="openStatusModal({{ $request->id }}, '{{ $request->status }}')" 
                                        class="w-8 h-8 rounded-lg bg-yellow-100 text-yellow-600 hover:bg-yellow-200 transition flex items-center justify-center">
                                    <i class="fas fa-edit text-sm"></i>
                                </button>
                                <button onclick="confirmDelete({{ $request->id }})" 
                                        class="w-8 h-8 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition flex items-center justify-center">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                            </div>
                            <form id="delete-form-{{ $request->id }}" 
                                  action="{{ route('admin.apartment-requests.destroy', $request) }}" 
                                  method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="py-12 text-center">
                            <i class="fas fa-home text-5xl text-gray-300 mb-3"></i>
                            <p class="text-gray-500 text-lg">No requests found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($requests->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            {{ $requests->links() }}
        </div>
        @endif
    </div>
</div>

<!-- View Modal -->
<div id="viewModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">Request Details</h3>
            <button onclick="closeViewModal()" class="text-gray-400 hover:text-gray-600 transition">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div id="viewModalContent" class="p-6 overflow-y-auto max-h-[70vh]"></div>
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-end">
            <button onclick="closeViewModal()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                Close
            </button>
        </div>
    </div>
</div>

<!-- Status Modal -->
<div id="statusModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full mx-4">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">Update Status</h3>
            <button onclick="closeStatusModal()" class="text-gray-400 hover:text-gray-600 transition">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <form id="statusForm" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PATCH')
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="resolved">Resolved</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Admin Note</label>
                <textarea name="admin_note" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]" placeholder="Add a note..."></textarea>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeStatusModal()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-[#2D6A4F] text-white rounded-lg hover:bg-[#1B4D3E] transition">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full mb-4">
                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 text-center mb-2">Delete Request</h3>
            <p class="text-gray-500 text-center text-sm" id="deleteMessage">Are you sure you want to delete this request? This action cannot be undone.</p>
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
    function openViewModal(data) {
        const content = document.getElementById('viewModalContent');
        const requirements = data.requirements ? JSON.parse(data.requirements).join(', ') : 'None specified';
        
        content.innerHTML = `
            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide">Full Name</p>
                        <p class="font-semibold text-gray-800">${data.full_name}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide">Phone</p>
                        <p class="font-semibold text-gray-800">${data.phone}</p>
                    </div>
                </div>
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wide">Email</p>
                    <p class="font-semibold text-gray-800">${data.email}</p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide">Preferred Location</p>
                        <p class="font-semibold text-gray-800 capitalize">${data.preferred_location.replace(/_/g, ' ')}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide">Apartment Type</p>
                        <p class="font-semibold text-gray-800 capitalize">${data.apartment_type.replace(/_/g, ' ')}</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide">Budget</p>
                        <p class="font-semibold text-gray-800">${data.budget.replace(/_/g, ' - ₦')}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide">Move-in Timeline</p>
                        <p class="font-semibold text-gray-800 capitalize">${data.move_in_timeline.replace(/_/g, ' ')}</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide">Occupancy Type</p>
                        <p class="font-semibold text-gray-800 capitalize">${data.occupancy_type}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide">Roommate Needed</p>
                        <p class="font-semibold text-gray-800 capitalize">${data.roommate_needed}</p>
                    </div>
                </div>
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wide">Inspection Reference</p>
                    <p class="font-semibold text-gray-800 capitalize">${data.inspection_reference.replace(/_/g, ' ')}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-wide">Requirements</p>
                    <p class="font-semibold text-gray-800">${requirements}</p>
                </div>
                ${data.notes ? `
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide">Additional Notes</p>
                        <p class="text-gray-700">${data.notes}</p>
                    </div>
                ` : ''}
                ${data.admin_note ? `
                    <div class="bg-blue-50 rounded-xl p-4 border border-blue-100">
                        <p class="text-xs text-blue-600 uppercase tracking-wide">Admin Note</p>
                        <p class="text-blue-800">${data.admin_note}</p>
                    </div>
                ` : ''}
            </div>
        `;
        
        document.getElementById('viewModal').classList.remove('hidden');
        document.getElementById('viewModal').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    
    function closeViewModal() {
        document.getElementById('viewModal').classList.add('hidden');
        document.getElementById('viewModal').classList.remove('flex');
        document.body.style.overflow = '';
    }
    
    function openStatusModal(id, currentStatus) {
        document.getElementById('statusForm').action = `/admin/apartment-requests/${id}/status`;
        document.getElementById('statusForm').querySelector('select[name="status"]').value = currentStatus;
        document.getElementById('statusModal').classList.remove('hidden');
        document.getElementById('statusModal').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    
    function closeStatusModal() {
        document.getElementById('statusModal').classList.add('hidden');
        document.getElementById('statusModal').classList.remove('flex');
        document.body.style.overflow = '';
    }
    
    let deleteId = null;
    
    function confirmDelete(id) {
        deleteId = id;
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteModal').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.getElementById('deleteModal').classList.remove('flex');
        document.body.style.overflow = '';
        deleteId = null;
    }
    
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (deleteId) {
            document.getElementById(`delete-form-${deleteId}`).submit();
        }
    });
    
    document.getElementById('viewModal').addEventListener('click', function(e) {
        if (e.target === this) closeViewModal();
    });
    document.getElementById('statusModal').addEventListener('click', function(e) {
        if (e.target === this) closeStatusModal();
    });
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
    });
</script>
@endpush
@endsection