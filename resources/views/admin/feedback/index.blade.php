@extends('admin.layouts.app')

@section('title', 'User Feedback')
@section('header-title', 'User Feedback')
@section('header-description', 'View and manage user feedback')

@section('content')
<div class="space-y-6">
    
    <!-- Statistics -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-[#2D6A4F]">
            <p class="text-gray-500 text-xs">Total Feedback</p>
            <p class="text-2xl font-bold text-gray-800">{{ $statistics['total'] ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-yellow-500">
            <p class="text-gray-500 text-xs">Unread</p>
            <p class="text-2xl font-bold text-yellow-600">{{ $statistics['unread'] ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-green-500">
            <p class="text-gray-500 text-xs">Resolved</p>
            <p class="text-2xl font-bold text-green-600">{{ $statistics['resolved'] ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-blue-500">
            <p class="text-gray-500 text-xs">Avg Rating</p>
            <p class="text-2xl font-bold text-blue-600">{{ number_format($statistics['average_rating'] ?? 0, 1) }}</p>
        </div>
    </div>
    
    <!-- Feedback List -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">All Feedback</h3>
            <span class="text-sm text-gray-500">{{ $feedback->total() }} items</span>
        </div>
        
        <div class="divide-y divide-gray-100">
            @forelse($feedback as $item)
            <div class="p-6 hover:bg-gray-50 transition">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center space-x-3 mb-2">
                            <div class="w-10 h-10 bg-gradient-to-br from-[#2D6A4F] to-[#1B4D3E] rounded-full flex items-center justify-center text-white font-bold text-sm">
                                {{ strtoupper(substr($item->user->name ?? 'A', 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">{{ $item->user->name ?? 'Anonymous' }}</p>
                                <div class="flex items-center space-x-2">
                                    <div class="flex text-yellow-400 text-xs">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="{{ $i <= ($item->rating ?? 0) ? 'fas' : 'far' }} fa-star"></i>
                                        @endfor
                                    </div>
                                    <span class="text-xs text-gray-400">{{ $item->created_at->format('M d, Y H:i A') }}</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-600 leading-relaxed">{{ $item->message }}</p>
                        @if($item->category)
                            <span class="inline-block px-2.5 py-1 text-xs rounded-full bg-blue-100 text-blue-700 mt-2">
                                {{ ucfirst($item->category) }}
                            </span>
                        @endif
                    </div>
                    <div class="flex items-center space-x-2 ml-4">
                        @if(!$item->is_read)
                            <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 mr-1.5"></span>
                                New
                            </span>
                        @endif
                        <button onclick="viewFeedback({{ $item->id }})" class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition flex items-center justify-center">
                            <i class="fas fa-eye text-sm"></i>
                        </button>
                        <button onclick="toggleFeedbackStatus({{ $item->id }})" class="w-8 h-8 rounded-lg bg-green-100 text-green-600 hover:bg-green-200 transition flex items-center justify-center">
                            <i class="fas fa-check text-sm"></i>
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="py-12 text-center">
                <i class="fas fa-comment-dots text-5xl text-gray-300 mb-3"></i>
                <p class="text-gray-500">No feedback found</p>
            </div>
            @endforelse
        </div>
        
        @if($feedback->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            {{ $feedback->links() }}
        </div>
        @endif
    </div>
</div>
@endpush
@endsection