@extends('admin.layouts.app')

@section('title', 'Manage FAQs')
@section('header-title', 'FAQ Management')
@section('header-description', 'Manage frequently asked questions')

@section('content')
<div class="space-y-6">
    
    <!-- Header Actions -->
    <div class="flex justify-between items-center">
        <div class="bg-white rounded-xl shadow-sm px-4 py-2">
            <span class="text-sm text-gray-600">Total FAQs: </span>
            <span class="font-semibold text-gray-800">{{ $faqs->total() }}</span>
        </div>
        <a href="{{ route('admin.faq.create') }}" class="px-4 py-2 bg-[#2D6A4F] hover:bg-[#1B4D3E] text-white rounded-lg transition flex items-center space-x-2">
            <i class="fas fa-plus"></i>
            <span>Add New FAQ</span>
        </a>
    </div>
    
    <!-- FAQs Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200 sticky top-0">
                    <tr>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600 w-12">#</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600 w-64">Question</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Answer</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600 w-28">Category</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600 w-20">Status</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600 w-20">Order</th>
                        <th class="text-center py-3 px-4 text-sm font-semibold text-gray-600 w-24">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($faqs as $index => $faq)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition group">
                        <td class="py-3 px-4 text-sm text-gray-500 align-top">{{ $faqs->firstItem() + $index }}</td>
                        <td class="py-3 px-4 align-top">
                            <p class="font-medium text-gray-800">{{ Str::limit($faq->question, 60) }}</p>
                            <p class="text-xs text-gray-400 mt-1">ID: #{{ $faq->id }}</p>
                        </td>
                        <td class="py-3 px-4">
                            <div class="relative">
                                <p class="text-sm text-gray-600 line-clamp-2">{{ Str::limit($faq->answer, 100) }}</p>
                                @if(strlen($faq->answer) > 100)
                                <button type="button" onclick="toggleAnswer({{ $faq->id }})" 
                                        class="text-xs text-[#2D6A4F] hover:underline mt-1 focus:outline-none">
                                    <i class="fas fa-chevron-down mr-1" id="expand-icon-{{ $faq->id }}"></i>
                                    <span id="expand-text-{{ $faq->id }}">Read more</span>
                                </button>
                                <div id="full-answer-{{ $faq->id }}" class="hidden mt-2 text-sm text-gray-600 bg-gray-50 p-3 rounded-lg">
                                    {{ $faq->answer }}
                                </div>
                                @endif
                            </div>
                        </td>
                        <td class="py-3 px-4 align-top">
                            <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full 
                                @if($faq->category == 'general') bg-gray-100 text-gray-700
                                @elseif($faq->category == 'booking') bg-blue-100 text-blue-700
                                @elseif($faq->category == 'payment') bg-green-100 text-green-700
                                @elseif($faq->category == 'cancellation') bg-red-100 text-red-700
                                @elseif($faq->category == 'property') bg-purple-100 text-purple-700
                                @else bg-yellow-100 text-yellow-700
                                @endif">
                                {{ ucfirst($faq->category) }}
                            </span>
                        </td>
                        <td class="py-3 px-4 align-top">
                            @if($faq->is_active)
                                <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span>
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-600">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400 mr-1.5"></span>
                                    Inactive
                                </span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-sm text-gray-600 align-top">{{ $faq->sort_order }}</td>
                        <td class="py-3 px-4 align-top">
                            <div class="flex items-center justify-center space-x-2">
                                <!-- Toggle Status -->
                                <button type="button" onclick="toggleStatus({{ $faq->id }}, {{ $faq->is_active ? 'true' : 'false' }})" 
                                        class="w-8 h-8 rounded-lg {{ $faq->is_active ? 'bg-gray-100 text-gray-500 hover:bg-yellow-100 hover:text-yellow-600' : 'bg-gray-100 text-gray-500 hover:bg-green-100 hover:text-green-600' }} transition flex items-center justify-center"
                                        title="{{ $faq->is_active ? 'Deactivate' : 'Activate' }}">
                                    <i class="fas {{ $faq->is_active ? 'fa-eye-slash' : 'fa-eye' }} text-sm"></i>
                                </button>
                                
                                <!-- Edit -->
                                <a href="{{ route('admin.faq.edit', $faq) }}" 
                                   class="w-8 h-8 rounded-lg bg-yellow-100 text-yellow-600 hover:bg-yellow-200 transition flex items-center justify-center"
                                   title="Edit FAQ">
                                    <i class="fas fa-edit text-sm"></i>
                                </a>
                                
                                <!-- Delete -->
                                <button type="button" onclick="confirmDelete({{ $faq->id }}, '{{ addslashes($faq->question) }}')" 
                                        class="w-8 h-8 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition flex items-center justify-center"
                                        title="Delete FAQ">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                            </div>
                            
                            <!-- Status Toggle Form -->
                            <form id="toggle-status-form-{{ $faq->id }}" 
                                  action="{{ route('admin.faq.toggle-status', $faq) }}" 
                                  method="POST" style="display: none;">
                                @csrf
                                @method('PATCH')
                            </form>
                            
                            <!-- Delete Form -->
                            <form id="delete-form-{{ $faq->id }}" 
                                  action="{{ route('admin.faq.destroy', $faq) }}" 
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
                                <i class="fas fa-question-circle text-5xl text-gray-300 mb-3"></i>
                                <p class="text-gray-500 text-lg">No FAQs found</p>
                                <p class="text-gray-400 text-sm mt-1">Get started by adding your first FAQ</p>
                                <a href="{{ route('admin.faq.create') }}" class="mt-4 px-4 py-2 bg-[#2D6A4F] text-white rounded-lg hover:bg-[#1B4D3E] transition">
                                    <i class="fas fa-plus mr-2"></i>Add FAQ
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($faqs->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            {{ $faqs->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Toggle Status Modal -->
<div id="toggleStatusModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex items-center justify-center w-12 h-12 mx-auto rounded-full mb-4" id="modalIconContainer">
                <i id="modalIcon" class="text-2xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 text-center mb-2" id="modalTitle"></h3>
            <p class="text-gray-500 text-center text-sm" id="modalMessage"></p>
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

<!-- Delete Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full mb-4">
                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 text-center mb-2">Delete FAQ</h3>
            <p class="text-gray-500 text-center text-sm" id="deleteMessage"></p>
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

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

@push('scripts')
<script>
    // Toggle full answer visibility
    function toggleAnswer(id) {
        const fullAnswerDiv = document.getElementById(`full-answer-${id}`);
        const icon = document.getElementById(`expand-icon-${id}`);
        const text = document.getElementById(`expand-text-${id}`);
        
        if (fullAnswerDiv.classList.contains('hidden')) {
            fullAnswerDiv.classList.remove('hidden');
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');
            text.textContent = 'Read less';
        } else {
            fullAnswerDiv.classList.add('hidden');
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
            text.textContent = 'Read more';
        }
    }
    
    // Status toggle
    let statusToggleId = null;
    
    function toggleStatus(id, isActive) {
        statusToggleId = id;
        if (isActive) {
            document.getElementById('modalIconContainer').className = 'flex items-center justify-center w-12 h-12 mx-auto bg-yellow-100 rounded-full mb-4';
            document.getElementById('modalIcon').className = 'fas fa-eye-slash text-yellow-600 text-xl';
            document.getElementById('modalTitle').innerText = 'Deactivate FAQ';
            document.getElementById('modalMessage').innerHTML = 'This FAQ will not be visible to users. Are you sure?';
            document.getElementById('confirmStatusBtn').className = 'flex-1 px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition';
        } else {
            document.getElementById('modalIconContainer').className = 'flex items-center justify-center w-12 h-12 mx-auto bg-green-100 rounded-full mb-4';
            document.getElementById('modalIcon').className = 'fas fa-eye text-green-600 text-xl';
            document.getElementById('modalTitle').innerText = 'Activate FAQ';
            document.getElementById('modalMessage').innerHTML = 'This FAQ will be visible to users. Are you sure?';
            document.getElementById('confirmStatusBtn').className = 'flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition';
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
    
    // Delete confirmation
    let deleteId = null;
    
    function confirmDelete(id, question) {
        deleteId = id;
        document.getElementById('deleteMessage').innerHTML = `Are you sure you want to delete "<strong>${question}</strong>"? This action cannot be undone.`;
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
    
    // Close modals on outside click
    document.getElementById('toggleStatusModal').addEventListener('click', function(e) {
        if (e.target === this) closeStatusModal();
    });
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
    });
</script>
@endpush
@endsection