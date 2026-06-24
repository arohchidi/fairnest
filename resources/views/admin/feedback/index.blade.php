@extends('admin.layouts.app')

@section('title', 'Feedback Management')
@section('header-title', 'Feedback Management')
@section('header-description', 'View and manage user feedback from contact forms')

@section('content')
<div class="space-y-6">
    
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-[#2D6A4F]">
            <p class="text-gray-500 text-xs">Total Feedback</p>
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
    
    <!-- Filters Section -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Filter Feedback</h3>
                    <p class="text-sm text-gray-500 mt-1">Search and filter through user feedback</p>
                </div>
               
            </div>
        </div>
        
        
    </div>
    
    <!-- Feedback Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center flex-wrap gap-3">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">All Feedback</h3>
                <p class="text-sm text-gray-500 mt-1">Total {{ $feedbacks->total() }} feedback messages</p>
            </div>
           
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600 w-12">#</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Sender</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Category</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Subject</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Message</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Status</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Received</th>
                        <th class="text-center py-3 px-4 text-sm font-semibold text-gray-600 w-32">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($feedbacks as $item)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition {{ $item->status == 'unread' ? 'bg-blue-50/50' : '' }}">
                        <td class="py-3 px-4 text-sm text-gray-500">{{ $feedbacks->firstItem() + $loop->index }}</td>
                        
                        <!-- Sender -->
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-[#2D6A4F] to-[#1B4D3E] rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0">
                                    {{ strtoupper(substr($item->name ?? 'A', 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800 text-sm">{{ $item->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $item->email }}</p>
                                </div>
                            </div>
                        </td>
                        

                        <!-- Subject -->
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full 
                                @if($item->feedback_type == 'general') bg-gray-100 text-gray-700
                                @elseif($item->feedback_type == 'booking') bg-blue-100 text-blue-700
                                @elseif($item->feedback_type == 'property') bg-purple-100 text-purple-700
                                @elseif($item->feedback_type == 'payment') bg-green-100 text-green-700
                                @elseif($item->feedback_type == 'technical') bg-red-100 text-red-700
                                @elseif($item->feedback_type == 'partnership') bg-yellow-100 text-yellow-700
                                 @elseif($item->feedback_type == 'complain') bg-yellow-100 text-yellow-700
                                
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $item->feedback_type)) }}
                            </span>
                        </td>


                        <!-- Subject -->
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full">
                                
                                {{ ucfirst(str_replace('_', ' ', $item->subject)) }}
                            </span>
                        </td>
                        
                        <!-- Message -->
                        <td class="py-3 px-4">
                            <p class="text-sm text-gray-700 line-clamp-2">{{ $item->message }}</p>
                        </td>
                        
                        <!-- Status -->
                        <td class="py-3 px-4">
                            @php
                                $statusColors = [
                                    'pending' => 'yellow',
                                    'in_progress' => 'blue',
                                    'resolved' => 'green',
                                ];
                                $color = $statusColors[$item->status] ?? 'gray';
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-{{ $color }}-100 text-{{ $color }}-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-{{ $color }}-500 mr-1.5"></span>
                                {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                            </span>
                            @if($item->status == 'unread')
                                <span class="ml-1 inline-block w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                            @endif
                        </td>
                        
                        <!-- Date -->
                        <td class="py-3 px-4">
                            <p class="text-sm text-gray-700">{{ $item->created_at->format('M d, Y') }}</p>
                            <p class="text-xs text-gray-400">{{ $item->created_at->diffForHumans() }}</p>
                        </td>
                        
                        <!-- Actions -->
                        <td class="py-3 px-4">
                            <div class="flex items-center justify-center space-x-2">
                                
                                
                                <!-- Update Status -->
                                <button onclick="openStatusModal({{ $item->id }}, '{{ $item->status }}')" 
                                        class="w-8 h-8 rounded-lg bg-yellow-100 text-yellow-600 hover:bg-yellow-200 transition flex items-center justify-center"
                                        title="Update Status">
                                    <i class="fas fa-edit text-sm"></i>
                                </button>
                                
                                <!-- Delete -->
                                <button onclick="confirmDelete({{ $item->id }})" 
                                        class="w-8 h-8 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition flex items-center justify-center"
                                        title="Delete">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                            </div>
                            
                            <!-- Delete Form -->
                            <form id="delete-form-{{ $item->id }}" 
                                  action="{{ url('admin.feedback.destroy', $item) }}" 
                                  method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-comment-slash text-5xl text-gray-300 mb-3"></i>
                                <p class="text-gray-500 text-lg">No feedback found</p>
                                <p class="text-gray-400 text-sm mt-1">Users haven't submitted any feedback yet.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($feedbacks->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            {{ $feedbacks->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>

<!-- ============================================ -->
<!-- VIEW FEEDBACK MODAL -->
<!-- ============================================ -->
<div id="viewModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">
                <i class="fas fa-envelope-open-text text-[#2D6A4F] mr-2"></i>
                Feedback Details
            </h3>
            <button onclick="closeViewModal()" class="text-gray-400 hover:text-gray-600 transition">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <div id="viewModalContent" class="p-6 overflow-y-auto max-h-[70vh]">
            <!-- Content loaded via JavaScript -->
        </div>
        
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-end">
            <button onclick="closeViewModal()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                Close
            </button>
        </div>
    </div>
</div>

<!-- ============================================ -->
<!-- STATUS UPDATE MODAL -->
<!-- ============================================ -->
<div id="statusModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full mx-4">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">Update Status</h3>
            <button onclick="closeStatusModal()" class="text-gray-400 hover:text-gray-600 transition">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <form id="statusForm" method="POST" action="{{route('admin.feedback.update', $feedbacks)}}" class="p-6 space-y-4">
            @csrf
            @method('PATCH')
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" id="statusSelect" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                    <option value="unread">Unread</option>
                    <option value="in_progress">In Progress</option>
                    <option value="resolved">Resolved</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Admin Note</label>
                <textarea name="admin_note" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]" placeholder="Add a note about this feedback..."></textarea>
            </div>
            
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeStatusModal()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-[#2D6A4F] text-white rounded-lg hover:bg-[#1B4D3E] transition">
                    Update Status
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ============================================ -->
<!-- DELETE CONFIRMATION MODAL -->
<!-- ============================================ -->
<div id="deleteModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full mb-4">
                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 text-center mb-2">Delete Feedback</h3>
            <p class="text-gray-500 text-center text-sm" id="deleteMessage">Are you sure you want to delete this feedback? This action cannot be undone.</p>
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
 @php
use Illuminate\Support\Js;
@endphp

@push('scripts')
<script>
    // ============================================ //
    // VIEW FEEDBACK
    // ============================================ //
    let viewFeedbackId = null;
    
    function openViewModal(id) {
        viewFeedbackId = id;
        const content = document.getElementById('viewModalContent');
        
       
const feedbackData = {{ Js::from(
    $feedbacks->map(fn($item) => [
        'id' => $item->id,
        'name' => $item->name,
        'email' => $item->email,
        'subject' => $item->subject,
        'message' => $item->message,
        'status' => $item->status,
        'created_at' => $item->created_at?->format('F d, Y h:i A'),
        'admin_note' => $item->admin_note ?? '',
    ])->values()
) }};
        
        const data = feedbackData.find(f => f.id === id);
        
        if (data) {
            const statusColors = {
                'unread': 'bg-yellow-100 text-yellow-700',
                'in_progress': 'bg-blue-100 text-blue-700',
                'resolved': 'bg-green-100 text-green-700',
            };
            
            content.innerHTML = `
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Sender</p>
                            <p class="font-semibold text-gray-800">${data.name}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Email</p>
                            <p class="text-gray-800">${data.email}</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Subject</p>
                            <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-700">
                                ${data.subject.charAt(0).toUpperCase() + data.subject.slice(1)}
                            </span>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Received</p>
                            <p class="text-gray-800">${data.created_at}</p>
                        </div>
                    </div>
                    
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide">Status</p>
                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full ${statusColors[data.status] || 'bg-gray-100 text-gray-700'}">
                            ${data.status.charAt(0).toUpperCase() + data.status.slice(1)}
                        </span>
                    </div>
                    
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide">Message</p>
                        <div class="bg-gray-50 rounded-xl p-4 mt-1">
                            <p class="text-gray-700 whitespace-pre-line">${data.message}</p>
                        </div>
                    </div>
                    
                    ${data.admin_note ? `
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Admin Note</p>
                            <div class="bg-blue-50 rounded-xl p-4 mt-1 border border-blue-100">
                                <p class="text-blue-800">${data.admin_note}</p>
                            </div>
                        </div>
                    ` : ''}
                </div>
            `;
        }
        
        document.getElementById('viewModal').classList.remove('hidden');
        document.getElementById('viewModal').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    
    function closeViewModal() {
        document.getElementById('viewModal').classList.add('hidden');
        document.getElementById('viewModal').classList.remove('flex');
        document.body.style.overflow = '';
        viewFeedbackId = null;
    }
    
    // ============================================ //
    // STATUS UPDATE
    // ============================================ //
    let statusFeedbackId = null;
    
    function openStatusModal(id, currentStatus) {
        statusFeedbackId = id;
        document.getElementById('statusForm').action = `/admin/feedback/status/${id}/`;
        document.getElementById('statusSelect').value = currentStatus;
        document.getElementById('statusModal').classList.remove('hidden');
        document.getElementById('statusModal').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    
    function closeStatusModal() {
        document.getElementById('statusModal').classList.add('hidden');
        document.getElementById('statusModal').classList.remove('flex');
        document.body.style.overflow = '';
        statusFeedbackId = null;
    }
    
    // ============================================ //
    // DELETE CONFIRMATION
    // ============================================ //
    let deleteFeedbackId = null;
    
    function confirmDelete(id) {
        deleteFeedbackId = id;
        document.getElementById('deleteMessage').innerHTML = 'Are you sure you want to delete this feedback? This action cannot be undone.';
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteModal').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.getElementById('deleteModal').classList.remove('flex');
        document.body.style.overflow = '';
        deleteFeedbackId = null;
    }
    
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (deleteFeedbackId) {
            document.getElementById(`delete-form-${deleteFeedbackId}`).submit();
        }
    });
    
    // ============================================ //
    // CLOSE MODALS ON OUTSIDE CLICK
    // ============================================ //
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

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush
@endsection