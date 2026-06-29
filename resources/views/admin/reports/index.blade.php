@extends('admin.layouts.app')

@section('title', 'Reported Properties')
@section('header-title', 'Reported Properties')
@section('header-description', 'Manage and review property reports')

@section('content')
<div class="space-y-6">
    
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-red-500">
            <p class="text-gray-500 text-xs">Total Reports</p>
            <p class="text-2xl font-bold text-gray-800">{{ $statistics['total'] ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-yellow-500">
            <p class="text-gray-500 text-xs">Pending Review</p>
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
            <h3 class="text-lg font-semibold text-gray-800">Filter Reports</h3>
        </div>
        <div class="p-6">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="in_progress">In Progress</option>
                        <option value="resolved">Resolved</option>
                        <option value="dismissed">Dismissed</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                        <option value="">All Categories</option>
                        <option value="inaccurate_description">Inaccurate Description</option>
                        <option value="wrong_price">Wrong Price</option>
                        <option value="incorrect_location">Incorrect Location</option>
                        <option value="misleading_photos">Misleading Photos</option>
                        <option value="fraudulent_listing">Fraudulent Listing</option>
                        <option value="scam_suspected">Scam Suspected</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date From</label>
                    <input type="date" name="date_from" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date To</label>
                    <input type="date" name="date_to" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]">
                </div>
                <div class="md:col-span-4 flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-[#2D6A4F] text-white rounded-lg hover:bg-[#1B4D3E] transition">
                        <i class="fas fa-search mr-2"></i> Apply Filters
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Reports Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">All Reports</h3>
            <span class="text-sm text-gray-500">{{ $reports->total() }} reports</span>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">#</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Property</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Category</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Reported By</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Status</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Date</th>
                        <th class="text-center py-3 px-4 text-sm font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $report)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                        <td class="py-3 px-4 text-sm text-gray-500">#</td>
                        <td class="py-3 px-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                    <img src="{{ $report->property->images[0] ? asset('storage/' . $report->property->images[0]) : asset('images/no-image.jpg') }}" 
                                         alt="" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800 text-sm">{{ Str::limit($report->property->title, 25) }}</p>
                                    <p class="text-xs text-gray-400">{{ $report->property->address }},{{ $report->property->city }},{{ $report->property->country }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center px-2.5 py-1 text-xs rounded-full bg-red-100 text-red-700">
                                {{ Str::title(str_replace('_', ' ', $report->category)) }}
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <div>
                                <p class="text-sm text-gray-800">{{ $report->name ?? 'Anonymous' }}</p>
                                <p class="text-xs text-gray-400">{{ $report->email }}</p>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            @php
                                $statusColors = [
                                    'pending' => 'yellow',
                                    'in_progress' => 'blue',
                                    'resolved' => 'green',
                                    'dismissed' => 'gray',
                                ];
                                $color = $statusColors[$report->status] ?? 'gray';
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-{{ $color }}-100 text-{{ $color }}-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-{{ $color }}-500 mr-1.5"></span>
                                {{ Str::title(str_replace('_', ' ', $report->status)) }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-sm text-gray-500">{{ $report->created_at->format('M d, Y') }}</td>
                        <td class="py-3 px-4">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('admin.reports.show', $report) }}" 
                                   class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition flex items-center justify-center">
                                    <i class="fas fa-eye text-sm"></i>
                                </a>
                                <button onclick="updateStatus({{ $report->id }})" 
                                        class="w-8 h-8 rounded-lg bg-yellow-100 text-yellow-600 hover:bg-yellow-200 transition flex items-center justify-center">
                                    <i class="fas fa-edit text-sm"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center">
                            <i class="fas fa-flag text-5xl text-gray-300 mb-3"></i>
                            <p class="text-gray-500">No reports found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($reports->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            {{ $reports->links() }}
        </div>
        @endif
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
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="resolved">Resolved</option>
                    <option value="dismissed">Dismissed</option>
                </select>
                <textarea name="note" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2D6A4F]" placeholder="Add a note..."></textarea>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeStatusModal()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-[#2D6A4F] text-white rounded-lg hover:bg-[#1B4D3E] transition">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function updateStatus(id) {
        document.getElementById('statusForm').action = '/admin/reports/status/' + id ;
        document.getElementById('statusModal').classList.remove('hidden');
        document.getElementById('statusModal').classList.add('flex');
    }
    
    function closeStatusModal() {
        document.getElementById('statusModal').classList.add('hidden');
        document.getElementById('statusModal').classList.remove('flex');
    }
</script>
@endpush
@endsection