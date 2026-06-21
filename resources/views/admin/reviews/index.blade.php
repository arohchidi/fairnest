@extends('admin.layouts.app')

@section('title', 'Property Reviews')
@section('header-title', 'Property Reviews')
@section('header-description', 'Manage and moderate property reviews')

@section('content')
<div class="space-y-6">
    
    <!-- Statistics -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-[#2D6A4F]">
            <p class="text-gray-500 text-xs">Total Reviews</p>
            <p class="text-2xl font-bold text-gray-800">{{ $statistics['total'] ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-yellow-500">
            <p class="text-gray-500 text-xs">Pending Approval</p>
            <p class="text-2xl font-bold text-yellow-600">{{ $statistics['pending'] ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-green-500">
            <p class="text-gray-500 text-xs">Approved</p>
            <p class="text-2xl font-bold text-green-600">{{ $statistics['approved'] ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-red-500">
            <p class="text-gray-500 text-xs">Flagged</p>
            <p class="text-2xl font-bold text-red-600">{{ $statistics['flagged'] ?? 0 }}</p>
        </div>
    </div>
    
   
    <!-- Reviews Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center flex-wrap gap-3">
            <h3 class="text-lg font-semibold text-gray-800">All Reviews</h3>
            <div class="flex items-center space-x-3">
                <span class="text-sm text-gray-500">{{ $reviews->total() }} reviews</span>
                <div class="flex items-center space-x-2">
                    
                   
                
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Review</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Property</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">User</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Rating</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Status</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Date</th>
                        <th class="text-center py-3 px-4 text-sm font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews as $review)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                        <td class="py-3 px-4">
                            <div>
                                <p class="text-sm text-gray-800 line-clamp-2">{{ Str::limit($review->comment, 60) }}</p>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <p class="text-sm text-gray-800">{{ Str::limit($review->property->title ?? 'N/A', 25) }}</p>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gradient-to-br from-[#2D6A4F] to-[#1B4D3E] rounded-full flex items-center justify-center text-white text-xs font-bold">
                                    {{ strtoupper(substr($review->name ?? 'G', 0, 1)) }}
                                </div>
                                <span class="text-sm text-gray-800">{{ ucfirst($review->name) ?? 'Guest' }}</span>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex text-yellow-400 text-sm">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="{{ $i <= $review->ratings ? 'fas' : 'far' }} fa-star"></i>
                                @endfor
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            @php
                                $statusColors = [
                                    'pending' => 'yellow',
                                    'approved' => 'green',
                                    'flagged' => 'red',
                                    'rejected' => 'gray',
                                ];
                                $color = $statusColors[$review->status] ?? 'gray';
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-{{ $color }}-100 text-{{ $color }}-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-{{ $color }}-500 mr-1.5"></span>
                                {{ ucfirst($review->status) }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-sm text-gray-500">{{ $review->created_at->format('M d, Y') }}</td>
                        <td class="py-3 px-4">
                            <div class="flex items-center justify-center space-x-2">
                              
                                
                                <!-- Approve (only for pending) -->
                                @if($review->status == 'pending')
                                    <button onclick="openApproveModal({{ $review->id }}, '{{ addslashes($review->name ?? 'Guest') }}')" 
                                            class="w-8 h-8 rounded-lg bg-green-100 text-green-600 hover:bg-green-200 transition flex items-center justify-center">
                                        <i class="fas fa-check text-sm"></i>
                                    </button>
                                @endif
                                
                                <!-- Delete -->
                                <button onclick="openDeleteModal({{ $review->id }}, '{{ addslashes($review->name ?? 'Guest') }}')" 
                                        class="w-8 h-8 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition flex items-center justify-center">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                            </div>
                            
                            <!-- Approve Form -->
                            <form id="approve-form-{{ $review->id }}" 
                                  action="{{ route('admin.reviews.approve', $review) }}" 
                                  method="POST" style="display: none;">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="approved" />
                            </form>
                            
                            <!-- Delete Form -->
                            <form id="delete-review-form-{{ $review->id }}" 
                                  action="{{ route('admin.reviews.destroy', $review) }}" 
                                  method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center">
                            <i class="fas fa-star text-5xl text-gray-300 mb-3"></i>
                            <p class="text-gray-500">No reviews found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($reviews->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            {{ $reviews->links() }}
        </div>
        @endif
    </div>
</div>

<!-- ============================================ -->
<!-- APPROVE REVIEW MODAL -->
<!-- ============================================ -->
<div id="approveModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-green-100 rounded-full mb-4">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 text-center mb-2">Approve Review</h3>
            <p class="text-gray-500 text-center text-sm" id="approveMessage">Are you sure you want to approve this review?</p>
            <div class="flex space-x-3 mt-6">
                <button onclick="closeApproveModal()" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    Cancel
                </button>
                <button id="confirmApproveBtn" class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                    <i class="fas fa-check mr-2"></i> Approve
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================ -->
<!-- DELETE REVIEW MODAL -->
<!-- ============================================ -->
<div id="deleteModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full mb-4">
                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 text-center mb-2">Delete Review</h3>
            <p class="text-gray-500 text-center text-sm" id="deleteMessage">Are you sure you want to delete this review?</p>
            <div class="flex space-x-3 mt-6">
                <button onclick="closeDeleteModal()" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    Cancel
                </button>
                <button id="confirmDeleteBtn" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    <i class="fas fa-trash mr-2"></i> Delete
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // ============================================ //
    // APPROVE REVIEW
    // ============================================ //
    let approveReviewId = null;

    function openApproveModal(id, userName) {
        approveReviewId = id;
        document.getElementById('approveMessage').innerHTML = `Are you sure you want to approve the review from <strong>"${userName}"</strong>? It will become visible to all users.`;
        document.getElementById('approveModal').classList.remove('hidden');
        document.getElementById('approveModal').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeApproveModal() {
        document.getElementById('approveModal').classList.add('hidden');
        document.getElementById('approveModal').classList.remove('flex');
        document.body.style.overflow = '';
        approveReviewId = null;
    }

    document.getElementById('confirmApproveBtn').addEventListener('click', function() {
        if (approveReviewId) {
            document.getElementById(`approve-form-${approveReviewId}`).submit();
        }
    });

    // ============================================ //
    // DELETE REVIEW
    // ============================================ //
    let deleteReviewId = null;

    function openDeleteModal(id, userName) {
        deleteReviewId = id;
        document.getElementById('deleteMessage').innerHTML = `Are you sure you want to delete the review from <strong>"${userName}"</strong>? This action cannot be undone.`;
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteModal').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.getElementById('deleteModal').classList.remove('flex');
        document.body.style.overflow = '';
        deleteReviewId = null;
    }

    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (deleteReviewId) {
            document.getElementById(`delete-review-form-${deleteReviewId}`).submit();
        }
    });

    // ============================================ //
    // CLOSE MODALS ON OUTSIDE CLICK
    // ============================================ //
    document.getElementById('approveModal').addEventListener('click', function(e) {
        if (e.target === this) closeApproveModal();
    });
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
    });

    // ============================================ //
    // VIEW REVIEW (placeholder)
    // ============================================ //
    function viewReview(id) {
        alert('View review functionality coming soon. Review ID: ' + id);
    }
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