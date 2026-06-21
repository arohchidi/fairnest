@extends('admin.layouts.app')

@section('title', 'Report Details')
@section('header-title', 'Report Details')
@section('header-description', 'View and manage property report')

@section('content')
<div class="max-w-6xl mx-auto">
    
    <!-- Navigation & Actions -->
    <div class="mb-6 flex flex-wrap justify-between items-center gap-3">
        <a href="{{ route('admin.reports.index') }}" class="inline-flex items-center space-x-2 text-gray-500 hover:text-[#2D6A4F] transition group">
            <i class="fas fa-arrow-left text-sm group-hover:-translate-x-1 transition"></i>
            <span>Back to Reports</span>
        </a>
        <div class="flex space-x-3">
            <button onclick="updateStatus({{ $report->id }})" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition flex items-center space-x-2">
                <i class="fas fa-edit"></i>
                <span>Update Status</span>
            </button>
            <button onclick="confirmDelete({{ $report->id }})" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition flex items-center space-x-2">
                <i class="fas fa-trash"></i>
                <span>Delete</span>
            </button>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- ============================================ -->
        <!-- LEFT COLUMN (2/3) - MAIN DETAILS -->
        <!-- ============================================ -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Report Header -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-red-50 to-white border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Report #{{ $report->id }}</p>
                            <h2 class="text-xl font-bold text-gray-800">{{ $report->title }}</h2>
                        </div>
                        @php
                            $statusColors = [
                                'pending' => 'yellow',
                                'in_progress' => 'blue',
                                'resolved' => 'green',
                                'dismissed' => 'gray',
                            ];
                            $color = $statusColors[$report->status] ?? 'gray';
                        @endphp
                        <span class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-full bg-{{ $color }}-100 text-{{ $color }}-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-{{ $color }}-500 mr-1.5"></span>
                            {{ Str::title(str_replace('_', ' ', $report->status)) }}
                        </span>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Category</p>
                            <p class="text-sm font-medium text-gray-800 mt-1">
                                <span class="inline-flex items-center px-2.5 py-1 text-xs rounded-full bg-red-100 text-red-700">
                                    {{ Str::title(str_replace('_', ' ', $report->category)) }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Reported By</p>
                            <p class="text-sm font-medium text-gray-800 mt-1">{{ $report->name ?? 'Anonymous' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Submitted</p>
                            <p class="text-sm font-medium text-gray-800 mt-1">{{ $report->created_at->format('M d, Y H:i A') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">Last Updated</p>
                            <p class="text-sm font-medium text-gray-800 mt-1">{{ $report->updated_at->format('M d, Y H:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Property Details -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-building text-[#2D6A4F] mr-2"></i>
                        Property Details
                    </h3>
                </div>
                <div class="p-6">
                    <div class="flex items-start space-x-4">
                        <div class="w-24 h-24 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0">
                            @if($report->property->images)
                                <img src="{{ asset('storage/' . $report->property->images[0]) }}" 
                                     alt="{{ $report->property->title }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <i class="fas fa-building text-3xl"></i>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <a href="{{ route('admin.show.property', $report->property) }}" 
                               class="text-lg font-semibold text-gray-800 hover:text-[#2D6A4F] transition">
                                {{ $report->property->title }}
                            </a>
                            <p class="text-sm text-gray-500 mt-1">
                                <i class="fas fa-map-marker-alt text-[#2D6A4F] mr-1"></i>
                                {{ $report->property->address }}, {{ $report->property->city }}, {{ $report->property->country }}
                            </p>
                            <div class="flex flex-wrap gap-4 mt-2 text-sm text-gray-600">
                                <span><i class="fas fa-bed text-[#2D6A4F] mr-1"></i> {{ $report->property->number_of_bedrooms ?? 'N/A' }} beds</span>
                                <span><i class="fas fa-bath text-[#2D6A4F] mr-1"></i> {{ $report->property->number_of_bathrooms ?? 'N/A' }} baths</span>
                                <span><i class="fas fa-dollar-sign text-[#2D6A4F] mr-1"></i> ${{ number_format($report->property->price_per_night ?? 0, 2) }}/night</span>
                            </div>
                            <a href="{{ route('admin.show.property', $report->property) }}" 
                               class="inline-flex items-center text-sm text-[#2D6A4F] hover:underline mt-2">
                                View Property <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Report Description -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-align-left text-[#2D6A4F] mr-2"></i>
                        Report Description
                    </h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $report->description }}</p>
                    
                    @if($report->photo && count($report->photo) > 0)
                        <div class="mt-4">
                            <p class="text-sm font-medium text-gray-700 mb-2">Evidence Attached:</p>
                            <div class="grid grid-cols-3 md:grid-cols-4 gap-3">
                                @foreach($report->photo as $photo)
                                    <div class="relative rounded-lg overflow-hidden border border-gray-200 h-24">
                                        <img src="{{ asset('storage/' . $photo) }}" 
                                             alt="Evidence" 
                                             class="w-full h-full object-cover">
                                        <a href="{{ asset('storage/' . $photo) }}" 
                                           target="_blank" 
                                           class="absolute inset-0 bg-black/40 opacity-0 hover:opacity-100 transition flex items-center justify-center">
                                            <i class="fas fa-search text-white text-lg"></i>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Action History -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-history text-[#2D6A4F] mr-2"></i>
                        Action History
                    </h3>
                </div>
                <div class="divide-y divide-gray-100">
                    @forelse($report->activities ?? [] as $activity)
                        <div class="px-6 py-4 hover:bg-gray-50 transition">
                            <div class="flex items-start justify-between">
                                <div class="flex items-start space-x-3">
                                    <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-gray-400 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-800">{{ $activity->description }}</p>
                                        <p class="text-xs text-gray-400">{{ $activity->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <span class="text-xs text-gray-400">{{ $activity->created_at->format('M d, Y H:i A') }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="px-6 py-8 text-center text-gray-500">
                            No activity recorded yet
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        
        <!-- ============================================ -->
        <!-- RIGHT COLUMN (1/3) - SIDEBAR -->
        <!-- ============================================ -->
        <div class="lg:col-span-1 space-y-6">
             <div class="sticky top-24 space-y-6">
            <!-- Reporter Information -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden  top-24">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-user text-[#2D6A4F] mr-2"></i>
                        Reporter Information
                    </h3>
                </div>
                <div class="p-6 space-y-3">
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide">Name</p>
                        <p class="text-sm font-medium text-gray-800">{{ $report->name ?? 'Anonymous' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wide">Email</p>
                        <p class="text-sm font-medium text-gray-800">{{ $report->email ?? 'N/A' }}</p>
                    </div>
                    @if($report->anonymous)
                        <div class="mt-2 p-2 bg-gray-100 rounded-lg">
                            <p class="text-xs text-gray-500">
                                <i class="fas fa-user-secret mr-1"></i> 
                                Reported anonymously
                            </p>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-bolt text-[#2D6A4F] mr-2"></i>
                        Quick Actions
                    </h3>
                </div>
                <div class="p-4 space-y-2">
                    <button onclick="updateStatus({{ $report->id }})" class="w-full px-4 py-2.5 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition flex items-center justify-center space-x-2">
                        <i class="fas fa-edit"></i>
                        <span>Update Status</span>
                    </button>
                    <button onclick="markResolved({{ $report->id }})" class="w-full px-4 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-lg transition flex items-center justify-center space-x-2">
                        <i class="fas fa-check-circle"></i>
                        <span>Mark as Resolved</span>
                    </button>
                    <button onclick="dismissReport({{ $report->id }})" class="w-full px-4 py-2.5 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition flex items-center justify-center space-x-2">
                        <i class="fas fa-times-circle"></i>
                        <span>Dismiss Report</span>
                    </button>
                    <a href="{{ route('admin.show.property', $report->property) }}" class="w-full px-4 py-2.5 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition flex items-center justify-center space-x-2">
                        <i class="fas fa-building"></i>
                        <span>View Property</span>
                    </a>
                </div>
            </div>
            
            <!-- Contact Reporter -->
            <div class="bg-gradient-to-r from-[#0A1928] to-[#0D2A3A] rounded-2xl shadow-lg p-6 text-white">
                <h3 class="text-lg font-semibold mb-3 flex items-center">
                    <i class="fas fa-envelope mr-2"></i>
                    Contact Reporter
                </h3>
                <p class="text-gray-300 text-sm mb-4">Send a message to the reporter for more information.</p>
                <a href="{{ url('admin.emails.create', ['recipient' => $report->email]) }}" 
                   class="inline-flex items-center px-4 py-2 bg-[#2D6A4F] text-white rounded-xl hover:bg-[#1B4D3E] transition text-sm">
                    <i class="fas fa-paper-plane mr-2"></i> Send Email
                </a>
            </div>
            </div>
        </div>
   
   
    </div>
</div>

<!-- Status Update Modal -->
<div id="statusModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full mx-4 p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Update Report Status</h3>
        <form id="statusForm" method="POST" action="{{ route('admin.reports.status', $report) }}">
            @csrf
            @method('PATCH')
            <div class="space-y-4">
                <select name="status" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                    <option value="pending" {{ $report->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ $report->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="resolved" {{ $report->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                    <option value="dismissed" {{ $report->status == 'dismissed' ? 'selected' : '' }}>Dismissed</option>
                </select>
                <textarea name="note" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]" placeholder="Add a note about this update..."></textarea>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeStatusModal()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-[#2D6A4F] text-white rounded-lg hover:bg-[#1B4D3E] transition">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Delete Form -->
<form id="delete-form-{{ $report->id }}" action="{{ route('admin.reports.destroy', $report) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<!-- Delete Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full mb-4">
                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 text-center mb-2">Delete Report</h3>
            <p class="text-gray-500 text-center text-sm">Are you sure you want to delete this report? This action cannot be undone.</p>
            <div class="flex space-x-3 mt-6">
                <button onclick="closeDeleteModal()" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">Cancel</button>
                <button id="confirmDeleteBtn" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Delete</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Status modal
    function updateStatus(id) {
        document.getElementById('statusModal').classList.remove('hidden');
        document.getElementById('statusModal').classList.add('flex');
    }
    
    function closeStatusModal() {
        document.getElementById('statusModal').classList.add('hidden');
        document.getElementById('statusModal').classList.remove('flex');
    }
    
    function markResolved(id) {
        if (confirm('Mark this report as resolved?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('admin.reports.status', $report) }}';
            form.innerHTML = '@csrf @method('PATCH') <input type="hidden" name="status" value="resolved">';
            document.body.appendChild(form);
            form.submit();
        }
    }
    
    function dismissReport(id) {
        if (confirm('Dismiss this report?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('admin.reports.status', $report) }}';
            form.innerHTML = '@csrf @method('PATCH') <input type="hidden" name="status" value="dismissed">';
            document.body.appendChild(form);
            form.submit();
        }
    }
    
    // Delete
    let deleteId = null;
    
    function confirmDelete(id) {
        deleteId = id;
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
    document.getElementById('statusModal').addEventListener('click', function(e) {
        if (e.target === this) closeStatusModal();
    });
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
    });
</script>
@endpush
@endsection